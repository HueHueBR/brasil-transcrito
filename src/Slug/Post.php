<?php

namespace BrasilTranscrito\Slug;

use Illuminate\Support\Str;
use TightenCo\Jigsaw\PageVariable;

class Post
{
    const PREFIX = 'p/';

    public function __invoke(PageVariable $page)
    {
        if ($page->slug ?? null) {
            return self::PREFIX . $page->slug;
        }

        return self::PREFIX . Str::slug($page->title, '-');
    }
}
