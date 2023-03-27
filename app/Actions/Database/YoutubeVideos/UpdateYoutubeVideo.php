<?php

namespace App\Actions\Database\YoutubeVideos;

use App\Models\YoutubeVideo;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateYoutubeVideo
{
    use AsAction;

    public function handle(YoutubeVideo $video, $attributes)
    {
        return $video->update([
            'name' => $attributes['name'],
            'iframe' => $attributes['iframe'],
        ]);
    }
}
