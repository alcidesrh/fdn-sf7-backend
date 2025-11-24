<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrFilter as FilterOrFilter;
use ApiPlatform\Doctrine\Orm\Filter\PartialSearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use ApiPlatform\Metadata\QueryParameter;
use App\Attribute\CollectionMetadataAttribute;
use App\Attribute\FormMetadataAttribute;
use App\Entity\Base\UserBase;
use App\Filter\IdPartialSearchFilter;
use App\Resolver\UserByUsernameResolver;
use App\Services\Collection as ServicesCollection;
use App\State\UserPasswordHasher;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    graphQlOperations: [
        new Query(),
        new Mutation(name: 'create', processor: UserPasswordHasher::class),
        new Mutation(name: 'update', processor: UserPasswordHasher::class),
        new DeleteMutation(name: 'delete'),
        new QueryCollection(
            paginationType: 'page',
            parameters: [
                // 'search[:property]' => new QueryParameter(
                //     properties: ['username', 'nombre', 'apellido', 'email'], // Only these properties get parameters created
                //     filter: new FilterOrFilter(new PartialSearchFilter())
                // ),
                'id' => new QueryParameter(
                    filter: new FilterOrFilter(new IdPartialSearchFilter()),
                    property: 'id',
                ),
                'username' => new QueryParameter(
                    filter: new FilterOrFilter(new PartialSearchFilter()),
                    property: 'username'
                ),
                'nombre' => new QueryParameter(
                    filter: new FilterOrFilter(new PartialSearchFilter()),
                    property: 'nombre'
                ),
                'apellido' => new QueryParameter(
                    filter: new FilterOrFilter(new PartialSearchFilter()),
                    property: 'apellido'
                ),
                'email' => new QueryParameter(
                    filter: new FilterOrFilter(new PartialSearchFilter()),
                    property: 'email'
                ),
            ],
        ),
        new Query(
            name: 'getByUsername',
            resolver: UserByUsernameResolver::class,
            args: ['username' => ['type' => 'String']],
        ),
    ]
)]
#[ApiFilter(DateFilter::class, properties: ['createdAt'])]
#[ApiFilter(OrderFilter::class, properties: ['id', 'nombre', 'apellido', 'username', 'createdAt', 'status'], arguments: ['orderParameterName' => 'order'])]

#[CollectionMetadataAttribute(
    class: 'columns-wraper',
    props: [
        ['name' => 'id', 'label' => 'Id', 'sort' => true, 'filter' => true, 'outerClass' => 'small-column', 'columnClass' => 'small-column'],
        ['name' => 'username', 'label' => 'Usuario', 'sort' => true, 'filter' => true, 'outerClass' => 'medium-column', 'columnClass' => 'medium-column'],
        ['name' => 'email', 'label' => 'Correo', 'sort' => true, 'filter' => true, 'outerClass' => 'medium-column', 'columnClass' => 'medium-column'],
        ['name' => 'nombre', 'label' => 'Nombre', 'sort' => true, 'filter' => true, 'outerClass' => 'medium-column', 'columnClass' => 'medium-column'],
        ['name' => 'apellido', 'outerClass' => 'medium-column', 'columnClass' => 'medium-column', 'label' => 'Apellido', 'sort' => true, 'filter' => true],
        ['name' => 'createdAt', 'label' => 'Fecha creación', 'sort' => 'fecha', 'filter' => true],
        ['name' => 'status', 'label' => 'Status',]
    ]
)]

#[FormMetadataAttribute(
    exclude: ['fullName', 'apiTokens', 'legacyId'],
    order: ['nombre', 'apellido', 'email', 'telefono', 'nit', 'direccion', 'localidad', 'status', 'userRoles', 'permisos'],
    schema: [
        // 'form' =>  [
        //     'plugins' => '$filterprop',
        //     'children' => [
        [
            'div' =>
            [
                'class' => 'form-header',
                'children' => [
                    [
                        'span' =>
                        [
                            'class' => 'font-medium u-text-1',
                            'children' => '$slots.header'
                        ]
                    ],
                    [
                        'div' => [
                            'ignore' => true,
                            'children' => '$slots.crudBtn'
                        ]
                    ],
                ]
            ]
        ],
        [
            'div' => [
                'class' => 'divider'
            ]
        ],
        [
            'div' => [
                'class' => 'toast-error-form',
                'children' => [
                    'component' => 'FormKitMessages'
                ]
            ]
        ],
        [
            'div' => [
                'class' => 'form-row',
                'children' => [
                    'div' => [
                        'class' => 'form-col',

                        'children' => [
                            [
                                'fieldset' => [
                                    'props' => [
                                        'legend' => 'Datos Personales',
                                    ],
                                    'children' => 7
                                ]
                            ],

                            [
                                'fieldset' => [
                                    'props' => [
                                        'legend' => 'Roles & Privilegios',
                                    ],
                                    'children' => 3
                                ]
                            ],
                            [
                                'fieldset' => [
                                    'props' => [
                                        'legend' => 'Credenciales',
                                    ],
                                    'children' => [
                                        'div' => [
                                            'children' => [
                                                ['username' => ['label' => 'Usuario']],
                                                ['plainPassword' => ['validation' => false, 'type' => 'password', 'label' => 'Nueva contraseña', 'inputProps' => ['autocomplete' => 'new-password']]],
                                                ['plainPassword' => ['type' => 'password', 'name' => 'password_confirm', 'label' => 'Repita la contraseña', 'validation' => 'confirm']]
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                        ]
                    ]
                ]
            ]
        ]
        // ]
        // ],
    ]
)]

class User extends UserBase implements UserInterface, PasswordAuthenticatedUserInterface {


    #[ORM\Column(length: 180, unique: true, nullable: false)]
    private string $username;

    /**
     * @var string The hashed password
     */
    #[ApiProperty(readable: false)]
    #[ORM\Column(nullable: true)]
    private ?string $password = null;

    #[Assert\NotBlank()]
    private ?string $plainPassword = null;


    private ?string $fullName;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: ApiToken::class)]
    private Collection $apiTokens;

    #[FormMetadataAttribute(merge: ['options' => '$roles', 'label' => 'Roles'])]
    #[ORM\JoinTable(name: 'user_role')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'role_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Role::class)]
    private Collection $userRoles;

    /**
     * @var Collection<int, Permiso>
     */

    #[FormMetadataAttribute(merge: ['options' => '$permisos'])]
    #[ORM\ManyToMany(targetEntity: Permiso::class)]
    private Collection $permisos;

    public function __construct($data = []) {

        if (!empty($data)) {
            $this->loadData($data);
        }

        $this->apiTokens = new ServicesCollection();
        $this->userRoles = new ServicesCollection();
        $this->permisos = new ServicesCollection();
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
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */

    public function getUserRoles(): Collection {
        return $this->userRoles;
    }
    #[Ignore]
    public function getRoles(): array {
        return $this->userRoles->map(fn(Role $role) => $role->getNombre())->toArray();
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

    public function getPlainPassword(): ?string {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self {
        $this->plainPassword = $plainPassword;

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
    //         $payload['userRoles'] ?? [], // Added by default
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
            if ($apiToken->getUsuario() === $this) {
                $apiToken->setUsuario(null);
            }
        }
        return $this;
    }

    public function getToken(): ?ApiToken {
        return $this->getApiTokens()
            // ->filter(
            //     fn(ApiToken $apiToken) => $apiToken->isActivo()
            // )
            ->first() ?: null;
    }

    /**
     * @return string
     */
    public function getValidTokenStrings(): ?string {
        return $this->getApiTokens()
            ->filter(fn(ApiToken $token) => $token->isValid())
            ->map(fn(ApiToken $token) => $token->getToken())
            ->first();
    }


    public function addUserRole(Role $role): static {
        if (!$this->userRoles->contains($role)) {
            $this->userRoles->add($role);
        }

        return $this;
    }

    public function removeUserRole(Role $role): static {
        $this->userRoles->removeElement($role);

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
