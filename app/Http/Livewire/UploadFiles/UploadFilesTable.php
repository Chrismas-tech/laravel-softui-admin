<?php

namespace App\Http\Livewire\UploadFiles;

use App\Actions\Database\Files\UpdateVisibility;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UploadFile;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UploadFilesTable extends DataTableComponent
{

    use LivewireAlert;

    protected $listeners = ['refreshDatatable'];

    protected $model = UploadFile::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return UploadFile::query()->orderBy('created_at', 'desc');
    }

    public function updateVisibility($id)
    {
        UpdateVisibility::run($id);
    }

    public function refreshDatatable()
    {
        $this->render();
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
            Column::make("Size", "file_size")
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return $value . ' Ko';
                }),
            Column::make("Visibility", "visibility")
                ->sortable()
                ->searchable()
                ->view('livewire.upload-files.visibility'),
            Column::make("Date Creation", "created_at")
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return $value->format('d/m/Y \a\t H:i');
                })
        ];
    }
}
