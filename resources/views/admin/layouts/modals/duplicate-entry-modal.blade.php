<!-- Duplicate Entry -->
<x-jet-dialog-modal wire:model="duplicateEntryModal">
    <x-slot name="title">
        {{ __('Duplicate Entry') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to duplicate this entry ?') }}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('duplicateEntryModal')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-danger-button wire:click="duplicate" wire:loading.attr="disabled">
            <div wire:loading wire:target="duplicate" class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

            {{ __('Confirm') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
<!-- Duplicate Entry -->
