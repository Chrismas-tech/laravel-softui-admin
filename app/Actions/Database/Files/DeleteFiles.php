<?php

namespace App\Actions\Database\Files;

use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteFiles
{
    use AsAction;

    public function handle(array $filesPath)
    {
        foreach ($filesPath as $filePath) {
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        return true;
    }
}
