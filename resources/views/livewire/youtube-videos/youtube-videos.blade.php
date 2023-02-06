<div>
    <div class="table-responsive">
        <div class="mt-3 p-3 d-flex justify-content-between">
            {{ $youtubeVideos->links() }}
            <div class="d-flex align-items-center">
                <div class="me-2">Number of Results</div>
                <select name="numberResults" class="form-control m-0" style="height:fit-content;width:fit-content;"
                    wire:model="numberResults">
                    <option value="">Select number results</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center p-3">
            <a href="{{ route('admin.youtube-videos.create') }}"
                class="d-flex justify-content-between align-items-center btn bg-gradient-success mb-0">
                <i class="fa fa-plus me-2"></i>
                <span>Add a new Youtube Video</span>
            </a>
            @if ($selectExist)
                <button type="button" class="btn bg-gradient-danger mb-0" wire:click="confirmDeletionSelected"
                    wire:loading.attr="disabled"> <i class="fa fa-trash me-2"></i>Delete
                    Selection</button>
            @endif
        </div>
        <hr>
        <table class="table align-items-center mb-0 table-striped">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Selection</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Youtube Video</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($youtubeVideos as $video)
                    <tr>
                        <td width="5%;">
                            <div class="form-check form-switch d-flex justify-content-center align-items-center">
                                <input class="form-check-input" wire:click="toggleSelection({{ $video->id }})"
                                    type="checkbox" {{ in_array($video->id, $selected) ? 'checked' : '' }}
                                    id="flexSwitchCheckDefault">
                            </div>
                        </td>
                        <td width="45%;">
                            <div class="mt-2 mb-2 d-flex justify-content-center">
                                <span class="badge badge-pill bg-gradient-primary">#{{ $video->id }}
                                    {{ $video->name }}</span>
                            </div>
                            <div class="video-responsive">
                                {!! $video->iframe !!}
                            </div>
                        </td>
                        <td width="45%;">
                            <div class="d-flex justify-content-center align-items-center">
                                <button wire:click="editEntryModal({{ $video->id }})" type="button" class="btn bg-gradient-info me-3 mb-0 mt-3 mb-3">Edit</button>
                                <button wire:click="confirmDeletionSingleEntry({{ $video->id }})" type="button"
                                    class="btn bg-gradient-danger mb-0 mt-3 mb-3">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        <div class="mt-3 p-3">
            {{ $youtubeVideos->links() }}
        </div>
    </div>

    <!-- Delete Mutiple Entries-->
    <x-jet-dialog-modal wire:model="confirmDeletionSelected">
        <x-slot name="title">
            {{ __('Delete Youtube Video') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Youtube Video ?') }}
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

    <!-- Delete Single Entry-->
    <x-jet-dialog-modal wire:model="confirmDeletionSingleEntry">
        <x-slot name="title">
            {{ __('Delete Youtube Videos') }}
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete the video #{{ $videoId }} {{ $videoName }} ?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmDeletionSingleEntry')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="deleteSingleEntry({{ $videoId }})" wire:loading.attr="disabled">
                <div wire:loading wire:target="deleteSingleEntry" class="spinner-border spinner-border-sm"
                    role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                {{ __('Confirm') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
    <!-- Delete Single Entry-->


    <!-- Edit Entry -->
    <x-jet-dialog-modal wire:model="editEntryModal">
        <x-slot name="title">
            {{ __('Delete Youtube Videos') }}
        </x-slot>

        <x-slot name="content">
            Edit your Video #{{ $videoId }} {{ $videoName }} ?
        </x-slot>

        <div>
            <label for="url"class="form-control">Video Url</label>
            <textarea type="text" class="form-control">{{!! $videoIframe !!}}</textarea>
        </div>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('editEntryModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <button type="button" class="btn btn-success" wire:click="updateEntry"
                wire:loading.attr="disabled">
                <div wire:loading wire:target="updateEntry" class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                {{ __('Update') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>
    <!-- Edit Entry -->
</div>
