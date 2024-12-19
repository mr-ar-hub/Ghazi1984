@extends('layouts.adminmaster')
    @section('title')
        Ghazi 1984
    @endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Shippings Costs</li>
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
                    <h5>Shippings Costs<a href="{{ route('addShipping') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add Category</a></h5>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                        <tr>
                            <td>Sr no</td>
                            <td>Country Name</td>
                            <td>Shipping Cost</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach($shipping as $item)
                            <tr>
                                <td>@php echo $count++."." @endphp</td>
                                <td>{{ $item->country_name }}</td>
                                <td>{{ $item->shipping }}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ route('editShipping', ['id' => $item->id]) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('deleteShipping', ['id' => $item->id]) }}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "ordering": false,
        });
    });
</script>
@endsection