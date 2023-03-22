<?php

namespace App\Actions\Database\YoutubeVideos;

use App\Models\YoutubeVideo;
use Lorisleiva\Actions\Concerns\AsAction;

class DuplicateYoutubeVideo
{
    use AsAction;

    public function handle(array $attributes)
    {
        $youtubeVideos = YoutubeVideo::whereIn('id', $attributes)->get();

        foreach ($youtubeVideos as $youtubeVideo) {
            $duplicate = $youtubeVideo->replicate();
            $duplicate->save();
        }

        return true;
    }
}
