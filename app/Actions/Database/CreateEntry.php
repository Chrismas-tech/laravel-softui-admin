<?php

namespace App\Actions\Database;

use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateEntry
{
    use AsAction;

    public function handle(Model $model, array $attributes)
    {
        return $model::create([
            'name' => $attributes['modelName'],
            'iframe' => $attributes['modelIframe'],
        ]);
    }
}
