<?php

namespace App\Actions\Database;

use App\Models\UploadFile;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteEntries
{
    use AsAction;

    public function handle(string $modelClass, array $ids)
    {
        if ($modelClass === 'App\Models\AlbumPhoto') {
            UploadFile::whereIn('model_id', $ids)->delete();
        }

        return $modelClass::whereIn('id', $ids)->delete();
    }
}
