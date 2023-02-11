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
        if (array_key_exists($index - 1, $this->fieldsModel)) {
            $temp = $this->fieldsModel[$index];
            $this->fieldsModel[$index] = $this->fieldsModel[$index - 1];
            $this->fieldsModel[$index - 1] = $temp;
        }
    }

    public function downIndex($index)
    {
        if (array_key_exists($index + 1, $this->fieldsModel)) {
            $temp = $this->fieldsModel[$index];
            $this->fieldsModel[$index] = $this->fieldsModel[$index + 1];
            $this->fieldsModel[$index + 1] = $temp;
        }
    }

    public function addFieldToModel()
    {
        $this->validate();
        $this->fieldsModel[] = [$this->typeField, $this->fieldName];
        $this->fieldName = '';
        $this->isValid = false;
    }

    public function actualizeFieldModel($typeField, $index)
    {
        $this->fieldsModel[$typeField][$index] =  $this->fieldsModel[$typeField][$index];
    }

    public function removeFieldToModel($indexType)
    {
        unset($this->fieldsModel[$indexType]);
        if (empty($this->fieldsModel[$indexType])) {
            unset($this->fieldsModel[$indexType]);
        }
    }

    public function rules()
    {
        return [
            'fieldName' => 'required|string|min:3',
            'typeField' => 'required|string',
            'fieldsModel.' . $this->typeField . '.*.' . $this->fieldName => 'string|min:3',
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
