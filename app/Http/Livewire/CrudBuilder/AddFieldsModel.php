<?php

namespace App\Http\Livewire\CrudBuilder;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AddFieldsModel extends Component
{
    protected $listeners = ['actualizeField' => 'actualizeFieldModel'];
    public string $fieldName;
    public string $typeField = 'string';
    public array $fieldsModel = [];
    public int $index = 0;
    public bool $isValid;
    public array $defaultValuesType = [
        'bigInteger',
        'binary',
        'boolean',
        'char',
        'date',
        'dateTime',
        'decimal',
        'double',
        'enum',
        'float',
        'increments',
        'integer',
        'json',
        'jsonb',
        'longText',
        'mediumInteger',
        'mediumText',
        'morphs',
        'nullableTimestamps',
        'smallInteger',
        'tinyInteger',
        'softDeletes',
        'string',
        'text',
        'time',
        'timestamp',
        'timestamps',
        'rememberToken',
        'nullable',
        'default',
        'unsigned'
    ];

    public function upIndex($index)
    {
        if (array_key_exists($index - 1, $this->fieldsModel[$this->typeField])) {
            $temp = $this->fieldsModel[$this->typeField][$index];
            $this->fieldsModel[$this->typeField][$index] = $this->fieldsModel[$this->typeField][$index - 1];
            $this->fieldsModel[$this->typeField][$index - 1] = $temp;
        }
    }

    public function inputArray()
    {
        dd('test');
    }

    public function downIndex($index)
    {
        if (array_key_exists($index + 1, $this->fieldsModel[$this->typeField])) {
            $temp = $this->fieldsModel[$this->typeField][$index];
            $this->fieldsModel[$this->typeField][$index] = $this->fieldsModel[$this->typeField][$index + 1];
            $this->fieldsModel[$this->typeField][$index + 1] = $temp;
        }
    }

    public function addFieldToModel()
    {
        $this->validate();
        $this->fieldsModel[$this->typeField][$this->index] =  $this->fieldName;
        $this->index++;
        $this->fieldName = '';
        $this->isValid = false;
    }

    public function actualizeFieldModel($typeField, $index)
    {
        /*  dd($typeField, $index); */
        $this->fieldsModel[$typeField][$index] =  $this->fieldsModel[$typeField][$index];
    }

    public function removeFieldToModel($typeField, $index)
    {
        unset($this->fieldsModel[$typeField][$index]);
        if (empty($this->fieldsModel[$typeField])) {
            unset($this->fieldsModel[$typeField]);
        }
    }

    public function rules()
    {
        return [
            'fieldName' => 'required|string|min:3',
            'typeField' => 'required|string',
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
        return view(
            'livewire.crud-builder.add-field-model',
            [
                'fieldsModel' => $this->fieldsModel,
            ]
        );
    }
}
