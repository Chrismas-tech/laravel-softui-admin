<?php

namespace App\Http\Livewire\CrudBuilder;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AddFieldsModel extends Component
{
    public string $fieldName;
    public string $valueType = 'string';
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
        if (array_key_exists($index - 1, $this->fieldsModel[$this->valueType])) {
            $temp = $this->fieldsModel[$this->valueType][$index];
            $this->fieldsModel[$this->valueType][$index] = $this->fieldsModel[$this->valueType][$index - 1];
            $this->fieldsModel[$this->valueType][$index - 1] = $temp;
        }
    }

    public function downIndex($index)
    {
        if (array_key_exists($index + 1, $this->fieldsModel[$this->valueType])) {
            $temp = $this->fieldsModel[$this->valueType][$index];
            $this->fieldsModel[$this->valueType][$index] = $this->fieldsModel[$this->valueType][$index + 1];
            $this->fieldsModel[$this->valueType][$index + 1] = $temp;
        }
    }

    public function addFieldToModel()
    {
        $this->validate();
        $this->fieldsModel[$this->valueType][$this->index] =  $this->fieldName;
        $this->index++;
        $this->fieldName = '';
        $this->isValid = false;
    }

    public function actualizeFieldModel($valueType, $index)
    {
        $this->fieldsModel[$this->valueType][$index] =  $this->fieldsModel[$this->valueType][$index];
    }

    public function removeFieldToModel($valueType, $index)
    {
        unset($this->fieldsModel[$valueType][$index]);
        if (empty($this->fieldsModel[$valueType])) {
            unset($this->fieldsModel[$valueType]);
        }
    }

    public function rules()
    {
        return [
            'fieldName' => 'required|string|min:3',
            'valueType' => 'required|string',
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
