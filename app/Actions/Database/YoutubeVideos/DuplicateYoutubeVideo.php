<?php

namespace App\Actions\Database;

use App\Models\YoutubeVideo;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class DuplicateYoutubeVideo
{
    use AsAction;

    public function handle(array $attributes)
    {
        return  YoutubeVideo::whereIn('id', $attributes)->replicate()->save();
    }
}
