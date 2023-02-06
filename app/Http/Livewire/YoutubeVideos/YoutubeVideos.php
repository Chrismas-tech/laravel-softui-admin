<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Actions\YoutubeVideos\DeleteSingleYoutubeVideo;
use App\Actions\YoutubeVideos\DeleteYoutubeVideos;
use App\Actions\YoutubeVideos\UpdateYoutubeVideo;
use App\Models\YoutubeVideo;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;

class YoutubeVideos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public array $selected = [];
    public bool $selectExist = false;
    public bool $confirmDeletionSelected = false;
    public bool $confirmDeletionSingleEntry = false;
    public bool $editEntryModal = false;
    public bool $isValid = true;
    public YoutubeVideo $video;
    public string $videoName = '';
    public string $videoIframe = '';
    public string $videoId = '';
    public string $numberResults = '5';

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

    public function toggleSelection($id)
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_diff($this->selected, [$id]);
        } else {
            array_push($this->selected, $id);
        }

        if (empty($this->selected)) {
            $this->selectExist = false;
        } else {
            $this->selectExist = true;
        }
    }

    public function confirmDeletionSelected()
    {
        $this->confirmDeletionSelected = true;
    }

    public function confirmDeletionSingleEntry($id)
    {
        $this->confirmDeletionSingleEntry = true;
        $this->video = YoutubeVideo::where('id', $id)->first();
        $this->videoId = $id;
        $this->videoName = $this->video->name;
    }


    public function deleteSelection()
    {
        if (DeleteYoutubeVideos::run($this->selected)) {
            session()->flash('success', 'Your videos are successfully deleted !');
            redirect()->route('admin.youtube-videos.index');
        } else {
            session()->flash('error', 'Something went wrong, please retry !');
        }
    }

    public function deleteSingleEntry($id)
    {
        if (DeleteSingleYoutubeVideo::run($id)) {
            session()->flash('success', 'Your video has been successfully deleted !');
            redirect()->route('admin.youtube-videos.index');
        } else {
            session()->flash('error', 'Something went wrong, please retry !');
        }
    }

    public function editEntryModal($id)
    {
        $this->editEntryModal = true;
        $this->video = YoutubeVideo::where('id', $id)->first();
        $this->videoId = $id;
        $this->videoName = $this->video->name;
        $this->videoIframe = $this->video->iframe;
    }

    public function updateEntry()
    {
        if (UpdateYoutubeVideo::run($this->video, $this->validate())) {
            session()->flash('success', 'Your video has been successfully updated !');
            redirect()->route('admin.youtube-videos.index');
        } else {
            session()->flash('error', 'Something went wrong, please retry !');
        }
    }

    public function render()
    {
        return view('livewire.youtube-videos.youtube-videos', ['youtubeVideos' => YoutubeVideo::paginate($this->numberResults)]);
    }
}
