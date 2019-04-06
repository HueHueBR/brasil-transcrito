<?php

namespace BrasilTranscrito\Domain\Model\Post;

class PostImageCollection
{
    /** @var PostImage[] */
    private $images = [];

    public function __construct(array $images)
    {
        $this->images = $images;
    }

    public function images(): array
    {
        return $this->images;
    }
}
