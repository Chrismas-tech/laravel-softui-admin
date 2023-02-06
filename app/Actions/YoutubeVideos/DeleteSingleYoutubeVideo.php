<?php

namespace App\Actions\YoutubeVideos;

use App\Models\YoutubeVideo;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteSingleYoutubeVideo
{
    use AsAction;

    public function handle(string $id)
    {
       return YoutubeVideo::whereIn('id', $ids)->delete();
    }
}
