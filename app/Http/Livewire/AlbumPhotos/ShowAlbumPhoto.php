<?php

namespace App\Http\Livewire\AlbumPhotos;

use App\Models\AlbumPhoto;
use Livewire\Component;
use App\Models\UploadFile;
use App\Traits\CrudManager\CrudManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class ShowAlbumPhoto extends Component
{
    use CrudManager;
    public Collection $collection;
    public UploadFile $model;
    public string $modelClass = UploadFile::class;
    public AlbumPhoto $album;
    public string $name = '';
    public string $albumName;
    public int $albumId;
    public string $modelId = '';
    protected $listeners = ['reRenderParent' => '$refresh'];

    public $messages = [
        'name.required' => 'This field is required.',
        'generalSearchTerm.min' => 'Search box must contain at least three letters.'
    ];

    public function rules()
    {
        return [
            'name' => 'string|min:3',
        ];
    }

    public function updated($propertyName)
    {
        try {
            $this->validate();
            $this->isValidEdit = true;
        } catch (ValidationException $ex) {
            $this->isValidEdit = false;
        }

        $this->validateOnly($propertyName);
    }

    public function mount($album, $files)
    {
        $this->collection = $files;
        $this->album = $album;
        $this->albumName = $album->name;
        $this->albumId = $album->id;
        $this->orderByColumn = 'id';
    }

    /**
     * This function cannot be deleted because it is used for update and duplicate entry
     * Configure here the fields to fill in relations with declared properties
     */
    private function populateModel($id)
    {
        $this->model = $this->modelClass::where('id', $id)->first();
        $this->modelId = $id;
        $this->name = $this->model->name;
    }

    public function render()
    {
        $q = $this->modelClass::query();
        $this->nbGeneralSearchResults = $q->count();
        $q = $q->orderBy('id', $this->orderBy)->paginate($this->resultsPerPage);

        return view('livewire.album-photos.show-album-photo', [
            'collectionPagination' => $q,
            'numberResults' => $this->modelClass::where('model_id', $this->albumId)->count(),
            'nbGeneralSearchResults' => $this->nbGeneralSearchResults,
        ]);
    }
}
