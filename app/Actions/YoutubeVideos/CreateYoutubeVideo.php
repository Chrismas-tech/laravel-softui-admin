<?php

namespace App\Actions\YoutubeVideos;

use App\Models\YoutubeVideo;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateYoutubeVideo
{
    use AsAction;

    public function handle(array $attributes)
    {
        return YoutubeVideo::create([
            'name' => $attributes['videoName'],
            'iframe' => $attributes['videoIframe'],
        ]);
    }
}
