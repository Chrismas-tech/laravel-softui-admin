<?php

namespace App\Actions\Database\Files;

use App\Models\UploadFile;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateVisibility
{
    use AsAction;

    public function handle($id)
    {
        $file = UploadFile::findorFail($id);
        if ($file->visibility === 1) {
            $oldPath = str_replace('public', 'private', $file->file_path);
            $newPath = str_replace('public', 'private', $file->file_path);
            $file->update(['visibility' => 0]);
            $file->update(['file_path' => str_replace('private', 'public', $file->file_path)]);
            $file->update(['folder_path' => str_replace('private', 'public', $file->folder_path)]);
        } else {
            $oldPath = str_replace('private', 'public', $file->file_path);
            $newPath = str_replace('private', 'public', $file->file_path);
            $file->update(['visibility' => 1]);
            $file->update(['file_path' => str_replace('private', 'public', $file->file_path)]);
            $file->update(['folder_path' => str_replace('private', 'public', $file->folder_path)]);
        }
        Storage::move($oldPath, $newPath);
    }
}
