<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"conference": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     * @Assert\NotBlank(groups={"anonymous"})
     * @Assert\Length(min = 2, groups={"anonymous"})
     */
    private $author = null;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(min = 5)
     */
    private $content;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $postedAt;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     */
    private $post;

    /**
     * @var null|User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     */
    private $user = null;

    /**
     * Comment constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->postedAt = new \DateTimeImmutable();
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
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     */
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPostedAt(): \DateTimeImmutable
    {
        return $this->postedAt;
    }

    /**
     * @param \DateTimeImmutable $postedAt
     */
    public function setPostedAt(\DateTimeImmutable $postedAt): void
    {
        $this->postedAt = $postedAt;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post): void
    {
        $this->post = $post;
    }
}
