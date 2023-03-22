<?php

namespace App\Actions\Database\Folders;

use Lorisleiva\Actions\Concerns\AsAction;

class CreateFolder
{
    use AsAction;

    public $permissions = 0777;

    public function handle(string $folderPath)
    {
        if (!is_dir($folderPath)) {
            mkdir($folderPath, $this->permissions, true);
        }
    }
}
