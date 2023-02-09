<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Models\YoutubeVideo;
use App\Traits\DatabaseManager;
use Illuminate\Validation\ValidationException;
use App\Traits\YoutubeVideos\YoutubeVideosTrait;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class YoutubeVideos extends Component
{
    use DatabaseManager;
    use YoutubeVideosTrait;
    public string $modelName = '';
    public string $modelIframe = '';
    public string $modelId = '';
    public string $modelClass = YoutubeVideo::class;
    public YoutubeVideo $model;
    public array $columns;
    public int $nbGeneralSearchResults;

    public $messages = [
        'modelName.required' => 'This field is required.',
        'modelIframe.required' => 'This field is required.',
        'modelIframe.regex' => 'The Iframe is not correct, please copy it again directly from your Youtube video.',
        'generalSearchTerm.min' => 'Search box must contain at least three letters.'
    ];

    public function rules()
    {
        return [
            'generalSearchTerm' => 'string|min:3',
            'modelName' => 'required|string|min:3',
            'modelIframe' => 'required|string|regex:' . $this->regexIframe,
        ];
    }

    public function updated($propertyName)
    {
        try {
            $this->validate();
            $this->isValid = true;
        } catch (ValidationException $ex) {
            $this->isValid = false;
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
        $this->modelName = $this->model->name;
        $this->modelIframe = $this->model->iframe;
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

        return view('livewire.youtube-videos.youtube-videos', [
            'collectionPagination' => $q,
            'numberResults' => $this->modelClass::all()->count(),
            'nbGeneralSearchResults' => $this->nbGeneralSearchResults,
        ]);
    }
}
