@extends('layouts.adminmaster')
    @section('title')
      Ghazi 1984
    @endsection
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Bulk Orders</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Bulk Orders</li>
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
              <div class="card-title">
                <h5>My Inquiries</h5>
              </div>
            </div>
            <div class="card-body">
              <table id="myDataTable" class="table table-hover table-sm table-bordered">
                <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Company Name</th>
                    <th>Client Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $count=1;
                  @endphp
                  @foreach ($bulkOrder as $item)
                    <tr>
                      <td>@php echo $count++."." @endphp</td>
                      <td>{{ $item->company_name }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->phone }}</td>
                      <td>{{ $item->email }}</td>
                      <td>@php echo (new DateTime($item->created_at))->format('d-m-Y'); @endphp</td>
                      <td>
                        <a href="{{ route('viewBulkOrder', ['id' => $item->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-info"></i></a>
                        <a href="{{ route('deletebulkOrder', ['id' => $item->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

