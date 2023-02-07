<div>
    <div class="d-flex justify-content-center">
        <form wire:submit.prevent="save" name="form{{ $index }}">
            @csrf
            <label for="uploadFiles" class="btn btn-default mb-0 mt-3 mb-3">
                <i class="fas fa-upload me-1"></i>
                <span>Select your files</span>
            </label>
            <input type="file" id="uploadFiles" wire:model="uploadFiles" multiple hidden accept="image/*">
        </form>
    </div>

    @error('uploadFiles.*')
        <div class="d-flex justify-content-center">
            <div class="alert text-danger bg-white text-sm ms-2 me-2 mb-0 py-1 px-2">
                {{ $message }}
            </div>
        </div>
    @enderror
</div>
