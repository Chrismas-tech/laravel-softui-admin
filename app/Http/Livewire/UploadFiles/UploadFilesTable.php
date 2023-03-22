<?php

namespace App\Http\Livewire\UploadFiles;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UploadFile;

class UploadFilesTable extends DataTableComponent
{
    protected $model = UploadFile::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable()
                ->hideIf(true),
            Column::make("type", "file_type")
                ->sortable()
                ->hideIf(true),
            Column::make("File Name", "file_name")
                ->sortable()
                ->searchable()
                ->view('livewire.download-files.download-files'),
            Column::make("File Size", "file_size")
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return $value . ' Ko';
                }),
            Column::make("Visibility", "visibility")
                ->sortable()
                ->searchable()
        ];
    }
}
