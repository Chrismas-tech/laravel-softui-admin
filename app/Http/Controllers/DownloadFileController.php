<?php

namespace App\Http\Controllers;

use App\Models\UploadFile;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DownloadFileController extends Controller
{
    use LivewireAlert;

    public function download(UploadFile $file)
    {
        $path = storage_path('app/' . $file->file_path);

        if (!file_exists($path)) {
            $this->alert('error', 'This file does not exist ! An error occured !');
            return;
        }

        return Storage::download($file->file_path, $file->file_name, [
            'Content-Type' => 'application/octet-stream',
        ]);
    }
}
