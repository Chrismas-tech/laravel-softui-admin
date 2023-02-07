<?php

namespace App\Http\Livewire\AlbumPhotos;

use App\Actions\Database\DeleteEntries;
use App\Actions\Database\DuplicateEntry;
use App\Models\AlbumPhoto;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AlbumPhotos extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public array $selected = [];
    public bool $DeleteButtonExist = false;
    public bool $confirmDeletionSelected = false;
    public bool $editEntryModal = false;
    public bool $duplicateEntryModal = false;
    public bool $isValid = true;
    public bool $isUploadValid = false;

    public bool $selectAll = true;
    public string $resultsPerPage = '5';
    public string $notifySuccess = '';
    public bool $notifyError = false;

    public AlbumPhoto $model;
    public string $modelId = '';

    public string $modelName = '';
    public string $modelIframe = '';

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
            $collection = AlbumPhoto::all();
            foreach ($collection as $video) {
                array_push($this->selected, $video->id);
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
        if (DeleteEntries::run($this->selected)) {
            $this->notifySuccess = 'Your photo album(s) has/have been successfully deleted !';
        } else {
            $this->notifyError = true;
        }

        $this->confirmDeletionSelected = false;
    }

    public function duplicateEntryModal($id)
    {
        $this->duplicateEntryModal = true;
        $this->populateModel($id);
    }

    public function duplicate()
    {
        if (DuplicateEntry::run($this->albumPhoto)) {
            $this->notifySuccess =  'Your photo album(s) has/have been successfully duplicated !';
        } else {
            $this->notifyError = true;
        }

        $this->duplicateEntryModal = false;
    }

    public function editEntryModal($id)
    {
        $this->editEntryModal = true;
        $this->populateModel($id);
    }

    public function updateEntry()
    {
        if (UpdateAlbumPhoto::run($this->video, $this->validate())) {
            $this->notifySuccess = 'Your video has been successfully updated !';
        } else {
            $this->notifyError = true;
        }
        $this->editEntryModal = false;
    }

    private function populateModel($id)
    {
        $this->model = AlbumPhoto::where('id', $id)->first();
        $this->modelId = $id;
        $this->modelName = $this->model->name;
        $this->modelIframe = $this->model->iframe;
    }

    public function render()
    {
        return view('livewire.album-photos.album-photos', [
            'collectionPagination' => AlbumPhoto::orderBy('created_at', 'desc')->paginate($this->resultsPerPage),
            'numberResults' => AlbumPhoto::all()->count(),
        ]);
    }
}
