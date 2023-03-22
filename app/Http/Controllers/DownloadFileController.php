<?php

namespace App\Http\Controllers;

use App\Actions\Database\Files\DownloadFile;
use App\Models\UploadFile;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DownloadFileController extends Controller
{
    use LivewireAlert;

    public function download(UploadFile $file)
    {
        $path = storage_path('app/' . $file->file_path);

        if (!file_exists($path)) {
            $this->alert('error', 'This file does not exist ! An error occured !');
        }

        return response()->file($path);
    }
}
