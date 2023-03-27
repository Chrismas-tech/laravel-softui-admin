@extends('admin.layouts.base-admin')
@section('title')
    Youtube Videos
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="d-flex justify-content-end align-items-center mb-4">
                <a href="{{ route('admin.youtube-videos.create') }}"
                    class="d-flex justify-content-between align-items-center btn btn-outline-success mb-0">
                    <i class="fa fa-plus me-2"></i>
                    <span>Add a new Youtube Video</span>
                </a>
            </div>
            <livewire:youtube-videos.youtube-video-table />
        </div>
        <livewire:youtube-videos.update-youtube-video-form>
    </div>
@endsection
