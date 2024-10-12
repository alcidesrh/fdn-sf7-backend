<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Common\Filter\DateFilterInterface;
use ApiPlatform\Doctrine\Common\Filter\SearchFilterInterface;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\Attribute\FormKitCreateExclude;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Attribute\ColumnTableList;
use App\Entity\Base\UserBase;
use App\Filter\UserFilter;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        // new Mutation(name: 'create'),
        // new Mutation(name: 'update'),
        // new DeleteMutation(name: 'delete'),
        new QueryCollection(
            paginationType: 'page',
            filters: ['or.filter', 'date.filter', 'order.filter'],
            extraArgs: ['fullName' => ['type' => 'String']]
        ),
    ]
)]

#[ApiFilter(UserFilter::class, alias: 'or.filter', properties: ['id', 'fullName', 'username', 'status'], arguments: ['searchFilterProperties' => ['id' => SearchFilterInterface::STRATEGY_EXACT, 'fullName' => SearchFilterInterface::STRATEGY_IPARTIAL, 'username' => SearchFilterInterface::STRATEGY_IPARTIAL, 'status' => SearchFilterInterface::STRATEGY_EXACT, 'createdAt' => DateFilterInterface::INCLUDE_NULL_BEFORE_AND_AFTER]])]

#[ApiFilter(DateFilter::class, alias: 'date.filter', properties: ['createdAt' => DateFilterInterface::EXCLUDE_NULL])]

#[ApiFilter(OrderFilter::class, alias: 'order.filter', properties: ['id', 'nombre', 'username', 'createdAt', 'status'], arguments: ['orderParameterName' => 'order'])]

#[ColumnTableList(properties: [
    ['name' => 'id', 'label' => 'Id', 'sort' => true, 'filter' => true],
    ['name' => 'username', 'label' => 'Usuario', 'sort' => true, 'filter' => true],
    ['name' => 'fullName', 'label' => 'Nombre', 'sort' => 'nombre', 'filter' => true],
    ['name' => 'createdAt', 'label' => 'Fecha creación', 'sort' => 'fecha', 'filter' => true],
    ['name' => 'status', 'label' => 'Status', 'sort' => 'status'],
])]

class User extends UserBase implements UserInterface, PasswordAuthenticatedUserInterface {


    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(nullable: true)]
    private ?string $password = null;


    private ?string $fullName;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: ApiToken::class)]
    private Collection $apiTokens;

    private ?array $accessTokenScopes = null;

    #[ORM\ManyToMany(targetEntity: Permiso::class, mappedBy: 'usuarios')]
    private Collection $permisos;

    public function __construct(string $userIdentifier = '', array $roles = []) {

        $this->username = $userIdentifier;
        $this->roles = $roles;
        $this->apiTokens = new ArrayCollection();
        $this->permisos = new ArrayCollection();
    }

    public function getFullName() {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): static {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    #[FormKitCreateExclude]
    public function getUserIdentifier(): string {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array {
        if (null === $this->accessTokenScopes) {
            // logged in via the full user mechanism
            $roles = $this->roles;
            $roles[] = 'ROLE_FULL_USER';
        } else {
            $roles = $this->accessTokenScopes;
        }
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(string $password): static {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }



    // public static function createFromPayload($username, array $payload): User {
    //     return new self(
    //         $username,
    //         $payload['roles'] ?? [], // Added by default
    //         $payload['username'] ?? [] // Custom
    //     );
    // }

    public function __toString() {
        return $this->username;
    }

    /**
     * @return Collection<int, ApiToken>
     */
    public function getApiTokens(): Collection {
        return $this->apiTokens;
    }

    public function addApiToken(ApiToken $apiToken): static {
        if (!$this->apiTokens->contains($apiToken)) {
            $this->apiTokens->add($apiToken);
            $apiToken->setUsuario($this);
        }

        return $this;
    }

    public function removeApiToken(ApiToken $apiToken): static {
        if ($this->apiTokens->removeElement($apiToken)) {
            // set the owning side to null (unless already changed)
            if ($apiToken->getUsuario() === $this) {
                $apiToken->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return string[]
     */
    public function getValidTokenStrings(): array {
        return $this->getApiTokens()
            ->filter(fn(ApiToken $token) => $token->isValid())
            ->map(fn(ApiToken $token) => $token->getToken())
            ->toArray();
    }
    public function markAsTokenAuthenticated(array $scopes) {
        $this->accessTokenScopes = $scopes;
    }

    /**
     * @return Collection<int, Permiso>
     */
    public function getPermisos(): Collection {
        return $this->permisos;
    }

    public function addPermiso(Permiso $permiso): static {
        if (!$this->permisos->contains($permiso)) {
            $this->permisos->add($permiso);
            $permiso->addUsuario($this);
        }

        return $this;
    }

    public function removePermiso(Permiso $permiso): static {
        if ($this->permisos->removeElement($permiso)) {
            $permiso->removeUsuario($this);
        }

        return $this;
    }
}
