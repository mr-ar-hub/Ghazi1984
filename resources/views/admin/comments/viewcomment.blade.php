@extends('layouts.adminmaster')
    @section('title')
        Ghazi 1984
    @endsection
    @section('style')
    <style>
        .sortable-handle {
            cursor: grab;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sortable-handle svg {
            fill: #181717;
            width: 30px;
        }
    </style>
    @endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Comments</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%;">
                    <h5>Blog Comments</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" class="form-control" value="{{ $data->name }}" readonly>
                </div>
                <div class="mb-2">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{ $data->email }}" readonly>
                </div>
                <div>
                    <label>Blog Title</label>
                    <input type="text" class="form-control" value="{{ $data->blogs->title }}" readonly>
                </div>
                <div>
                    <label>Comment</label>
                    <textarea class="form-control" readonly>{{$data->message}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection