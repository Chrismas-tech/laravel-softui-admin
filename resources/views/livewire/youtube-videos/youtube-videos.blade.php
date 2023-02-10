<div>
    @include('admin.layouts.collection-pagination')
    <div class="d-flex justify-content-center">
        <h5>{{ $numberResults }} result(s)</h5>
    </div>
    @include('admin.layouts.notifications')
    <div class="d-flex justify-content-between align-items-center px-3 py-3">
        <a href="{{ route('admin.youtube-videos.create') }}"
            class="d-flex justify-content-between align-items-center btn btn-outline-success mb-0">
            <i class="fa fa-plus me-2"></i>
            <span>Add a new Youtube Video</span>
        </a>

        <div class="d-flex align-items-center">
            <button type="button"
                class="btn {{ $selectAll ? 'bg-gradient-success' : 'bg-gradient-warning' }} me-3  mb-0 d-flex align-items-center justify-content-center"
                wire:click="toggleSelectAll">
                @if ($selectAll)
                    <i class="fa fa-check me-2" aria-hidden="true"></i>
                @else
                    <i class="fa fa-window-close-o me-2" aria-hidden="true"></i>
                @endif
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

    <div class="d-flex justify-content-between px-3 py-3 bg-light">
        <div>
            <input type="text"
                class="form-control form-control form-lg @error('generalSearchTerm') is-invalid @enderror"
                wire:model.debounce.400ms="generalSearchTerm" placeholder="Search something..." style="width:400px;">
            <div class="pl-3">
                @if (!($nbGeneralSearchResults === $numberResults && $nbGeneralSearchResults !== 0))
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
                    <i title="Newest to Oldest" class="fas fa-2x fa-long-arrow-alt-up filter-arrows"></i>
                @else
                    <i title="Oldest to Newest" class="fas fa-2x fa-long-arrow-alt-down filter-arrows"></i>
                @endif
            </div>

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

    <div class="table-responsive">
        <table class="table align-items-center mb-0 table-striped">
            <thead>
                <tr>
                    <th class="text-dark font-weight-bolder opacity-7">
                        <div class="d-flex justify-content-between ">
                            <span class="me-1">Youtube Video</span>
                        </div>
                    </th>
                    <th class="text-dark text-center font-weight-bolder opacity-7 ps-2">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($collectionPagination as $video)
                    <tr>
                        <td>
                            <div class="d-flex justify-content-center">
                                <span class="badge bg-gradient-info mb-2">#{{ $video->id }}
                                    {{ $video->name }}</span>
                            </div>
                            <div class="video-responsive">
                                {!! $video->iframe !!}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <div
                                    class="form-check form-switch d-flex justify-content-center align-items-center me-3">
                                    <input class="form-check-input" wire:click="toggleSelection({{ $video->id }})"
                                        type="checkbox" {{ in_array($video->id, $selected) ? 'checked' : '' }}
                                        id="flexSwitchCheckDefault">
                                </div>
                                <button wire:click="editEntryModal({{ $video->id }})" type="button"
                                    class="btn btn-outline-info me-3 mb-0 mt-3 mb-3">Edit</button>
                                <button wire:click="duplicateEntryModal({{ $video->id }})" type="button"
                                    class="btn btn-outline-primary mb-0 mt-3 mb-3">Duplicate</button>
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
