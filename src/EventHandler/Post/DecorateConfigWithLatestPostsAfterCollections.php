<?php

namespace BrasilTranscrito\EventHandler\Post;

use BrasilTranscrito\EventHandler\HandlerInterface;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class DecorateConfigWithLatestPostsAfterCollections implements HandlerInterface
{
    public function handle(Jigsaw $jigsaw): void
    {
        /** @var PageVariable $posts */
        $posts = $jigsaw->getCollection('Transcrição');

        $jigsaw->setConfig('latestPost', $this->getLastPost($posts));
    }

    private function getLastPost(PageVariable $pages): PageVariable
    {
        return $pages->sortByDesc('date')->first();
    }
}
