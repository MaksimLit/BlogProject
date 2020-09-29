<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(unique=true)
     */
    private $email = null;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string|null
     * @ORM\Column
     */
    private $password = null;

    /**
     * @var string|null
     * @ORM\Column(unique=true)
     */
    private  $pseudo = null;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $registeredAt;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    private $comments;

    /**
     * User constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->registeredAt = new DateTimeImmutable();
        $this->comments = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    /**
     * @param string|null $pseudo
     */
    public function setPseudo(?string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getRegisteredAt(): DateTimeImmutable
    {
        return $this->registeredAt;
    }

    /**
     * @param DateTimeImmutable $registeredAt
     */
    public function setRegisteredAt(DateTimeImmutable $registeredAt): void
    {
        $this->registeredAt = $registeredAt;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return Collection
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }
}
