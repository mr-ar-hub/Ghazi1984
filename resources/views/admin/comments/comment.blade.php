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
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Blog Title</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($comments as $comment)
                        <tr>
                        <td>{{$i++}}</td>
                        <td><a href="{{ route('viewComment', $comment->id) }}">{{$comment->name}}</a></td>
                        <td>{{$comment->blogs->title}}</td>
                        <td>{{$comment->email}}</td>
                        <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width:200px; display: block;">
                            {{$comment->message}}</td>
                        <td> 
                            <a class="btn btn-success btn-sm" href="{{ route('viewComment', $comment->id) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-danger btn-sm" href="{{ route('deleteComment', $comment->id) }}"><i class="fa fa-trash"></i></a>
                        </td>               
                        </tr>
                        @endforeach
                    </tbody>
                 
                </table>
            </div>
        </div>
    </div>
</div>
@endsection