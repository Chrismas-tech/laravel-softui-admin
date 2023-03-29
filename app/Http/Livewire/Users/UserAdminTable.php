<?php

namespace App\Http\Livewire\Users;

use App\Actions\Exports\UserInvoicesPdf;
use App\Actions\Exports\UsersExcel;
use App\Actions\Exports\UsersPdf;
use App\Models\Invoice;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class UserAdminTable extends DataTableComponent
{
    use LivewireAlert;

    protected $model = User::class;
    public array $bulkActions = [
        'exportExcelSelection' => 'Export EXCEL Selection',
        'exportPdfSelection' => 'Export PDF Selection',
    ];
    public array $selectedInvoices = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return User::query()->with('invoices')/* ->where('role', 'customer') */;
    }

    public function DownloadSelectedInvoices()
    {
        if (count($this->selectedInvoices)) {
            $zipName = UserInvoicesPdf::run($this->selectedInvoices);
            return response()->download(public_path($zipName))->deleteFileAfterSend(true);
        } else {
            $this->alert('error', 'You must select at least one Invoice to download.');
        }
    }

    public function DownloadAllInvoices($id)
    {
        $invoices = Invoice::where('user_id', $id)->pluck('id')->toArray();
        $zipName = UserInvoicesPdf::run($invoices);
        return response()->download(public_path($zipName))->deleteFileAfterSend(true);
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Firstname')
                ->config([
                    'maxlength' => 5,
                    'placeholder' => 'Search Firtname',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.firstname', 'like', '%' . $value . '%');
                }),
            TextFilter::make('Lastname')
                ->config([
                    'maxlength' => 5,
                    'placeholder' => 'Search Lastname',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.lastname', 'like', '%' . $value . '%');
                }),
            TextFilter::make('Email')
                ->config([
                    'maxlength' => 5,
                    'placeholder' => 'Search Email',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.email', 'like', '%' . $value . '%');
                }),
            SelectFilter::make('E-mail Verified', 'email_verified_at')
                ->setFilterPillTitle('Verified')
                ->options([
                    ''    => 'Any',
                    'yes' => 'Yes',
                    'no'  => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === 'yes') {
                        $builder->whereNotNull('email_verified_at');
                    } elseif ($value === 'no') {
                        $builder->whereNull('email_verified_at');
                    }
                }),
            DateFilter::make('Verified From')
                ->config([
                    'min' => '2020-01-01',
                    'max' => '2021-12-31',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('email_verified_at', '>=', $value);
                }),
        ];
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
            Column::make('Invoices', 'id')
                ->sortable()
                ->view('livewire.customers.invoice'),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Email Verified", "email_verified_at")
                ->sortable()
                ->searchable(),
            Column::make("Role", "role")
                ->sortable()
                ->searchable()
                ->view('livewire.customers.role'),
        ];
    }

    public function exportExcelSelection()
    {
        if (count($this->getSelected()) > 0) {
            $this->clearSelected();
            return Excel::download(new UsersExcel($this->getSelected()), 'users.xlsx');
        } else {
            $users = User::all()->pluck('id');
            $this->clearSelected();
            return Excel::download(new UsersExcel($users), 'users.xlsx');
        }
    }

    public function exportPdfSelection()
    {
        if (count($this->getSelected()) > 0) {
            $this->clearSelected();
            return UsersPdf::run($this->getSelected());
        } else {
            $users = User::all()->pluck('id');
            $this->clearSelected();
            return UsersPdf::run($users);
        }
        $this->clearSelected();
    }
}
