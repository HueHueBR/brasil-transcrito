<?php

namespace BrasilTranscrito\Infrastructure\Domain\Factory;

use BrasilTranscrito\Domain\Model\Post\AudioEpisode;
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
            $page->getUrl(),
            $page->get('title'),
            $page->get('description'),
            $page->get('author'),
            $page->getContent(),
            $page->get('category'),
            $this->createImageCollectionFromPageVariable($page),
            \DateTimeImmutable::createFromMutable($date->setTimestamp($page->get('date'))),
            \DateTimeImmutable::createFromMutable($date->setTimestamp($page->get('postDate')))
        );
    }

    public function newAudioEpisodeFromPageVariable(PageVariable $page): AudioEpisode
    {
        $date = new \DateTime();

        return new AudioEpisode(
            $page->getUrl(),
            $page->getUrl(),
            $page->get('title'),
            $page->get('description'),
            $page->get('author') ?? '',
            $page->getContent(),
            $page->get('category'),
            $this->createImageCollectionFromPageVariable($page),
            \DateTimeImmutable::createFromMutable($date->setTimestamp($page->get('date'))),
            \DateTimeImmutable::createFromMutable($date->setTimestamp($page->get('postDate'))),
            'explicit',
            $page->get('audio')['duration'],
            $page->get('audio')['url'],
            $page->getBaseUrl() . $page->get('audio')['cover']
        );
    }

    private function createImageCollectionFromPageVariable(PageVariable $page): PostImageCollection
    {
        $cover = new PostImage(
            $page->getBaseUrl() . $page->get('cover')['url'],
            $page->get('cover')['title'] ?? '',
            $page->get('cover')['alt'] ?? '',
            true
        );

        return new PostImageCollection([$cover]);
    }
}
