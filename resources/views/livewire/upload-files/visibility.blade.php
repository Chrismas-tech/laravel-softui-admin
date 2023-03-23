<div class="d-flex justify-content-center align-items-center">
    <div class="me-3">
        <span>{{ $value ? 'Public' : 'Private' }}</span>
    </div>
    <div class="form-check form-switch me-3">
        <input type="checkbox" class="form-check-input" wire:click="updateVisibility({{ $row->id }})"
            {{ $value === 1  ? 'checked' : '' }} id="flexSwitchCheckDefault">
    </div>
</div>
