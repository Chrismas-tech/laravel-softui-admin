<!-- Delete Mutiple Entries-->
<x-jet-dialog-modal wire:model="confirmDeletionSelected">
    <x-slot name="title">
        {{ __('Delete these/this Entry(ies) ?') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete this/these Entry(ies) ?') }}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmDeletionSelected')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-danger-button wire:click="deleteSelection" wire:loading.attr="disabled">
            <div wire:loading wire:target="deleteSelection" class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

            {{ __('Confirm') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
<!-- Delete Mutiple Entries-->
