<div>
    <x-jet-dialog-modal wire:model="openEditModal">
        <x-slot name="title">
            {{ __('Edit Modal') }}
        </x-slot>

        <x-slot name="content">
            <div class="form-group">
                <label>Video Name</label>
                <input wire:model="name" type="text" class="form-control" placeholder="Video Name" id="name">
                @error('name')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Video Iframe</label>
                <textarea wire:model="iframe" placeholder="Video Iframe" class="form-control" id="exampleFormControlTextarea1"
                    rows="4"></textarea>
                @error('iframe')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <button {{ $isValidUpdate ? '' : 'disabled' }} wire:click="UpdateVideo" type="button"
                class="btn btn-success">Update</button>
            <x-jet-secondary-button wire:click="$set('openEditModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
