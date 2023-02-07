<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Actions\Database\DuplicateEntry;
use App\Actions\Database\DeleteEntries;
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
    public bool $DeleteButtonExist = false;
    public bool $confirmDeletionSelected = false;
    public bool $editEntryModal = false;
    public bool $duplicateEntryModal = false;
    public bool $isValid = true;
    public bool $selectAll = true;
    public YoutubeVideo $video;
    public string $videoName = '';
    public string $videoIframe = '';
    public string $videoId = '';
    public string $resultsPerPage = '5';
    public string $notifySuccess = '';
    public bool $notifyError = false;

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
        $this->DeleteButtonExist();
    }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;

        if (!$this->selectAll) {
            $this->selected = [];
            $videos = YoutubeVideo::all();
            foreach ($videos as $video) {
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
            $this->notifySuccess = 'Your video(s) has/have been successfully deleted !';
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
        if (DuplicateEntry::run($this->video)) {
            $this->notifySuccess =  'Your video(s) has/have been successfully duplicated !';
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
        if (UpdateYoutubeVideo::run($this->video, $this->validate())) {
            $this->notifySuccess = 'Your video has been successfully updated !';
        } else {
            $this->notifyError = true;
        }
        $this->editEntryModal = false;
    }

    private function populateModel($id)
    {
        $this->video = YoutubeVideo::where('id', $id)->first();
        $this->videoId = $id;
        $this->videoName = $this->video->name;
        $this->videoIframe = $this->video->iframe;
    }

    public function render()
    {
        return view('livewire.youtube-videos.youtube-videos', [
            'collectionpagination' => YoutubeVideo::orderBy('created_at', 'desc')->paginate($this->resultsPerPage),
            'numberResults' => YoutubeVideo::all()->count(),
        ]);
    }
}
