<?php

namespace App\Traits\CrudManager\Delete;

use App\Actions\Database\DeleteEntries;

trait Delete
{
    public bool $DeleteButtonExist = false;
    public bool $confirmDeletionSelected = false;

    private function DeleteButtonExist()
    {
        if (empty($this->selected)) {
            $this->DeleteButtonExist = false;
        } else {
            $this->DeleteButtonExist = true;
        }
    }

    public function confirmDeletionSelected()
    {
        $this->confirmDeletionSelected = true;
    }

    public function deleteSelection()
    {
        if (DeleteEntries::run($this->modelClass, $this->selected)) {
            $this->notifySuccess =  $this->notifySuccess =  $this->notifySuccess = 'Your entry(ies) has/have been successfully deleted !';
            $this->model = new $this->modelClass();
        } else {
            $this->notifyError = true;
        }

        $this->confirmDeletionSelected = false;
        $this->selectAll = !$this->selectAll;
    }
}
