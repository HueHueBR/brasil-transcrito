<?php

use BrasilTranscrito\EventHandler\Episode\PostProcessFilesAfterBuild;
use BrasilTranscrito\EventHandler\Category\GenerateCategoriesAfterCollections;
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
]);

$events->afterBuild([
    SitemapListener::class,
    PostProcessFilesAfterBuild::class,
]);
