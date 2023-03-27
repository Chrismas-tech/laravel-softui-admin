@if ($value === 'customer')
    <span class="badge-light-success">{{ ucfirst($value) }}</span>
@else
    <span class="badge-light-danger">{{ ucfirst($value) }}</span>
@endif
