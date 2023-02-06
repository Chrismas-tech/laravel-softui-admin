<?php

namespace App\Actions\YoutubeVideos;

use App\Models\YoutubeVideo;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteYoutubeVideos
{
    use AsAction;

    public function handle(array $ids)
    {
       return YoutubeVideo::whereIn('id', $ids)->delete();
    }
}
