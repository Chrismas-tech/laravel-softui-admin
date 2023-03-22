@extends('admin.layouts.base-admin')
@section('title')
    Create Youtube Video(s)
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="text-2xl p-3">
                <a href="{{ route('admin.youtube-videos.index') }}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <div>
                    <h4 class="mt-4">Add a Youtube Video</h4>
                    <livewire:youtube-videos.create-youtube-video-form />
                </div>
            </div>
        </div>
    </div>
@endsection
