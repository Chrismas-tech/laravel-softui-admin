@extends('admin.layouts.base-admin')
@section('title')
    Create Album Photo(s)
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="text-2xl p-3">
                <a href="{{ route('admin.youtube-videos.index') }}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            <livewire:album-photos.create-increment-formular-album-photos />
        </div>
    </div>
@endsection
