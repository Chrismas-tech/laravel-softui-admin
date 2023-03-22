@if ($row->file_type === 'pdf')
    <a title="download" class="w-100 d-block"  href="{{ route('admin.download-file', $row->id) }}">
        <i class="fa-solid fa-file-pdf text-danger"></i>
        <span>{{ $value }}</span>
        <i class="fa-solid fa-download ms-2"></i>
    </a>
@elseif ($row->file_type === 'xlsx')
    <a title="download" class="w-100 d-block"  href="{{ route('admin.download-file', $row->id) }}">
        <i class="fa-solid fa-file-excel text-success"></i>
        <span>{{ $value }}</span>
        <i class="fa-solid fa-download ms-2"></i>
    </a>
@elseif ($row->file_type === 'docx' || $row->file_type === 'txt')
    <a title="download" class="w-100 d-block"  href="{{ route('admin.download-file', $row->id) }}">
        <i class="fa-solid fa-file-lines text-info"></i>
        <span>{{ $value }}</span>
        <i class="fa-solid fa-download ms-2"></i>
    </a>
@elseif ($row->file_type === 'png' || $row->file_type === 'jpeg' || $row->file_type === 'jpg')
    <a title="download" class="w-100 d-block"  href="{{ route('admin.download-file', $row->id) }}">
        <i class="fa-solid fa-image text-warning"></i>
        <span>{{ $value }}</span>
        <i class="fa-solid fa-download ms-2"></i>
    </a>
@endif
