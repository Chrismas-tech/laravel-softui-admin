@extends('admin.layouts.base-admin')
@section('title')
    Album Photos
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <livewire:album-photos.album-photos />
        </div>
    </div>
@endsection