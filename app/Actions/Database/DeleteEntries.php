<?php

namespace App\Actions\Database;

use App\Models\YoutubeVideo;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteEntries
{
    use AsAction;

    public function handle(array $ids)
    {
       return YoutubeVideo::whereIn('id', $ids)->delete();
    }
}
