<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Common\Filter\DateFilterInterface;
use ApiPlatform\Doctrine\Common\Filter\SearchFilterInterface;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Attribute\CollectionMetadataAttribute;
use App\Attribute\FormMetadataAttribute;
use App\Entity\Base\UserBase;
use App\Filter\OrFilter;
use App\Resolver\UserByUsernameResolver;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    graphQlOperations: [
        new Query(
            filters: ['search.filter'],
            args: ['username' => ['type' => 'String']],
        ),
        new Mutation(name: 'create'),
        new Mutation(name: 'update'),
        new DeleteMutation(name: 'delete'),
        new QueryCollection(
            paginationType: 'page',
            filters: ['or.filter', 'date.filter', 'order.filter']
        ),
        new Query(
            name: 'getUserByUsername',
            resolver: UserByUsernameResolver::class,
            args: ['username' => ['type' => 'String']],
        ),
    ]
)]
#[ApiFilter(SearchFilter::class, alias: 'search.filter',  properties: ['username' => SearchFilterInterface::STRATEGY_EXACT])]

#[ApiFilter(OrFilter::class, alias: 'or.filter', properties: ['id', 'fullName', 'username', 'status', 'nombre', 'apellido'], arguments: ['searchFilterProperties' => ['id' => SearchFilterInterface::STRATEGY_EXACT, 'fullName' => SearchFilterInterface::STRATEGY_IPARTIAL, 'username' => SearchFilterInterface::STRATEGY_IPARTIAL, 'nombre' => SearchFilterInterface::STRATEGY_IPARTIAL, 'apellido' => SearchFilterInterface::STRATEGY_IPARTIAL, 'status' => SearchFilterInterface::STRATEGY_EXACT, 'createdAt' => DateFilterInterface::INCLUDE_NULL_BEFORE_AND_AFTER]])]

#[ApiFilter(DateFilter::class, alias: 'date.filter', properties: ['createdAt' => DateFilterInterface::EXCLUDE_NULL])]

#[ApiFilter(OrderFilter::class, alias: 'order.filter', properties: ['id', 'nombre', 'apellido', 'username', 'createdAt', 'status'], arguments: ['orderParameterName' => 'order'])]

#[CollectionMetadataAttribute(
    class: 'columns-wraper',
    props: [
        ['name' => 'id', 'label' => 'Id', 'sort' => true, 'filter' => true, 'outerClass' => 'small-column', 'columnClass' => 'small-column'],
        ['name' => 'username', 'label' => 'Usuario', 'sort' => true, 'filter' => true, 'outerClass' => 'medium-column', 'columnClass' => 'medium-column'],
        ['name' => 'nombre', 'label' => 'Nombre', 'sort' => true, 'filter' => true, 'outerClass' => 'medium-column', 'columnClass' => 'medium-column'],
        ['name' => 'apellido', 'outerClass' => 'medium-column', 'columnClass' => 'medium-column', 'label' => 'Apellido', 'sort' => true, 'filter' => true],
        ['name' => 'createdAt', 'label' => 'Fecha creación', 'sort' => 'fecha', 'filter' => true],
        ['name' => 'status', 'label' => 'Status', 'sort' => 'status']
    ]
)]

#[FormMetadataAttribute(exclude: ['password', 'fullName', 'apiTokens', 'legacyId'], order: ['nombre', 'apellido', 'email', 'telefono', 'nit', 'direccion', 'localidad'], columns: [['fields' => 7, 'wrapper' => ['type' => 'fieldset', 'props' => ['legend' => 'Datos Personales']]], ['wrapper' => ['type' => 'fieldset', 'props' => ['legend' => 'Permisos & Privilegios']]]])]

class User extends UserBase implements UserInterface, PasswordAuthenticatedUserInterface {


    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;


    /**
     * @var string The hashed password
     */
    #[ORM\Column(nullable: true)]
    private ?string $password = null;

    private ?string $fullName;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: ApiToken::class)]
    private Collection $apiTokens;

    /**
     * @var Collection<int, Role>
     */
    #[ORM\ManyToMany(targetEntity: Role::class)]
    private Collection $roles;

    /**
     * @var Collection<int, Permiso>
     */
    #[ORM\ManyToMany(targetEntity: Permiso::class)]
    private Collection $permisos;

    public function __construct($data = []) {

        if (!empty($data)) {
            $this->loadData($data);
        }

        $this->apiTokens = new ArrayCollection();
        $this->roles = new ArrayCollection();
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
    public function getUserIdentifier(): string {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    /**
     * @return Collection<int, Permiso>
     */
    public function getRoles(): array {
        return $this->permisos->toArray();
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
    public function getValidTokenStrings(): array|string {
        return $this->getApiTokens()
            ->filter(fn(ApiToken $token) => $token->isValid())
            ->map(fn(ApiToken $token) => $token->getToken())
            ->toArray()[1];
    }
    public function markAsTokenAuthenticated(array $scopes) {
        $this->accessTokenScopes = $scopes;
    }

    public function addRole(Role $role): static {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }

        return $this;
    }

    public function removeRole(Role $role): static {
        $this->roles->removeElement($role);

        return $this;
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
        }

        return $this;
    }

    public function removePermiso(Permiso $permiso): static {
        $this->permisos->removeElement($permiso);

        return $this;
    }

    public function getLabel() {
        $temp = explode(' ', $this->apellido);
        return $this->username . ': ' . $this->nombre . ' ' . $temp[0] ?? $this->apellido;
    }
}
