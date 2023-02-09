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
            </div>
            <livewire:youtube-videos.create-increment-formular-youtube-videos />
        </div>
    </div>
@endsection
