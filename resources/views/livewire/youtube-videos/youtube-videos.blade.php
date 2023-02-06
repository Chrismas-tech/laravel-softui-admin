<div>
    <div class="table-responsive">
        <div class="mt-3 p-3">
            {{ $youtubeVideos->links('pagination::bootstrap-5') }}
        </div>
        <div class="d-flex justify-content-between align-items-center p-3">
            <a href="{{ route('admin.youtube-videos.create') }}"
                class="d-flex justify-content-between align-items-center btn bg-gradient-success mb-0">
                <i class="fa fa-plus me-2"></i>
                <span>Add a
                    new Youtube Video</span>
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
                        <td width="10%;">
                            <div class="form-check form-switch d-flex justify-content-center align-items-center">
                                <input class="form-check-input" wire:click="toggleSelection({{ $video->id }})"
                                    type="checkbox" {{ in_array($video->id, $selected) ? 'checked' : '' }}
                                    id="flexSwitchCheckDefault">
                            </div>
                        </td>
                        <td width="45%;">
                            <div class="mt-2 mb-2 d-flex justify-content-center">
                                <span class="badge badge-pill bg-gradient-primary">{{ $video->name }}</span>
                            </div>
                            <div class="video-responsive">
                                {!! $video->iframe !!}
                            </div>
                        </td>
                        <td width="45%;">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn bg-gradient-info me-3 mb-0 mt-3 mb-3">Edit</button>
                                <button type="button" class="btn bg-gradient-danger mb-0 mt-3 mb-3">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        <div class="mt-3 p-3">
            {{ $youtubeVideos->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="confirmDeletionSelected">
        <x-slot name="title">
            {{ __('Delete Youtube Videos') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete all lines selected?') }}
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
</div>
