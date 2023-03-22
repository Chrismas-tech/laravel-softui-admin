<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Actions\Database\YoutubeVideos\CreateYoutubeVideo;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateYoutubeVideoForm extends Component
{
    use LivewireAlert;

    public string $name = '';
    public string $iframe = '';
    public bool $isValidCreation = false;
    public string $regexIframe = '/^<iframe\s+width="\d{3,4}"\s+height="\d{3,4}"\s+src="https:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9_-]+"(?:(?!<\/iframe>).)*<\/iframe>$/';

    public $messages = [
        'name.required' => 'This field is required.',
        'iframe.required' => 'This field is required.',
        'iframe.regex' => 'The Iframe is not correct, please copy it again directly from your Youtube video.',
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'iframe' => 'required|string|regex:' . $this->regexIframe,
        ];
    }

    public function updated($propertyName)
    {
        try {
            $this->validate();
            $this->isValidCreation = true;
        } catch (ValidationException $ex) {
            $this->isValidCreation = false;
        }

        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        if (CreateYoutubeVideo::run($this->validate())) {
            $this->alert('success', 'Your entry(ies) has/have been successfully created !');
        } else {
            $this->alert('error', 'An error occured !');
        }

        $this->reset();
    }

    public function render()
    {
        return view('livewire.youtube-videos.create-youtube-video-form');
    }
}
