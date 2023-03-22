@if ($notifySuccess)
    <div class="alert alert-success text-white text-sm me-2 mb-0 py-1 px-2 mt-1 mb-1" style="width: fit-content">
        {{ $notifySuccess }}
    </div>
@endif
@if ($notifyError)
    <div class="alert alert-danger text-white text-sm me-2 mb-0 py-1 px-2 mt-1 mb-1" style="width: fit-content">
        Something went wrong, please retry !
    </div>
@endif
