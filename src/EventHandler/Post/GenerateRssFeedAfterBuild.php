<?php

namespace BrasilTranscrito\EventHandler\Post;

use BrasilTranscrito\EventHandler\HandlerInterface;
use BrasilTranscrito\Feed\FeedBuilder;
use BrasilTranscrito\Feed\ItemBuilder;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class GenerateRssFeedAfterBuild implements HandlerInterface
{
    const OUTPUT_FILE = 'feed.xml';

    public function handle(Jigsaw $jigsaw): void
    {
        $builder = (new FeedBuilder())
            ->channel()
                ->title($jigsaw->getConfig('feed.title'))
                ->subtitle($jigsaw->getConfig('feed.subtitle'))
                ->description($jigsaw->getConfig('feed.description'))
                ->lastBuildDate($jigsaw->getConfig('feed.lastBuildDate'))
                ->language($jigsaw->getConfig('feed.language'))
                ->generator($jigsaw->getConfig('feed.generator'))
                ->managingEditor($jigsaw->getConfig('feed.managingEditor'))
                ->imageUrl($jigsaw->getConfig('feed.imageUrl'))
                ->url($jigsaw->getConfig('feed.url'))
                ->feedUrl($jigsaw->getConfig('feed.feedUrl'))
                ->author($jigsaw->getConfig('feed.author'))
                ->explicit($jigsaw->getConfig('feed.explicit'))
                ->type($jigsaw->getConfig('feed.type'))
                ->email($jigsaw->getConfig('feed.email'))
                ->category($jigsaw->getConfig('feed.category'));

        $jigsaw
            ->getCollection('posts')
            ->filter(function (PageVariable $episode) {
                return false === is_null($episode->audioUrl);
            })
            ->sortByDesc('date')
            ->each(function (PageVariable $episode) use ($builder, $jigsaw) {
                $builder->addItem()
                    ->guid($episode->getUrl())
                    ->title($episode->title)
                    ->subtitle($episode->description)
                    ->description($episode->description)
                    ->author($jigsaw->getConfig('feed.author'))
                    ->link($episode->getUrl())
                    ->comments($episode->getUrl())
                    ->pubDate(date(ItemBuilder::DATE_FORMAT, $episode->postDate))
                    ->explicit($jigsaw->getConfig('feed.explicit'))
                    ->duration($episode->duration)
                    ->addCategory($jigsaw->getConfig('feed.category'))
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
