<?php

namespace BrasilTranscrito\EventHandler\Post;

use Illuminate\Support\Collection;
use BrasilTranscrito\EventHandler\HandlerInterface;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class GenerateRecommendedEpisodeListAfterCollections implements HandlerInterface
{
    const NUMBER_OF_RECOMMENDATIONS = 5;

    public function handle(Jigsaw $jigsaw): void
    {
        $jigsaw
            ->getCollection('posts')
            ->each(function (PageVariable $page) use ($jigsaw) {
                $page->recommended = $this->getRecommendationsForPage(
                    $jigsaw->getCollection('posts')->merge([]),
                    $page,
                    self::NUMBER_OF_RECOMMENDATIONS
                );
            });
    }

    /**
     * @param Collection $posts
     * @param PageVariable $page
     * @param int $maximumAmount
     *
     * @return Collection
     */
    public function getRecommendationsForPage(
        Collection $posts,
        PageVariable $page,
        int $maximumAmount
    ): Collection
    {
        $tags = $page->tags ?? [];
        return $posts
            ->filter(function (PageVariable $post) use ($page, $tags) {
                // Never recommend current page
                if ($post->getUrl() === $page->getUrl()) {
                    return false;
                }

                $postTags = $post->tags ?? [];
                return count(array_intersect($postTags, $tags)) > 0;
            })
            // Order by amount of matching tags
            ->sortByDesc(function (PageVariable $post) use ($tags) {
                return count(array_intersect($post->tags ?? [], $tags));
            })
            // Latest episodes first
            ->sortByDesc(function (PageVariable $post) {
                return (int) $post->postDate;
            })
            ->take($maximumAmount);
    }
}
