@extends('admin.layouts.base-admin')
@section('title')
    Create a Youtube Video
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <livewire:youtube-videos.create-youtube-video />
        </div>
    </div>
@endsection
