<?php

namespace App\Http\Livewire\UploadFile;

use App\Traits\CrudManager\Notifications\Notifications;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadMultipleFiles extends Component
{
    use WithFileUploads;
    use Notifications;
    public int $NbFiles = 5;
    public int $limitSizePerFile = 2048;
    public int $progress = 0;
    public bool $isValid = false;
    public $files = [];

    public function rules()
    {
        return [
            'files' => 'max:' . $this->NbFiles,
            'files.*' => 'image|max:' . $this->limitSizePerFile,
        ];
    }

    public function messages()
    {
        return [
            'files.*.image' => 'Only image formats are allowed.',
            'files.*.max' => 'The :attribute file must not be greater than :max Mo.',
            'files.max' => 'Number of files must not be exceed :max .',
        ];
    }

    public function updated()
    {
        try {
            $this->validate();
            $this->isValid = true;
        } catch (ValidationException $ex) {
            $this->isValid = false;
        }

        $this->validate();
    }


    public function upload()
    {
        $this->progress = 0;

        foreach ($this->files as $file) {
            $path = $file->store('uploads');
            // Traitez le fichier ici, comme enregistrer son chemin dans une base de données
            $this->progress += 100 / count($this->files);
        }

        $this->notifySuccess = 'Les fichiers ont été téléchargés avec succès!';
    }

    public function render()
    {
        return view('livewire.upload-file.upload-multiple-files');
    }
}
