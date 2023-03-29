<?php

namespace App\Actions\Database\Folders;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\File;

class DeleteFolder
{
    use AsAction;

    public function handle(string $folderPath)
    {
        File::deleteDirectory($folderPath);
    }
}
