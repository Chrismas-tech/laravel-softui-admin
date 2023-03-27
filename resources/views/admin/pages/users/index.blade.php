@extends('admin.layouts.base-admin')
@section('title')
    Users List
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="card p-4">
            <livewire:users.user-admin-table />
        </div>
    </div>
@endsection
