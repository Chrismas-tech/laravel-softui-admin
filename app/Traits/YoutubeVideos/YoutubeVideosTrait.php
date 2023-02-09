<?php

namespace App\Traits\YoutubeVideos;

trait YoutubeVideosTrait
{
    public string $regexIframe = '/^<iframe\s+width="\d{3,4}"\s+height="\d{3,4}"\s+src="https:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9_-]+"(?:(?!<\/iframe>).)*<\/iframe>$/';
}
