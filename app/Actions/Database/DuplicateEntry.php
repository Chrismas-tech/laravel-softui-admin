<?php

namespace App\Actions\Database;

use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class DuplicateEntry
{
    use AsAction;

    public function handle(Model $model)
    {
        for ($i = 0; $i < 50; $i++) {
            $duplicate = $model->replicate();
            $duplicate->save();
        }
        return $duplicate->save();
    }
}
