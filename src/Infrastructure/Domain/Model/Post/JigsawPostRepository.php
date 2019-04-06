<?php

namespace BrasilTranscrito\Infrastructure\Domain\Model\Post;

use BrasilTranscrito\Domain\Model\Post\Post;
use BrasilTranscrito\Domain\Model\Post\PostCollection;
use BrasilTranscrito\Domain\Model\Post\PostRepository;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class JigsawPostRepository implements PostRepository
{
    /** @var Jigsaw */
    private $jigsaw;

    public function __construct(Jigsaw $jigsaw)
    {
        $this->jigsaw = $jigsaw;
    }

    public function latestPost(): Post
    {
        return $this->jigsaw->getCollection('posts')->sortByDesc('postDate')->first()->makePostEntity();
    }

    public function latestPosts(int $amount): PostCollection
    {
        return $this->jigsawCollectionToPostCollection(
            $this->jigsaw
                ->getCollection('posts')
                ->sortByDesc('postDate')
                ->take($amount)
        );
    }

    public function byCategory(string $category): PostCollection
    {
        return $this->jigsawCollectionToPostCollection(
            $this->jigsaw
                ->getCollection('posts')
                ->whereStrict('category', $category)
        );
    }

    private function jigsawCollectionToPostCollection(PageVariable $collection): PostCollection
    {
        return new PostCollection(
            $collection
                ->map(function (PageVariable $post) {
                    return $post->makePostEntity();
                })
                ->toArray()
        );
    }
}
