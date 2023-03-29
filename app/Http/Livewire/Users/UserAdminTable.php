<?php

namespace App\Http\Livewire\Users;

use App\Actions\Exports\UsersExcel;
use App\Actions\Exports\UsersPdf;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserAdminTable extends DataTableComponent
{
    use LivewireAlert;

    protected $model = User::class;
    public array $bulkActions = [
        'exportExcelSelection' => 'Export EXCEL Selection',
        'exportPdfSelection' => 'Export PDF Selection',
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return User::query()/* ->where('role', 'customer') */;
    }

    public function exportExcelSelection()
    {
        if (count($this->getSelected()) > 0) {
            return Excel::download(new UsersExcel($this->getSelected()), 'users.xlsx');
        } else {
            $users = User::all()->pluck('id');
            return Excel::download(new UsersExcel($users), 'users.xlsx');
        }
        $this->clearSelected();
        $this->alert('error', 'You did not select any users to export.');
    }

    public function exportPdfSelection()
    {
        if (count($this->getSelected()) > 0) {
            return UsersPdf::run($this->getSelected());
        } else {
            $users = User::all()->pluck('id');
            return UsersPdf::run($users);
        }
        $this->clearSelected();
        $this->alert('error', 'You did not select any users to export.');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable()
                ->hideIf(true),
            Column::make("Firstname", "firstname")
                ->sortable()
                ->searchable(),
            Column::make("Lastname", "lastname")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Role", "role")
                ->sortable()
                ->searchable()
                ->view('livewire.customers.role'),
        ];
    }
}
