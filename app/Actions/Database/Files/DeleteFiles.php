<?php

namespace App\Actions\Database\Files;

use App\Models\UploadFile;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteFiles
{
    use AsAction;

    public function handle(array $attributes)
    {
        $files = UploadFile::whereIn('id', $attributes)->get();

        foreach ($files as $file) {
            Storage::delete($file->file_path);
            $file->delete();
        }

        return true;
    }
}
