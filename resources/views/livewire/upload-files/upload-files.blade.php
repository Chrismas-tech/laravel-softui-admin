<div class="p-3">
    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="form-group mb-0">
            <label for="files">Select your files</label>
            <input wire:click="resetFiles" wire:model="files" type="file" class="form-control" id="files" multiple
                accept="*">
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

    @include('admin.layouts.notifications')

    <div class="d-flex justify-content-between px-3 py-3 bg-light">
        <div>
            <input type="text"
                class="form-control form-control form-lg @error('generalSearchTerm') is-invalid @enderror"
                wire:model.debounce.400ms="generalSearchTerm" placeholder="Search something..." style="width:400px;">
            <div class="pl-3">
                @if (!($nbGeneralSearchResults === $numberResults || $nbGeneralSearchResults === 0))
                    <span class="text-dark text-xxs">{{ $nbGeneralSearchResults }} Result(s) for your search</span>
                @endif
                @error('generalSearchTerm')
                    <span class="text-danger text-xxs">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="px-3 d-flex align-items-center">

            <div class="d-flex align-items-center me-4 text-sm" style="cursor: pointer" wire:click="toggleOrderBy">
                <span class="me-1" style="cursor: pointer">Order</span>
                @if ($toggleOrderBy)
                    <i class="fa-solid fa-arrow-up-a-z"></i>
                @else
                    <i class="fa-solid fa-arrow-up-z-a"></i>
                @endif
            </div>

            <div class="d-flex align-items-center text-sm">
                <div class="me-2">Results Per Page</div>
                <select name="resultsPerPage" class="form-control form-select m-0" wire:model="resultsPerPage">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-items-center mb-0 table-striped">
            <thead>
                <tr>
                    <th class="text-dark font-weight-bolder opacity-7">
                        <div class="d-flex justify-content-between ">
                            <span class="me-1">Files</span>
                        </div>
                    </th>
                    <th class="text-dark font-weight-bolder opacity-7">
                        <div class="d-flex justify-content-between ">
                            <span class="me-1">Type</span>
                        </div>
                    </th>
                    <th
                        class="d-flex align-items-center justify-content-between text-dark font-weight-bolder opacity-7">
                        <span class="me-3">Actions</span>
                        <div class="d-flex align-items-center">
                            <button type="button"
                                class="btn {{ count($selected) ? 'me-3' : '' }} {{ $selectAll ? 'bg-gradient-success' : 'bg-gradient-warning me-3' }} mb-0 d-flex align-items-center justify-content-center"
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
            <tbody>
                @forelse ($collectionPagination as $model)
                    <tr>
                        <td>
                            <div class="d-flex justify-content-center">
                                <span class="badge bg-gradient-info">
                                    #{{ $model->id }}
                                    {{ $model->name }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <span
                                    class="badge
                                    {{ $model->file_type === 'png' || $model->file_type === 'jpg' ? 'bg-gradient-warning' : '' }}
                                    {{ $model->file_type === 'pdf' ? 'bg-gradient-danger' : '' }}
                                    {{ $model->file_type === 'docx' || $model->file_type === 'txt' ? 'bg-gradient-danger' : '' }}
                                    {{ $model->file_type === 'xlsx' ? 'bg-gradient-success' : '' }}
                                    {{ $model->file_type === 'mp3' || 'wav' || 'mp4' ? 'bg-gradient-primary' : '' }}
                                    ">
                                    {{ $model->file_type }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <div
                                    class="form-check form-switch d-flex justify-content-center align-items-center me-3">
                                    <input class="form-check-input" wire:click="toggleSelection({{ $model->id }})"
                                        type="checkbox" {{ in_array($model->id, $selected) ? 'checked' : '' }}
                                        id="flexSwitchCheckDefault">
                                </div>
                                {{-- <button wire:click="editEntryModal({{ $model->id }})" type="button"
                                    class="btn btn-outline-info me-3 mb-0 mt-3 mb-3">Edit</button>
                                <button wire:click="duplicateEntryModal({{ $model->id }})" type="button"
                                    class="btn btn-outline-primary mb-0 mt-3 mb-3">Duplicate</button> --}}
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    @include('admin.layouts.collection-pagination')

    <!-- Modals -->
    @include('admin.layouts.modals.delete-multiple-entries')
    @include('admin.layouts.modals.duplicate-entry-modal')
    <!-- Edit Entry -->
    <x-jet-dialog-modal wire:model="editEntryModal">
        <x-slot name="title">
            Edit your Video #{{ $modelId }} {{ $modelName }}
        </x-slot>
        <x-slot name="content">
            <div class="mb-3">
                <label class="form-label" for="">Youtube Video Name</label>
                <input type="text" class="form-control @error('videoName') is-invalid @enderror"
                    wire:model="modelName" value="{{ $modelName }}">
                @error('modelName')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Iframe Video</label>
                <textarea rows="5" class="form-control @error('modelIframe') is-invalid @enderror" wire:model="modelIframe">{!! $modelIframe !!}</textarea>
                @error('modelIframe')
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
