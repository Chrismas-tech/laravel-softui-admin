<?php

namespace App\Http\Livewire\CrudBuilder;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AddFieldsModel extends Component
{
    public string $fieldName = '';
    public string $selectTypeValues = '';
    public string $typeValue = '';
    public string $typeField;
    public string $descTypeField = '';
    public array $fieldsModel = [];
    public int $index = 0;
    public bool $isValid;
    public bool $isDefault = false;
    public array $checkboxFieldsChoices = [];
    public string $defaultValue;
    public array $defaultValuesType = [
        'Numeric types' => [
            'bigIncrements' => 'Incrementing ID using a "big integer" equivalent',
            'bigInteger' => 'BIGINT equivalent to the table',
            'decimal' => 'DECIMAL equivalent with a precision and scale',
            'double' => 'DOUBLE equivalent with precision, 15 digits in total and 8 after the decimal point',
            'increments' => 'Incrementing ID to the table (primary key)',
            'integer' => 'INTEGER equivalent to the table',
            'mediumInteger' => 'MEDIUMINT equivalent to the table',
            'smallInteger' => 'SMALLINT equivalent to the table',
            'tinyInteger' => 'TINYINT equivalent to the table',
        ],
        'Date and Time types' => [
            'date' => 'DATE equivalent to the table',
            'dateTime' => 'DATETIME equivalent to the table',
            'time' => 'TIME equivalent to the table',
            'timestamp' => 'TIMESTAMP equivalent to the table',
            'timestamps' => 'Adds created_at and updated_at columns',
            'nullableTimestamps' => 'Same as timestamps(), except allows NULLs',
        ],
        'String types' => [
            'char' => 'CHAR equivalent with a length',
            'string' => 'VARCHAR equivalent column',
            'mediumText' => 'MEDIUMTEXT equivalent to the table',
            'longText' => 'LONGTEXT equivalent to the table',
            'text' => 'TEXT equivalent to the table',
        ],
        'Other types' => [
            'binary' => 'BLOB equivalent to the table',
            'boolean' => 'BOOLEAN equivalent to the table',
            'enum' => 'ENUM equivalent to the table',
            'float' => 'FLOAT equivalent to the table',
            'json' => 'JSON equivalent to the table',
            'jsonb' => 'JSONB equivalent to the table',
            'morphs' => 'Adds INTEGER taggable_id and STRING taggable_type',
            'softDeletes' => 'Adds deleted_at column for soft deletes',
            'rememberToken' => 'Adds remember_token as VARCHAR(100) NULL',
        ],
    ];
    public array $checkboxFieldsDefault = [
        'nullable',
        'unique',
        'unsigned',
        'default',
        'foreignKey'
    ];

    public function rules()
    {
        return [
            'fieldName' => 'required|string',
            'selectTypeValues' => 'required|string',
        ];
    }

    public function updatedcheckboxFieldsChoices()
    {
        in_array('default', $this->checkboxFieldsChoices) ? $this->isDefault = true : $this->isDefault = false;
    }

    public function updatedSelectTypeValues()
    {
        $selectTypeValues = json_decode($this->selectTypeValues);
        $this->descTypeField = $this->defaultValuesType[$selectTypeValues[0]][$selectTypeValues[1]];
        $this->typeValue = $selectTypeValues[0];
        $this->typeField = $selectTypeValues[1];
    }

    public function addFieldToModel()
    {
        try {
            $this->validate();
            $this->isValid = true;
            $this->fieldsModel[] = [$this->typeValue, $this->typeField, $this->fieldName, $this->checkboxFieldsChoices];
            $this->fieldName = '';
        } catch (ValidationException $ex) {
            $this->isValid = false;
        }
    }

    public function removeFieldToModel($indexType)
    {
        unset($this->fieldsModel[$indexType]);
        if (empty($this->fieldsModel[$indexType])) {
            unset($this->fieldsModel[$indexType]);
        }
        $this->fieldsModel = array_values($this->fieldsModel);
    }

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

    public function actualizeFieldModel($typeField, $index)
    {
        $this->fieldsModel[$typeField][$index] =  $this->fieldsModel[$typeField][$index];
    }

    public function updated($propertyName)
    {
        try {
            $this->validate();
            $this->isValid = true;
        } catch (ValidationException $ex) {
            /* dd($ex); */
            $this->isValid = false;
        }

        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->emit('fieldsModelArray', $this->fieldsModel);
        return view(
            'livewire.crud-builder.add-field-model'
        );
    }
}
