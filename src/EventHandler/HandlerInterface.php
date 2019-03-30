<?php

namespace BrasilTranscrito\EventHandler;

use TightenCo\Jigsaw\Jigsaw;

interface HandlerInterface
{
    public function handle(Jigsaw $jigsaw): void;
}
