<?php

namespace App\Actions\Database\UploadFiles;

use App\Models\UploadFile;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUploadFiles
{
    use AsAction;
    public UploadFile $file;

    public function handle(
        string $fileName,
        string $filePath,
        string $fileSize,
        string $folderPath,
        string $fileType,
        int $visibility = 0
    ) {
        return UploadFile::create([
            'file_name' => $fileName,
            'folder_path' => $folderPath,
            'file_size' => $fileSize,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'visibility' => $visibility
        ]);
    }
}
