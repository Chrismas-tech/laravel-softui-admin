<?php

namespace App\Http\Livewire\CrudBuilder;

use App\Class\CrudManager;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CrudBuilder extends Component
{
    public bool $isValid = false;
    public string $modelName = 'Article';
    public array $fieldsModel;
    protected $listeners = ['fieldsModelArray' => 'fillFieldsModelArray'];
    public $messages = [];

    public function rules()
    {
        return [
            'modelName' => 'required|string|min:3',
            'fieldsModel' => 'array|min:1',
        ];
    }


    public function createCrud()
    {
        $crudManager = new CrudManager(strtolower($this->modelName), $this->fieldsModel);
        $crudManager->create();
    }

    public function fillFieldsModelArray($fieldsModel)
    {
        $this->fieldsModel = $fieldsModel;

        //Update the component manually after receiving emission
        try {
            $this->validate();
            $this->isValid = true;
        } catch (ValidationException $ex) {
            $this->isValid = false;
        }
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
