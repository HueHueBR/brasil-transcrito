<?php

namespace BrasilTranscrito\EventHandler\Post;

use BrasilTranscrito\EventHandler\HandlerInterface;
use TightenCo\Jigsaw\Jigsaw;
use Symfony\Component\DomCrawler\Crawler;

class PostProcessFilesAfterBuild implements HandlerInterface
{
    public function handle(Jigsaw $jigsaw): void
    {
        collect($jigsaw->getOutputPaths())
            ->map(function (string $path) use ($jigsaw) {
                return $jigsaw->getDestinationPath() . $path . '/index.html';
            })
            ->filter(function (string $path) {
                return file_exists($path);
            })
            ->each(function (string $path) use ($jigsaw) {
                $builtContent = file_get_contents($path);
                $crawler = new Crawler();
                $crawler->addHtmlContent($builtContent);

                $this->decorateParagraphs($crawler);
                $this->decorateHeadings($crawler);

                file_put_contents($path, $crawler->getNode(0)->ownerDocument->saveHTML());
            });
    }

    private function decorateParagraphs(Crawler $crawler): void
    {
        foreach ($crawler->filter('.paragraphs-list p') as $paragraph) {
            $classes = array_merge(
                explode(' ', $paragraph->getAttribute('class')),
                ['paragraph paragraph--justified']
            );

            $paragraph->setAttribute('class', trim(implode(' ', $classes)));
        }

        foreach ($crawler->filter('.paragraphs-list strong') as $boldItem) {
            $classes = array_merge(
                explode(' ', $boldItem->getAttribute('class')),
                ['paragraph--bold']
            );

            $boldItem->setAttribute('class', trim(implode(' ', $classes)));
        }

        foreach ($crawler->filter('.paragraphs-list a') as $linkItem) {
            $classes = array_merge(
                explode(' ', $linkItem->getAttribute('class')),
                ['link']
            );

            $linkItem->setAttribute('class', trim(implode(' ', $classes)));
            $linkItem->setAttribute('target', '_blank');
        }
    }

    private function decorateHeadings(Crawler $crawler): void
    {
        $secondaryHeadings = ['.paragraphs-list h2', '.paragraphs-list h3'];
        $filter = implode(',', $secondaryHeadings);
        foreach ($crawler->filter($filter) as $heading) {
            $classes = array_merge(
                explode(' ', $heading->getAttribute('class')),
                ['heading', 'heading__secondary']
            );

            $heading->setAttribute('class', trim(implode(' ', $classes)));
        }
    }
}
