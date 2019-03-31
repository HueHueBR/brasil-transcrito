<?php

namespace BrasilTranscrito\EventHandler\Category;

use Illuminate\Support\Collection;
use TightenCo\Jigsaw\Jigsaw;
use BrasilTranscrito\EventHandler\HandlerInterface;

class GenerateCategoriesAfterCollections implements HandlerInterface
{
    const COLLECTION_NAME_ALL = 'Todos';

    public function handle(Jigsaw $jigsaw): void
    {
        $collections = $jigsaw->getCollections();
        foreach ($collections as $posts) {
            $jigsaw->getSiteData()->put(self::COLLECTION_NAME_ALL, $posts);

            $posts->groupBy('category')->each(function (Collection $posts, string $category) use ($jigsaw) {
                $jigsaw->getSiteData()->put($category, $posts);
            });
        }
    }
}
