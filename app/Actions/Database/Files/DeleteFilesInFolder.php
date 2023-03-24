<?php

namespace App\Actions\Database\Files;

use Lorisleiva\Actions\Concerns\AsAction;

class DeleteFilesInFolder
{
    use AsAction;

    public function handle($folderPath)
    {
        $files = glob($folderPath . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}
