<?php

namespace BrasilTranscrito\Application\Service\FileProcessing;

use BrasilTranscrito\Domain\Model\FileProcessing\RssFeedConfiguration;
use BrasilTranscrito\Domain\Model\Post\PostRepository;
use BrasilTranscrito\Domain\Model\Post\AudioEpisode;
use BrasilTranscrito\Feed\ChannelBuilder;
use BrasilTranscrito\Feed\FeedBuilder;
use BrasilTranscrito\Feed\ItemBuilder;

class GenerateRssFeed
{
    /** @var FeedBuilder */
    private $builder;

    /** @var PostRepository */
    private $postsRepository;

    public function __construct(FeedBuilder $builder, PostRepository $postsRepository)
    {
        $this->builder = $builder;
        $this->postsRepository = $postsRepository;
    }

    public function handle(RssFeedConfiguration $configuration): void
    {
        $builder = $this->builder
            ->channel()
                ->title($configuration->title())
                ->subtitle($configuration->subtitle())
                ->description($configuration->description())
                ->lastBuildDate($configuration->lastBuildDate()->format(ChannelBuilder::DATE_FORMAT))
                ->language($configuration->language())
                ->generator($configuration->generator())
                ->managingEditor($configuration->managingEditor())
                ->imageUrl($configuration->imageUrl())
                ->url($configuration->url())
                ->feedUrl($configuration->feedUrl())
                ->author($configuration->author())
                ->explicit($configuration->explicit())
                ->type($configuration->type())
                ->email($configuration->email())
                ->category($configuration->category());

        $episodes = $this->postsRepository->withAudio();
        $episodes->uasort(function (AudioEpisode $ep1, AudioEpisode $ep2) {
            return $ep1->createdAt() > $ep2->createdAt();
        });

        /** @var AudioEpisode $episode */
        foreach ($episodes as $episode) {
            $builder->addItem()
                ->guid($episode->guid())
                ->title($episode->title())
                ->subtitle($episode->description())
                ->image($episode->audioCover())
                ->description($episode->description())
                ->author($episode->author())
                ->link($episode->url())
                ->comments($episode->url())
                ->pubDate($episode->updatedAt()->format(ItemBuilder::DATE_FORMAT))
                ->explicit($configuration->explicit())
                ->duration($episode->duration())
                ->addCategory($episode->category())
                ->addEnclosure()
                    ->url($episode->audioUrl())
                    ->length('0')
                    ->type('audio/mpeg');
        }

        $outputContent = $builder->close()->toXml();
        file_put_contents($configuration->outputFilepath(), $outputContent);
    }
}
