<?php

namespace App\Actions\Exports;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class UsersPdf
{
    use AsAction;

    public function handle(Collection $attributes)
    {
        $users = User::whereIn('id', $attributes)->get();
        $pdfContent = PDF::loadView('pdf.customers-list', ['users' => $users])->output();

        return response()->streamDownload(
            fn () => print($pdfContent),
            "customers-list.pdf"
        );
    }
}
