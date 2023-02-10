<div>
    <div class="p-3">
        <div class="row">
            <div class="col-6">
                <label class="form-label" for="modelName">Model Name</label>
                <div class="form-group">
                    <input type="text" id="modelName" placeholder="Article"
                        class="form-control form-control-sm @error('modelName') is-invalid @enderror"
                        wire:model="modelName">
                    @error('modelName')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <livewire:crud-builder.add-fields-model />
    </div>

    <div class="d-flex justify-content-end">
        <button @if (!$isValid) disabled @endif type="button" class="btn btn-success"
            wire:click="createEntry" wire:loading.attr="disabled">
            <div wire:loading wire:target="createEntry" class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

            {{ __('Create') }}
        </button>
    </div>
</div>
