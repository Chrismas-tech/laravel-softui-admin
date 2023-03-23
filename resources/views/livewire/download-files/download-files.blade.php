@if ($row->file_type === 'pdf')
    <a title="download" class="w-100 d-block" href="{{ route('admin.download-file', $row->id) }}">
        <i class="fa-solid fa-file-pdf fa-2x me-2 text-danger"></i>
        <span>{{ $value }}</span>
        <i class="fa-solid fa-download ms-2"></i>
    </a>
@elseif ($row->file_type === 'xlsx')
    <a title="download" class="w-100 d-block" href="{{ route('admin.download-file', $row->id) }}">
        <i class="fa-solid fa-file-excel fa-2x me-2 text-success"></i>
        <span>{{ $value }}</span>
        <i class="fa-solid fa-download ms-2"></i>
    </a>
@elseif ($row->file_type === 'docx' || $row->file_type === 'txt')
    <a title="download" class="w-100 d-block" href="{{ route('admin.download-file', $row->id) }}">
        <i class="fa-solid fa-file-lines fa-2x me-2 text-info"></i>
        <span>{{ $value }}</span>
        <i class="fa-solid fa-download ms-2"></i>
    </a>
@elseif ($row->file_type === 'mp3' || $row->file_type === 'wav')
    <a title="download" class="w-100 d-block" href="{{ route('admin.download-file', $row->id) }}">
        <i class="fa-solid fa-volume-high me-2 text-dark"></i>
        <span>{{ $value }}</span>
        <i class="fa-solid fa-download ms-2"></i>
    </a>
@elseif ($row->file_type === 'mp4')
    <a title="download" class="w-100 d-block" href="{{ route('admin.download-file', $row->id) }}">
        <i class="fa-solid fa-video me-2 text-dark"></i>
        <span>{{ $value }}</span>
        <i class="fa-solid fa-download ms-2"></i>
    </a>
@elseif ($row->file_type === 'png' || $row->file_type === 'jpeg' || $row->file_type === 'jpg')
    <a title="download" class="w-100 d-block" href="{{ route('admin.download-file', $row->id) }}">
        <i class="fa-solid fa-image fa-2x me-2 text-warning"></i>
        <span>{{ $value }}</span>
        <i class="fa-solid fa-download ms-2"></i>
    </a>
@endif
