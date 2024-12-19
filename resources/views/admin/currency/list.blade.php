@extends('layouts.adminmaster')
    @section('title')
        Ghazi 1984
    @endsection
    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            text-align: center;
        }
        
        .switch input { 
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        
        input:checked + .slider {
            background-color: #51BB25;
        }
        
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        .slider.round {
            border-radius: 34px;
        }
        
        .slider.round:before {
            border-radius: 50%;
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
                    <li class="breadcrumb-item active">Currency Rate</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%;">
                    <h5>Currency<a href="{{ route('addCurrency') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add New Rate</a></h5>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>CurrencyCode</td>
                            <td>Symbol</td>
                            <td>Rate</td>
                            <td class="text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody id="first-body">
                        @foreach ($currency as $item)
                            <tr class="item-drag" data-id="{{ $item->id }}">
                                <td><a href="{{ route('editCurrency', ['id' => $item->id]) }}" style="margin-top: 30px;">{{ $item->title }}</a></td>
                                <td>{{ $item->currency_code }}</td>
                                <td>{{ $item->symbol }}</td>
                                <td>{{ $item->currency_rate }}</td>
                                
                                <td class="text-center">
                                    <a class="btn btn-success btn-sm" href="{{ route('editCurrency', ['id' => $item->id]) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('deleteCurrency', ['id' => $item->id]) }}"><i class="fa fa-trash"></i></a>
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