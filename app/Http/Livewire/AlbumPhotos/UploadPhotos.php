<?php

namespace App\Http\Livewire\AlbumPhotos;

use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadPhotos extends Component
{

    use WithFileUploads;
    public $uploadFiles = [];
    public $index;

    public function rules()
    {
        return [
            'uploadFiles.*' => 'image|max:1024',
        ];
    }

    public $messages = [
        'uploadFiles.*.mimes' => 'Only images format are allowed.',
        'uploadFiles.*.max' => 'File size must be less than 1 MB.',
    ];

    public function mount($index)
    {
        $this->index = $index;
    }

    public function updated()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.album-photos.upload-photos');
    }
}
