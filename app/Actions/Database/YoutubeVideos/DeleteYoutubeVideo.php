<?php

namespace App\Actions\Database\YoutubeVideos;

use App\Models\YoutubeVideo;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteYoutubeVideo
{
    use AsAction;

    public function handle(array $attributes)
    {
        return YoutubeVideo::whereIn('id', $attributes)->delete();
    }
}
