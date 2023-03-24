<?php

namespace App\Actions\Database\UploadFiles;

use App\Models\UploadFile;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteUploadFiles
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
