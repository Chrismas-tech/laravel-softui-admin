<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Models\YoutubeVideo;
use App\Traits\DatabaseManager;
use Livewire\Component;

class YoutubeVideos extends Component
{
    use DatabaseManager;
    public string $modelName = '';
    public string $modelIframe = '';
    public string $modelId = '';
    public string $modelClass = YoutubeVideo::class;
    public YoutubeVideo $model;

    public $messages = [
        'modelName.required' => 'This field is required.',
        'modelIframe.required' => 'This field is required.',
        'modelIframe.regex' => 'Your Iframe must beginning by <iframe> and finish by </iframe>.',
    ];

    public function rules()
    {
        return [
            'modelName' => 'required|string|min:3',
            'modelIframe' => 'required|string|regex:/^<iframe[^<]*<\/iframe>$/',
        ];
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
        return view('livewire.youtube-videos.youtube-videos', [
            'collectionPagination' => $this->modelClass::orderBy('created_at', 'desc')->paginate($this->resultsPerPage),
            'numberResults' => $this->modelClass::all()->count(),
        ]);
    }
}
