<?php

namespace App\Actions\Database;

use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class DuplicateEntry
{
    use AsAction;

    public function handle(Model $model)
    {
         $duplicate = $model->replicate();
         return $duplicate->save();
    }
}
