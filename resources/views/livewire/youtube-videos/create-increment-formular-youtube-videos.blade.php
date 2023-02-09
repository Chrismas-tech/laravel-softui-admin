<div>
    <div class="d-flex p-3">
        <button title="Add Formular" class="d-flex align-items-center btn btn-outline-success mb-0 me-3"
            wire:click="increment"><i class="fas fa-2x fa-plus-square me-2"></i>
            <span>Add a Formular</span>
        </button>
        <button title="Remove Formular" class="d-flex align-items-center btn btn-outline-danger mb-0"
            wire:click="decrement"><i class="fas fa-2x fa-minus-square me-2"></i>
            <span>Remove a Formular</span>
        </button>
    </div>
    @for ($i = 0; $i < $nbForm; $i++)
        <hr>
        <livewire:youtube-videos.create-youtube-video :wire:key="$i" />
    @endfor
</div>
