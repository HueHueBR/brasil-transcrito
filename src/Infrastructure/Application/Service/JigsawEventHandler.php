<?php

namespace BrasilTranscrito\Infrastructure\Application\Service;

use TightenCo\Jigsaw\Jigsaw;

interface JigsawEventHandler
{
    public function handle(Jigsaw $jigsaw): void;
}
