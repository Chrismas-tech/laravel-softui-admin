@extends('admin.layouts.base-admin')
@section('title')
    Library
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <livewire:upload-files.upload-files />
        </div>
    </div>
@endsection
