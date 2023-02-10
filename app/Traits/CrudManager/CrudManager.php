<?php

namespace App\Traits\CrudManager;

use App\Traits\CrudManager\Duplicate\Duplicate;
use App\Traits\CrudManager\Delete\Delete;
use App\Traits\CrudManager\Update\Update;
use Livewire\WithPagination;

trait CrudManager
{
    use WithPagination;
    use Update;
    use Delete;
    use Duplicate;

    protected $paginationTheme = 'bootstrap';
    public array $selected = [];
    public bool $isValid = true;
    public bool $selectAll = true;
    public string $resultsPerPage = '5';
    public bool $toggleOrderBy = true;
    public string $orderBy = 'desc';
    public string $notifySuccess = '';
    public bool $notifyError = false;
    public string $generalSearchTerm = '';

    public function toggleOrderBy()
    {
        $this->toggleOrderBy = !$this->toggleOrderBy;
        $this->toggleOrderBy === false ? $this->orderBy = 'asc' : $this->orderBy = 'desc';
    }

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
}
