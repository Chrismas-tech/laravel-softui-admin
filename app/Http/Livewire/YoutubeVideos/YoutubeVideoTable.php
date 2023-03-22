<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Actions\Database\DuplicateYoutubeVideo;
use App\Actions\Database\YoutubeVideos\DeleteYoutubeVideo;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\YoutubeVideo;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class YoutubeVideoTable extends DataTableComponent
{
    use LivewireAlert;

    protected $model = YoutubeVideo::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function query(): Builder
    {
        return parent::query();
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable()
                ->hideIf(true),
            Column::make("Name", "Name")
                ->sortable()
                ->searchable(),
            Column::make("Iframe", "Iframe")
                ->sortable()
                ->searchable()
                ->view('livewire.youtube-videos.iframe'),
        ];
    }

    public array $bulkActions = [
        'delete' => 'Delete',
        'duplicate' => 'Duplicate',
    ];

    public function delete()
    {
        if (DeleteYoutubeVideo::run($this->getSelected())) {
            $this->alert('success', 'Your entry(ies) has/have been successfully deleted !');
        } else {
            $this->alert('error', 'An error occured !');
        }
        $this->clearSelected();
        $this->render();
    }

    public function duplicate()
    {
        if (DuplicateYoutubeVideo::run($this->getSelected())) {
            $this->alert('success', 'Your entry(ies) has/have been successfully duplicated !');
        } else {
            $this->alert('error', 'An error occured !');
        }
        $this->clearSelected();
        $this->render();
    }
}
