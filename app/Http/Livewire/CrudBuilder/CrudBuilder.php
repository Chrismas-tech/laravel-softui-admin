<?php

namespace App\Http\Livewire\CrudBuilder;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CrudBuilder extends Component
{
    public bool $isValid;
    public string $modelName;
    public int $modelNbFields = 1;

    public $messages = [];

    public function rules()
    {
        return [
            'modelName' => 'string|min:3',
        ];
    }

    public function updated($propertyName)
    {
        try {
            $this->validate();
            $this->isValid = true;
        } catch (ValidationException $ex) {
            $this->isValid = false;
        }

        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.crud-builder.crud-builder');
    }
}
