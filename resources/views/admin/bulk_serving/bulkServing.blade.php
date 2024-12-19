@extends('layouts.adminmaster')
    @section('title')
      Ghazi 1984
    @endsection
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Bulk Order Serving Record</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Bulk Order Serving Record</li>
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
                <div class="card-title" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                    <h5>Bulk Order Serving Record</h5>
                    <div style="margin-left: auto;">
                        <a href="{{ route('addbulkSurvingOrder') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp; 
                            Add New
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <table id="myDataTable" class="table table-hover table-sm table-bordered">
                <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Client Name</th>
                    <th>Company Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                      $count=1;
                    @endphp
                    @foreach ($bulkServing as $item)
                    <tr>
                        <td>@php echo $count++."." @endphp</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->company_name }}</td>
                        <td>
                            <a href="{{ route('deletebulkSurvingOrder', ['id' => $item->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

