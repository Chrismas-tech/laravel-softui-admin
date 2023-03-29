<?php

namespace App\Actions\Exports;

use App\Actions\Database\Folders\CreateFolder;
use App\Actions\Database\Folders\DeleteFolder;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\File;
use ZipArchive;

class UserInvoicesPdf
{
    use AsAction;

    public function handle(array $attributes)
    {
        $invoices = Invoice::whereIn('id', $attributes)->get();
        $folderPathTmp = storage_path('app/private/invoices-temp/');
        CreateFolder::run($folderPathTmp);

        foreach ($invoices as $invoice) {
            $pdfContent = PDF::loadView('pdf.customer-invoice', ['invoice' => $invoice])->output();
            $filePath = $folderPathTmp . '/Invoice-n°' . $invoice->invoice_number . '-' . date('d-m-Y') . '.pdf';
            file_put_contents($filePath, $pdfContent);
        }

        $zipName = 'invoices.zip';
        $zip = new ZipArchive();
        $zip->open($zipName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $files = File::files($folderPathTmp);

        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }

        $zip->close();

        DeleteFolder::run($folderPathTmp);

        return $zipName;
    }
}
