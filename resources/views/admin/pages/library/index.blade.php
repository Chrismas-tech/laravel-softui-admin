@extends('admin.layouts.base-admin')
@section('title')
    Library
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="mb-2">
                <livewire:upload-files.upload-files />
            </div>
            <hr>
            <div>
                <h5>List of files</h5>
                <livewire:upload-files.upload-files-table />
            </div>
        </div>
    </div>
@endsection
