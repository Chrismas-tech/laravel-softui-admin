@php
    $invoices = App\Models\Invoice::where('user_id', $value)->get();
@endphp

<div class="d-flex justify-content-center">
    <button wire:click="DownloadAllInvoices({{ $value }})" type="button" class="btn badge-light-success"><i class="fa-solid fa-download"></i>
        Download All Invoices in PDF</button>
</div>

<hr>

<div class="d-flex justify-content-between">
    <select multiple wire:model="selectedInvoices" class="form-select me-2" name="invoice-select" id="invoice-select">
        <option value="">--Select/Download Invoices in PDF--</option>
        @foreach ($invoices as $invoice)
            <option value="{{ $invoice->id }}">Invoice n°{{ $invoice->invoice_number }}</option>
        @endforeach
    </select>
    <button wire:click="DownloadSelectedInvoices()" type="button" class="btn badge-light-info"><i
            class="fa-solid fa-download"></i></button>
</div>
