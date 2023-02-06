@extends('admin.layouts.base-admin')
@section('title')
    Youtube Videos
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <livewire:youtube-videos.youtube-videos />
        </div>
    </div>
@endsection
