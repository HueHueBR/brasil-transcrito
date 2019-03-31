<?php

use BrasilTranscrito\EventHandler\Post\PostProcessFilesAfterBuild;
use BrasilTranscrito\EventHandler\Category\GenerateCategoriesAfterCollections;
use BrasilTranscrito\EventHandler\Post\DecorateConfigWithLatestPostsAfterCollections;
use BrasilTranscrito\EventHandler\Post\GenerateRssFeedAfterBuild;
use Nawarian\JigsawSitemapPlugin\Listener\SitemapListener;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

/**
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

$events->afterCollections([
    GenerateCategoriesAfterCollections::class,
    DecorateConfigWithLatestPostsAfterCollections::class,
]);

$events->afterBuild([
    SitemapListener::class,
    GenerateRssFeedAfterBuild::class,
    PostProcessFilesAfterBuild::class,
]);
