<?php

namespace BrasilTranscrito\Domain\Model\Post;

use ArrayObject;
use InvalidArgumentException;

class PostCollection extends ArrayObject
{
    public function __construct(array $images = []) {
        $nonPostItems = array_filter($images, function ($post) {
            return !$post instanceof Post;
        });

        if (count($nonPostItems) > 0) {
            throw new InvalidArgumentException('PostCollection elements must be instanceof Post.');
        }

        parent::__construct($images);
    }
}
