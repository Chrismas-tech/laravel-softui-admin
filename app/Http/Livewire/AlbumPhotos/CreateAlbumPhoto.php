<?php

namespace App\Http\Livewire\AlbumPhotos;

use App\Actions\Database\CreateEntry;
use App\Models\AlbumPhoto;
use App\Traits\CrudManager\Notifications\Notifications;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateAlbumPhoto extends Component
{

    public string $name = '';
    public bool $isValidCreation = false;

    public $messages = [
        'name.required' => 'This field is required.',
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:album_photos,name',
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

    public function createEntry()
    {
        if (CreateEntry::run(AlbumPhoto::make(), $this->validate())) {
            $this->notifySuccess = 'Your entry(ies) has/have been successfully created !';
            $this->name = '';
            $this->emitUp('reRenderParent');
        } else {
            $this->notifyError = true;
        }
    }
}
