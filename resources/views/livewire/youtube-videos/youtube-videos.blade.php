<div>
    <div class="table-responsive">
        @include('admin.layouts.collection-pagination')
        <div class="pt-3 px-3 d-flex justify-content-between align-items-center">
            <h5>{{ $numberResults }} result(s)</h5>
            <div class="d-flex align-items-center text-sm">
                <div class="me-2">Results Per Page</div>
                <select name="resultsPerPage" class="form-control m-0" wire:model="resultsPerPage">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
    </div>
    <hr>
    @include('admin.layouts.notifications')
    <div class="d-flex justify-content-between align-items-center p-3">
        <a href="{{ route('admin.youtube-videos.create') }}"
            class="d-flex justify-content-between align-items-center btn bg-gradient-success mb-0">
            <i class="fa fa-plus me-2"></i>
            <span>Add a new Youtube Video</span>
        </a>

        <div class="d-flex align-items-center">
            <button type="button"
                class="btn {{ $selectAll ? 'bg-gradient-success' : 'bg-gradient-info' }} me-3  mb-0 d-flex align-items-center justify-content-center"
                wire:click="toggleSelectAll"> <i class="fas fa-check me-2"></i>
                {{ $selectAll ? 'Select All' : 'Deselect All' }}
            </button>
            @if ($DeleteButtonExist)
                <button type="button" class="btn bg-gradient-danger mb-0" wire:click="confirmDeletionSelected"
                    wire:loading.attr="disabled"> <i class="fa fa-trash me-2"></i>Delete
                    Selection
                </button>
            @endif
        </div>
    </div>
    <hr>
    <table class="table align-items-center mb-0 table-striped">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Youtube Video</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($collectionPagination as $video)
                <tr>
                    <td width="50%;">
                        <div class="d-flex justify-content-center">
                            <span class="badge badge-pill bg-gradient-primary">#{{ $video->id }}
                                {{ $video->name }}</span>
                        </div>
                        <div class="video-responsive">
                            {!! $video->iframe !!}
                        </div>
                    </td>
                    <td width="50%;">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="form-check form-switch d-flex justify-content-center align-items-center me-3">
                                <input class="form-check-input" wire:click="toggleSelection({{ $video->id }})"
                                    type="checkbox" {{ in_array($video->id, $selected) ? 'checked' : '' }}
                                    id="flexSwitchCheckDefault">
                            </div>
                            <button wire:click="editEntryModal({{ $video->id }})" type="button"
                                class="btn bg-gradient-info me-3 mb-0 mt-3 mb-3">Edit</button>
                            <button wire:click="duplicateEntryModal({{ $video->id }})" type="button"
                                class="btn bg-gradient-primary mb-0 mt-3 mb-3">Duplicate</button>
                        </div>
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>

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

            <button @if (!$isValid) disabled @endif type="button" class="btn btn-success"
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
