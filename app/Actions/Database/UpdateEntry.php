<?php

namespace App\Actions\Database;

use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateEntry
{
    use AsAction;

    public function handle(Model $model, array $attributes)
    {
        return $model->update($attributes);
    }
}
