@extends('admin.layouts.base-admin')
@section('title')
    Album Photo n° {{ $album->id }}
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="text-2xl p-3">
                <a href="{{ route('admin.album-photos.index') }}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            <livewire:album-photos.show-album-photo :album="$album" :files="$files">
        </div>
    </div>
@endsection
