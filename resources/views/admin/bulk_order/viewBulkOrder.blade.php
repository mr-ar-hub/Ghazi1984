@extends('layouts.adminmaster')
    @section('title')
      Ghazi 1984
    @endsection
    @section('style')
      <style>
        .image-container {
            display: flex;
            flex-wrap: wrap;
        }
    
        .file-wrapper {
            position: relative;
            margin: 10px;
        }
    
        .file-wrapper img,
        .file-wrapper .pdf-thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
            display: block;
        }
    
        .pdf-thumbnail {
            background: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #333;
            border: 1px solid #ccc;
        }
    
        .download-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            display: none; /* Hide by default */
        }
    
        .file-wrapper:hover .download-icon {
            display: block; /* Show on hover */
        }
      </style>
    @endsection
@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">View Bulk Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">View Bulk Order</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title" style="width: 100%;">
                <h5>Bulk Orders <a href="{{ route('indexbulkOrder') }}" class="btn btn-primary btn-sm float-right ml-2"><i class="fa fa-arrow-left"></i> Back</a> <a class="btn btn-danger btn-sm float-right" href="#"><i class="fa fa-trash"></i></a></h5>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-hover table-sm table-bordered">
                <thead>
                    <tr>
                      <th>Company Name</th>
                      <td>{{ $bulkOrder->company_name }}</td>
                    </tr>
                    <tr>
                      <th>Name</th>
                      <td>{{ $bulkOrder->name }}</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td>{{ $bulkOrder->email }}</td>
                    </tr>
                    <tr>
                      <th>Whatsapp No.</th>
                      <td>{{ $bulkOrder->phone }}</td>
                    </tr>
                    <tr>
                      <th>Country</th>
                      <td>{{ $bulkOrder->country }}</td>
                    </tr>
                    <tr>
                      <th>Address</th>
                      <td>{{ $bulkOrder->address }}</td>
                    </tr>
                    <tr>
                      <th>Quantity</th>
                      <td>{{ $bulkOrder->quantity }}</td>
                    </tr>
                    <tr>
                      <th class="align-top">Requirement</th>
                      <td>{!! $bulkOrder->requirement !!}</td>
                    </tr>
                    <tr>
                      <th class="align-top">Sample Image</th>
                      <td>
                        <div class="image-container">
                          <div class="image-container">
                            @foreach($bulkOrder->SampleImage as $image)
                                <div class="file-wrapper">
                                    @if(str_ends_with($image->image_name, '.pdf'))
                                        <!-- Display PDF Thumbnail -->
                                        <div class="pdf-thumbnail">📄</div>
                                    @else
                                        <!-- Display Image -->
                                        <img src="{{ asset('storage/' . $image->image_name) }}" alt="">
                                    @endif
                                    <a href="{{ asset('storage/' . $image->image_name) }}" download class="download-icon">⬇️</a>
                                </div>
                            @endforeach
                        </div>
                      </div>
                    </td>
                    </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection