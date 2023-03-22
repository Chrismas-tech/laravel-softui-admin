<div>
    <h4 class="mb-2">Upload multiple files to the server</h4>

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Specifications</strong></li>
        <li class="list-group-item">Number of files per upload : {{ $NbFiles }}</li>
        <li class="list-group-item">Limit of size per file : {{ $limitSizePerFile }} {{ $unit }}</li>
        <li class="list-group-item">Extension accepted : {{ str_replace(',', ', ', $extensionsString) }}</li>
    </ul>

    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="form-group mb-0">
            <h5>Select your files</h5>
            <input wire:click="resetFiles" wire:model="files" type="file" class="form-control" id="files" multiple
                accept="{{ $acceptString }}">
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
        <div class="d-flex justify-content-center">
            <button {{ $isValid && count($files) ? '' : 'disabled' }} type="submit"
                class="btn btn-primary mt-3">Upload</button>
        </div>
    </form>

    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">
        <!-- Progress Bar -->
        <div x-show="isUploading">
            <progress max="100" x-bind:value="progress"></progress>
        </div>
    </div>
</div>
