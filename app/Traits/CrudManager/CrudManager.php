<?php

namespace App\Traits\CrudManager;

use App\Traits\CrudManager\Duplicate\Duplicate;
use App\Traits\CrudManager\Delete\Delete;
use App\Traits\CrudManager\Toggles\Toggles;
use App\Traits\CrudManager\Update\Update;
use Livewire\WithPagination;

trait CrudManager
{
    use WithPagination;
    use Update;
    use Delete;
    use Duplicate;
    use Toggles;

    protected $paginationTheme = 'bootstrap';
    public string $resultsPerPage = '5';
    public string $notifySuccess = '';
    public bool $notifyError = false;
    public bool $isValidEdit = true;
    public string $generalSearchTerm = '';
}
