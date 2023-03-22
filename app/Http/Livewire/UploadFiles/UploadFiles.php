<?php

namespace App\Http\Livewire\UploadFiles;

use App\Actions\Database\StoreUploadfiles;
use App\Models\UploadFile;
use App\Traits\CrudManager\CrudManager;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class UploadFiles extends Component
{
    use CrudManager;
    public UploadFile $model;
    public string $modelClass = UploadFile::class;
    public string $modelName = '';
    public string $modelIframe = '';
    public string $modelId = '';
    public int $ratioToMegaBytes = 1048;
    public int $NbFiles = 10;
    public int $limitSizePerFile = 20; //mo
    public int $progress = 0;
    public bool $isValid = false;
    public $files = [];

    public function rules()
    {
        return [
            'files' => 'max:' . $this->NbFiles,
            'files.*' => 'max:' . $this->limitSizePerFile * $this->ratioToMegaBytes,
        ];
    }

    public function messages()
    {
        return [
            'files.*.max' => 'The :attribute file must not be greater than ' . $this->limitSizePerFile . ' mo.',
            'files.max' => 'Number of files must not be exceed :max .',
        ];
    }

    public function resetFiles()
    {
        $this->files = [];
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

    private function createUploadFilesDirectory()
    {
        $folderPath = storage_path('app/private/uploads/');
        $permissions = 0777;

        if (!is_dir($folderPath)) {
            mkdir($folderPath, $permissions, true);
        }
    }

    public function upload()
    {
        $this->progress = 0;
        $this->createUploadFilesDirectory();

        foreach ($this->files as $file) {
            $filePath = $file->store('private/uploads');
            $fileSize = round($file->getSize() / 1048576, 2);
            $folderPath = storage_path('app/private/uploads/');
            $fileName = $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();

            if (!StoreUploadfiles::run($fileName, $filePath, $fileSize, $folderPath, $fileType)) {
                $this->notifyError = true;
            }

            $this->progress += 100 / count($this->files);
        }
        $this->files = [];
        $this->notifySuccess = 'Your file(s) has/have been successfully uploaded !';
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
        return view('livewire.upload-files.upload-files', [
            'collectionPagination' => $q,
            'numberResults' => $this->modelClass::all()->count(),
            'nbGeneralSearchResults' => $this->nbGeneralSearchResults,
        ]);
    }
}
