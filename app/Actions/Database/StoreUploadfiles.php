<?php

namespace App\Actions\Database;

use App\Models\UploadFile;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUploadfiles
{
    use AsAction;
    public UploadFile $file;

    public function handle(string $fileName, string $filePath, string $fileSize, string $folderPath, string $fileType)
    {
        return UploadFile::create([
            'file_name' => $fileName,
            'folder_path' => $folderPath,
            'file_size' => $fileSize,
            'file_path' => $filePath,
            'file_type' => $fileType,
        ]);
    }
}
