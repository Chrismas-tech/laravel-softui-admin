<?php

namespace App\Traits;

use App\Actions\Database\DeleteEntries;
use App\Actions\Database\DuplicateEntry;
use App\Actions\Database\UpdateEntry;
use Illuminate\Support\Facades\Artisan;
use Livewire\WithPagination;

trait DatabaseManager
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public array $selected = [];
    public bool $DeleteButtonExist = false;
    public bool $confirmDeletionSelected = false;
    public bool $editEntryModal = false;
    public bool $duplicateEntryModal = false;
    public bool $isValid = true;
    public bool $selectAll = true;
    public string $resultsPerPage = '5';
    public bool $toggleOrderBy = true;
    public string $orderBy = 'desc';
    public string $notifySuccess = '';
    public bool $notifyError = false;
    public string $generalSearchTerm = '';
/*     public array $filterBy = []; */

    public function toggleOrderBy()
    {
        $this->toggleOrderBy = !$this->toggleOrderBy;
        $this->toggleOrderBy === false ? $this->orderBy = 'asc' : $this->orderBy = 'desc';
    }

/*     public function updateInputValue($event, $name)
    {
        $this->filterBy[$name] = $event;
    } */

    public function toggleSelection($id)
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_diff($this->selected, [$id]);
        } else {
            array_push($this->selected, $id);
        }
        $this->DeleteButtonExist();
    }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;

        if (!$this->selectAll) {
            $this->selected = [];
            $model = $this->modelClass::all();
            foreach ($model as $entry) {
                array_push($this->selected, $entry->id);
            }
        } else {
            $this->selected = [];
        }

        $this->DeleteButtonExist();
    }

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
        $this->populateModel($id);
    }

    public function editEntryModal($id)
    {
        $this->editEntryModal = true;
        $this->populateModel($id);
    }
}
