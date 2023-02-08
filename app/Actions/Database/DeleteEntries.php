<?php

namespace App\Actions\Database;

use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteEntries
{
    use AsAction;

    public function handle(string $modelClass, array $ids)
    {
        return $modelClass::whereIn('id', $ids)->delete();
    }
}
