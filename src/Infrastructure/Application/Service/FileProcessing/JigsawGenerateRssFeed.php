<?php

namespace BrasilTranscrito\Infrastructure\Application\Service\FileProcessing;

use BrasilTranscrito\Application\Service\FileProcessing\GenerateRssFeed;
use BrasilTranscrito\Domain\Model\FileProcessing\RssFeedConfiguration;
use TightenCo\Jigsaw\Jigsaw;

class JigsawGenerateRssFeed
{
    public function handle(Jigsaw $jigsaw): void
    {
        /** @var RssFeedConfiguration $configuration */
        $configuration = $jigsaw->app->get(RssFeedConfiguration::class);

        /** @var GenerateRssFeed $handler */
        $handler = $jigsaw->app->make(GenerateRssFeed::class);

        $handler->handle($configuration);
    }
}
