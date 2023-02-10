<?php

namespace App\Traits\CrudManager\Update;

use App\Actions\Database\UpdateEntry;

trait Update
{
    public bool $editEntryModal = false;

    public function editEntryModal($id)
    {
        $this->editEntryModal = true;
        $this->populateModel($id);
    }

    public function updateEntry()
    {
        if (UpdateEntry::run($this->model, $this->validate())) {
            $this->notifySuccess = 'Your ' . str_replace('App\Models\\', '', $this->modelClass) . ' has been successfully updated !';
            $this->model = new $this->modelClass();
        } else {
            $this->notifyError = true;
        }
        $this->editEntryModal = false;
    }
}
