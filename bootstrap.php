<?php

use BrasilTranscrito\EventHandler\Post\PostProcessFilesAfterBuild;
use BrasilTranscrito\EventHandler\Category\GenerateCategoriesAfterCollections;
use BrasilTranscrito\EventHandler\Post\DecorateConfigWithLatestPostsAfterCollections;
use BrasilTranscrito\EventHandler\Post\GenerateRecommendedEpisodeListAfterCollections;
use BrasilTranscrito\Infrastructure\Application\Service\FileProcessing\JigsawGenerateRssFeed;
use Nawarian\JigsawSitemapPlugin\Listener\SitemapListener;
use TightenCo\Jigsaw\Jigsaw;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

$events->beforeBuild(function (Jigsaw $jigsaw) use ($container) {
    $configureDependencyInjection = require __DIR__ . '/config/dependency-injection.php';
    $configureDependencyInjection($container, $jigsaw);
});

$events->afterCollections([
    GenerateCategoriesAfterCollections::class,
    DecorateConfigWithLatestPostsAfterCollections::class,
    GenerateRecommendedEpisodeListAfterCollections::class,
]);

$events->afterBuild([
    SitemapListener::class,
    JigsawGenerateRssFeed::class,
    PostProcessFilesAfterBuild::class,
]);
