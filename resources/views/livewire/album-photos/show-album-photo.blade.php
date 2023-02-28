<div>
    @include('admin.layouts.collection-pagination')
    <div class="d-flex justify-content-center">
        <h5>{{ $numberResults }} result(s) found</h5>
    </div>
    @include('admin.layouts.notifications')

    <livewire:upload-file.upload-multiple-files>

        <div class="table-responsive">
            <table class="table align-items-center mb-0 table-striped">
                <thead>
                    <tr>
                        <th class="d-flex align-items-center justify-content-end text-dark font-weight-bolder opacity-7">
                            <div class="d-flex align-items-center">
                                <button type="button"
                                    class="btn {{ count($selected) ? 'me-3' : '' }} {{ $selectAll ? 'bg-gradient-success' : 'bg-gradient-warning me-3' }}  mb-0 d-flex align-items-center justify-content-center"
                                    wire:click="toggleSelectAll">
                                    @if ($selectAll)
                                        <i class="fa fa-check me-2" aria-hidden="true"></i>
                                    @else
                                        <i class="fa-solid fa-check-double me-2"></i>
                                    @endif
                                    {{ $selectAll ? 'Select All' : 'Deselect All' }}
                                </button>
                                @if ($DeleteButtonExist)
                                    <button type="button" class="btn bg-gradient-danger mb-0"
                                        wire:click="confirmDeletionSelected" wire:loading.attr="disabled"> <i
                                            class="fa fa-trash me-2"></i>Delete
                                        Selection
                                    </button>
                                @endif
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="row row-cols-3 g-4">
            @forelse ($collectionPagination as $model)
                <div class="col" style="position:relative;">
                    <div class="d-flex justify-content-center m-1">
                        <img class="img-fluid pointer rounded-3 {{ in_array($model->id, $selected) ? 'border-selected blink' : '' }}"
                            wire:click="toggleSelection({{ $model->id }})" src="{{ asset($model->file_path) }}"
                            alt="" style="border: 5px dashed rgb(255, 255, 255);">
                    </div>
                    <div style="position:absolute;bottom:20px;right:20px;"
                        class="form-check form-switch d-flex justify-content-center align-items-center me-3">
                        <input class="form-check-input" wire:click="toggleSelection({{ $model->id }})"
                            type="checkbox" {{ in_array($model->id, $selected) ? 'checked' : '' }}
                            id="flexSwitchCheckDefault">
                    </div>
                </div>
            @empty
            @endforelse
        </div>


        @include('admin.layouts.collection-pagination')

        <!-- Modals -->
        @include('admin.layouts.modals.delete-multiple-entries')
        @include('admin.layouts.modals.duplicate-entry-modal')

        <!-- Edit Entry -->
        <x-jet-dialog-modal wire:model="editEntryModal">
            <x-slot name="title">
                Edit your Album Photo #{{ $modelId }} {{ $name }}
            </x-slot>

            <x-slot name="content">
                <div class="mb-3">
                    <label class="form-label" for="">Album Photo Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                        value="{{ $name }}">
                    @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('editEntryModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <button @if (!$isValidEdit) disabled @endif type="button" class="btn btn-success"
                    wire:click="updateEntry({{ $modelId }})" wire:loading.attr="disabled">
                    <div wire:loading wire:target="updateEntry" class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>

                    {{ __('Update') }}
                </button>
            </x-slot>
        </x-jet-dialog-modal>
        <!-- Edit Entry -->

        <!-- Modals -->
</div>
