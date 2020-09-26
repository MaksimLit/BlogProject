<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="comments:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="comment:item"}}},
 *          order={"createdAt"="DESC"},
 *          paginationEnabled=false
 * )
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
     * @Groups({"comment:list", "comment:item"})
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     * @Assert\NotBlank(groups={"anonymous"})
     * @Assert\Length(min = 2, groups={"anonymous"})
     * @Groups({"comment:list", "comment:item"})
     */
    private $author = null;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(min = 5)
     * @Groups({"comment:list", "comment:item"})
     */
    private $content;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"comment:list", "comment:item"})
     */
    private $postedAt;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @Groups({"comment:list", "comment:item"})
     */
    private $post;

    /**
     * @var null|User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @Groups({"comment:list", "comment:item"})
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
