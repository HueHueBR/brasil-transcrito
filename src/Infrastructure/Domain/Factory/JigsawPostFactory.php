<?php

namespace BrasilTranscrito\Infrastructure\Domain\Factory;

use BrasilTranscrito\Domain\Model\Post\Post;
use BrasilTranscrito\Domain\Model\Post\PostImage;
use BrasilTranscrito\Domain\Model\Post\PostImageCollection;
use TightenCo\Jigsaw\PageVariable;

class JigsawPostFactory
{
    public function newPostFromPageVariable(PageVariable $page): Post
    {
        $date = new \DateTime();

        return new Post(
            $page->getUrl(),
            $page->get('title'),
            $page->get('description'),
            $page->getContent(),
            $page->get('category'),
            $this->createImageCollectionFromPageVariable($page),
            \DateTimeImmutable::createFromMutable($date->setTimestamp($page->get('date'))),
            \DateTimeImmutable::createFromMutable($date->setTimestamp($page->get('postDate')))
        );
    }

    private function createImageCollectionFromPageVariable(PageVariable $page): PostImageCollection
    {
        $cover = new PostImage(
            $page->get('cover')['url'],
            $page->get('cover')['title'] ?? '',
            $page->get('cover')['alt'] ?? '',
            true
        );

        return new PostImageCollection([$cover]);
    }
}
