<?php

namespace BrasilTranscrito\Domain\Model\Post;

use DateTimeInterface;

class Post
{
    /** @var string */
    private $guid;

    /** @var string */
    private $url;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $author;

    /** @var string */
    private $content;

    /** @var string */
    private $category;

    /** @var PostImageCollection */
    private $images;

    /** @var DateTimeInterface */
    private $createdAt;

    /** @var DateTimeInterface */
    private $updatedAt;

    public function __construct(
        string $guid,
        string $url,
        string $title,
        string $description,
        string $author,
        string $content,
        string $category,
        PostImageCollection $images,
        DateTimeInterface $createdAt,
        DateTimeInterface $updatedAt
    ) {
        $this->guid = $guid;
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->content = $content;
        $this->category = $category;
        $this->images = $images;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function guid(): string
    {
        return $this->guid;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function images(): PostImageCollection
    {
        return $this->images;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }
}
