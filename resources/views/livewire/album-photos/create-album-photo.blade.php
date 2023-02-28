<div class="p-3">
    <form>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="name">Album Photo Name</label>
                    <input type="text" id="name" placeholder="Album Photo Name"
                        class="form-control @error('name') is-invalid @enderror" wire:model="name">
                    @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button @if (!$isValidCreation) disabled @endif type="button" class="btn btn-success"
                wire:click="createEntry" wire:loading.attr="disabled">
                <div wire:loading wire:target="createEntry" class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                {{ __('Create') }}
            </button>
        </div>
    </form>
</div>
