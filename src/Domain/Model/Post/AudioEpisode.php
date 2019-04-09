<?php

namespace BrasilTranscrito\Domain\Model\Post;

use DateTimeInterface;

class AudioEpisode extends Post
{
    /** @var string */
    private $explicit;

    /** @var string */
    private $duration;

    /** @var string */
    private $audioUrl;

    /** @var string */
    private $audioCover;

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
        DateTimeInterface $updatedAt,
        string $explicit,
        string $duration,
        string $audioUrl,
        string $audioCover
    ) {
        parent::__construct(
            $guid,
            $url,
            $title,
            $description,
            $author,
            $content,
            $category,
            $images,
            $createdAt,
            $updatedAt
        );

        $this->explicit = $explicit;
        $this->duration = $duration;
        $this->audioUrl = $audioUrl;
        $this->audioCover = $audioCover;
    }

    public function explicit(): string
    {
        return $this->explicit;
    }

    public function duration(): string
    {
        return $this->duration;
    }

    public function audioUrl(): string
    {
        return $this->audioUrl;
    }

    public function audioCover(): string
    {
        return $this->audioCover;
    }
}
