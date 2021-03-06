<?php

namespace BrasilTranscrito\Feed;

class ItemBuilder
{
    const DATE_FORMAT = 'D, d M Y H:i:s O';

    /** @var ChannelBuilder */
    private $channelBuilder;

    /** @var string */
    private $guid;

    /** @var string */
    private $title;

    private $subtitle;

    /** @var string */
    private $link;

    /** @var string */
    private $image;

    /** @var string */
    private $comments;

    /** @var string */
    private $pubDate;

    /** @var string */
    private $description;

    /** @var string */
    private $author;

    /** @var string */
    private $explicit;

    /** @var string */
    private $duration;

    /** @var string[] */
    private $categories = [];

    /** @var EnclosureBuilder[] */
    private $enclosures = [];

    public function __construct(ChannelBuilder $channelBuilder)
    {
        $this->channelBuilder = $channelBuilder;
    }

    public function guid(string $guid): self
    {
        $this->guid = $guid;
        return $this;
    }

    public function title(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function subtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function link(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function image(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function comments(string $comments): self
    {
        $this->comments = $comments;
        return $this;
    }

    public function pubDate(string $pubDate): self
    {
        $this->pubDate = $pubDate;
        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function author(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function explicit(string $explicit): self
    {
        $this->explicit = $explicit;
        return $this;
    }

    public function duration(string $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    public function addCategory(string $category): self {
        $this->categories[] = $category;
        return $this;
    }

    public function addEnclosure(): EnclosureBuilder
    {
        $enclosureBuilder = new EnclosureBuilder($this);
        $this->enclosures[] = $enclosureBuilder;

        return $enclosureBuilder;
    }

    public function toDOMElement(\DOMDocument $dom): \DOMElement
    {
        $element = $dom->createElement('item');
        $element->appendChild($dom->createElement('guid', $this->guid));
        $element->appendChild($dom->createElement('title', $this->title));
        $element->appendChild($dom->createElement('link', $this->link));
        $element->appendChild($dom->createElement('comments', $this->comments));
        $element->appendChild($dom->createElement('pubDate', $this->pubDate));

        foreach ($this->categories as $category) {
            $categoryCdata = $dom->createCDATASection($category);
            $categoryElement = $dom->createElement('category');
            $categoryElement->appendChild($categoryCdata);
            $element->appendChild($categoryElement);
        }

        foreach ($this->enclosures as $enclosure) {
            $element->appendChild($enclosure->toDOMElement($dom));
        }

        $element->appendChild($dom->createElement('itunes:subtitle', $this->subtitle));
        $element->appendChild($dom->createElement('itunes:summary', $this->description));
        $element->appendChild($dom->createElement('itunes:author', $this->author));
        $element->appendChild($dom->createElement('itunes:explicit', $this->explicit));
        $element->appendChild($dom->createElement('itunes:duration', $this->duration));

        if ($this->image) {
            $coverImage = $dom->createElement('itunes:image');
            $coverImage->setAttribute('href', $this->image);

            $element->appendChild($coverImage);
        }

        return $element;
    }
}
