@extends('admin.layouts.base-admin')
@section('title')
    Crud Builder
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card p-3">
            <h5>Crud Builder Interface</h5>
            <livewire:crud-builder.crud-builder />
        </div>
    </div>
@endsection
