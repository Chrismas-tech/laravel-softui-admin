<div class="p-3">
    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="form-group mb-0">
            <label for="files">Sélectionner des fichiers</label>
            <input wire:model="files" type="file" class="form-control" id="files" multiple accept="image/*">
        </div>
        <div>
            @error('files')
                <span class="text-danger text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            @error('files.*')
                <span class="text-danger text-sm">{{ $message }}</span>
            @enderror
        </div>
        <button {{ !$isValid ? 'disabled' : '' }} type="submit" class="btn btn-primary mt-3">Upload</button>
    </form>

    <div wire:loading wire:target="upload">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"
                style="width: {{ $progress }}%">
                {{ $progress }}%
            </div>
        </div>
    </div>
</div>
