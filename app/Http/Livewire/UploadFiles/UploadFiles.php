<?php

namespace App\Http\Livewire\UploadFiles;

use App\Actions\Database\Files\DeleteFilesInFolder;
use App\Actions\Database\Folders\CreateFolder;
use App\Actions\Database\UploadFiles\StoreUploadfiles;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class UploadFiles extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public int $ratioToMegaBytes = 1048;
    public int $NbFiles = 5;
    public int $limitSizePerFile = 5; //mo
    public string $unit = ' mo';
    public bool $isValid = false;
    public $files = []; // We cannot type hint array, don't know why
    public string $acceptString;
    public string $extensionsString;
    public array $extensions = [
        'jpeg',
        'jpg',
        'png',
        'docx',
        'txt',
        'pdf',
        'xlsx',
        'csv',
        'mp3',
        'wav',
        'mp4',
    ];

    public function rules()
    {
        return [
            'files' => 'max:' . $this->NbFiles,
            'files.*' => 'file|required|max:' . $this->limitSizePerFile * $this->ratioToMegaBytes . '|mimes:' . $this->extensionsString,
        ];
    }

    public function messages()
    {
        return [
            'files.*.max' => 'One of your file does not respect the limitation size of ' . $this->limitSizePerFile . ' mo.',
            'files.max' => 'Number of files must not be exceed :max .',
        ];
    }

    public function mount()
    {
        $this->getAcceptString();
        $this->getExtensionString();
        //Erase temporary files in livewire-tmp
        DeleteFilesInFolder::run(storage_path('app/livewire-tmp'));
    }

    private function getAcceptString()
    {
        $acceptList = array_map(function ($ext) {
            return '.' . trim($ext);
        }, $this->extensions);
        $this->acceptString = implode(',', $acceptList);

        $this->acceptString = '*';
    }

    private function getExtensionString()
    {
        $extensionStringList = '';

        foreach ($this->extensions as $key => $value) {
            if ($key === count($this->extensions) - 1) {
                $extensionStringList .= $value;
            } else {
                $extensionStringList .= $value . ',';
            }
        }

        $this->extensionsString = $extensionStringList;
    }

    public function updatedFiles()
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

        foreach ($this->extensions as $ext) {
            CreateFolder::run(storage_path('app/private/uploads/' . $ext . '/'));
        }

        foreach ($this->files as $file) {

            $fileName = $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();
            $filePath = $file->storeAs('private/uploads/' . $fileType, $fileName);
            $fileSize = round($file->getSize() / 1024, 2);
            $folderPath = 'private/uploads/' . $fileType . '/';

            if (StoreUploadFiles::run(
                $fileName,
                $filePath,
                $fileSize,
                $folderPath,
                $fileType
            )) {
                $this->alert('success', 'Your files has/have been successfully uploaded !');
            } else {
                $this->alert('error', 'An error occured !');
            }
        }

        $this->files = [];
        $this->emit('refreshDatatable');
    }

    public function removeUpload($fileName)
    {
        foreach ($this->files as $key => $file) {
            if ($fileName === $file->getFilename()) {
                unset($this->files[$key]);
            }
        }
        $this->validate();
    }

    public function render()
    {
        return view('livewire.upload-files.upload-files');
    }
}
