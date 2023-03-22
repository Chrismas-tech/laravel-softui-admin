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

    @if ($progress > 0 && $progress < 99)
        <!-- Progress Bar -->
        <div class="progress-wrapper mt-3 mb-3">
            <div class="progress-info">
                <div class="progress-percentage">
                    <span class="text-sm font-weight-bold">{{ $progress }}%</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                    aria-valuemax="100" style="width: {{ $progress }}%;"></div>
            </div>
        </div>
        <!-- Progress Bar -->
    @endif
</div>
