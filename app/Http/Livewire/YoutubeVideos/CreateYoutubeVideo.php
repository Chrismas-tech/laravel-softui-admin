<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Actions\YoutubeVideos\CreateYoutubeVideo as CreateYoutubeVideoAction;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateYoutubeVideo extends Component
{
    protected $paginationTheme = 'bootstrap';

    public string $videoName = '';
    public string $videoIframe = '';
    public bool $isValid = false;

    public $messages = [
        'videoName.required' => 'This field is required.',
        'videoIframe.required' => 'This field is required.',
        'videoIframe.regex' => 'Your Iframe must beginning by <iframe> and finish by </iframe>.',
    ];

    public function rules()
    {
        return [
            'videoName' => 'required|string|min:3',
            'videoIframe' => 'required|string|regex:/^<iframe[^<]*<\/iframe>$/',
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

    public function createEntry()
    {
        if (CreateYoutubeVideoAction::run($this->validate())) {
            session()->flash('success', 'Your video has been successfully created !');
            redirect()->route('admin.youtube-videos.index');
        } else {
            session()->flash('error', 'Something went wrong, please retry !');
        }
    }

    public function render()
    {
        return view('livewire.youtube-videos.create-youtube-video');
    }
}
