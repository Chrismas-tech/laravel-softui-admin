<?php

namespace App\Traits\CrudManager\Toggles;

trait Toggles
{
    public bool $toggleOrderBy = true;
    public array $selected = [];
    public bool $selectAll = true;
    public string $orderBy = 'desc';

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
