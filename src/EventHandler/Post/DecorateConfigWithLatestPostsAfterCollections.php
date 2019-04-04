<?php

namespace BrasilTranscrito\EventHandler\Post;

use BrasilTranscrito\EventHandler\HandlerInterface;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class DecorateConfigWithLatestPostsAfterCollections implements HandlerInterface
{
    const LATEST_TRANSCRIPTIONS_AMOUNT = 8;

    public function handle(Jigsaw $jigsaw): void
    {
        /** @var PageVariable $posts */
        $posts = $jigsaw->getCollection('Transcrição');

        $jigsaw->setConfig('latestPost', $this->getLastPost($posts));
        $jigsaw->setConfig('latestTranscriptions', $this->getLatestTranscriptions($posts));
    }

    private function getLastPost(PageVariable $pages): PageVariable
    {
        return $pages->sortByDesc('postDate')->first();
    }

    private function getLatestTranscriptions(PageVariable $pages): PageVariable
    {
        $latestPost = $this->getLastPost($pages);

        return $pages
            ->filter(function (PageVariable $post) use ($latestPost) {
                return $post !== $latestPost;
            })
            ->sortByDesc('postDate')
            ->take(self::LATEST_TRANSCRIPTIONS_AMOUNT);
    }
}
