@if ($notifySuccess)
    <div class="alert alert-success text-white text-sm ms-2 me-2 mb-0 py-1 px-2 mt-1 mt-1">
        {{ $notifySuccess }}
    </div>
@endif
@if ($notifyError)
    <div class="alert alert-danger text-white text-sm ms-2 me-2 mb-0 py-1 px-2 mt-1 mt-1">
        Something went wrong, please retry !
    </div>
@endif
