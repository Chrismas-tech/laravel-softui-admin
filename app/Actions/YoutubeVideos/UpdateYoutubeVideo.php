<?php

namespace App\Actions\YoutubeVideos;

use App\Models\YoutubeVideo;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateYoutubeVideo
{
    use AsAction;

    public function handle(YoutubeVideo $video, array $attributes)
    {
        return $video->update([
            'name' => $attributes['videoName'],
            'iframe' => $attributes['videoIframe'],
        ]);
    }
}
