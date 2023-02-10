<?php

namespace App\Traits\CrudManager\Duplicate;

use App\Actions\Database\DuplicateEntry;

trait Duplicate
{
    public bool $duplicateEntryModal = false;

    public function duplicate()
    {
        if (DuplicateEntry::run($this->model)) {
            $this->notifySuccess =  $this->notifySuccess = 'Your entry(ies) has/have been successfully duplicated !';
            $this->model = new $this->modelClass();
        } else {
            $this->notifyError = true;
        }

        $this->duplicateEntryModal = false;
    }

    public function duplicateEntryModal($id)
    {
        $this->duplicateEntryModal = true;
        $this->model = $this->modelClass::where('id', $id)->first();
    }
}
