<?php

namespace App\Http\Livewire\AlbumPhotos;

use App\Models\AlbumPhoto;
use App\Traits\CrudManager\CrudManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AlbumPhotos extends Component
{
    use CrudManager;
    public AlbumPhoto $model;
    public string $modelClass = AlbumPhoto::class;
    public string $name = '';
    public string $modelId = '';
    public array $columns;
    public int $nbGeneralSearchResults;
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

    public function mount()
    {
        $model = new $this->modelClass();
        $this->columns = Schema::getColumnListing($model->getTable());
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
        if ($this->generalSearchTerm) {
            $q->where(function ($query) {
                foreach ($this->columns as $value) {
                    $query->orWhere($value, 'like', '%' . strtolower($this->generalSearchTerm) . '%');
                }
            });
        }
        $this->nbGeneralSearchResults = $q->count();
        $q = $q->orderBy('created_at', $this->orderBy)->paginate($this->resultsPerPage);

        return view('livewire.album-photos.album-photos', [
            'collectionPagination' => $q,
            'numberResults' => $this->modelClass::all()->count(),
            'nbGeneralSearchResults' => $this->nbGeneralSearchResults,
        ]);
    }
}
