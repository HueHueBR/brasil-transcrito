<?php

namespace BrasilTranscrito\EventHandler\Post;

use BrasilTranscrito\EventHandler\HandlerInterface;
use BrasilTranscrito\Feed\FeedBuilder;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class GenerateRssFeedAfterBuild implements HandlerInterface
{
    const OUTPUT_FILE = 'feed.xml';

    public function handle(Jigsaw $jigsaw): void
    {
        $builder = (new FeedBuilder())
            ->channel()
                ->title('Brasil Transcrito')
                ->author('Brasil Transcrito')
                ->link($jigsaw->getConfig('baseUrl'))
                ->image($jigsaw->getConfig('meta.image') ?? '')
                ->category($jigsaw->getConfig('meta.category'))
                ->type('episodic')
                ->explicit(false)
                ->description($jigsaw->getConfig('meta.description'))
                ->language('pt-BR')
                ->generator('Brasil Transcrito Static Blog');

        $jigsaw
            ->getCollection('posts')
            ->filter(function (PageVariable $episode) {
                return false === is_null($episode->audioUrl);
            })
            ->sortByDesc('date')
            ->each(function (PageVariable $episode) use ($builder, $jigsaw) {
                $cover = $episode->cover['url'] ?? '';

                if (isset($episode->cover['rss'])) {
                    $cover = $episode->cover['rss'];
                }

                $builder->addItem()
                    ->title($episode->title)
                    ->link($episode->getUrl())
                    ->cover($episode->getBaseUrl() . $cover)
                    ->author($jigsaw->getConfig('meta.creatorName'))
                    ->summary($episode->description)
                    ->guid($episode->getUrl())
                    ->pubDate($episode->date)
                    ->addEnclosure()
                        ->url($episode->audioUrl)
                        ->length('0')
                        ->type('audio/mpeg');
            });

        $xmlFeed = $builder->close()->toXml();
        $file = implode(DIRECTORY_SEPARATOR, [$jigsaw->getDestinationPath(), self::OUTPUT_FILE]);

        file_put_contents($file, $xmlFeed);
    }
}
