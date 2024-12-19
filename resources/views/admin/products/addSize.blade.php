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
                        <li class="breadcrumb-item active">Add Size</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title" style="width: 100%;">
                                <h5>Add New Size <a href="{{ route('allProducts') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                            </div>  
                        </div>
                        <div class="card-body">
                            <form action="{{route('postSize')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Size Name</label>
                                    <input type="text" name="name" placeholder="Enter size name" value="{{old('name')}}"  class="form-control" />
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
                                        <a href="{{ route('postSize') }}" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="myDataTable" class="table table-hover table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Size Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($size as $item)
                                    <tr class="item-drag" data-id="{{ $item->id }}">
                                        <td class="sortable-handle">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M10,4c0,1.1-0.9,2-2,2S6,5.1,6,4s0.9-2,2-2S10,2.9,10,4z M16,2c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,2,16,2z M8,10 c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S9.1,10,8,10z M16,10c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,10,16,10z M8,18 c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S9.1,18,8,18z M16,18c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,18,16,18z"></path>
                                            </svg>
                                        </td>
                                        <td>{{ $item->name }}</td>
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

    <script src="https://unpkg.com/sortablejs@1.14.0/Sortable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myDataTable').DataTable({
                "ordering": false,
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            var sortable = new Sortable(document.getElementById('myDataTable').querySelector('tbody'), {
                handle: '.sortable-handle',
                animation: 150,
                ghostClass: 'sortable-ghost',
                dataIdAttr: 'data-id',
                draggable: '.item-drag',
                onEnd(evt) {
                    const newOrder = sortable.toArray(); 
                    updateOrderNo(newOrder);
                }
            });

            function updateOrderNo(currentOrderList) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('updateSizeOrder') }}",
                    data: { currentOrderList: currentOrderList },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function(msg) {
                    if (msg.status) {
                        toastr.success(msg.message, "Success!");
                    } else {
                        toastr.error(msg.message);
                    }
                });
            }
        });
    </script>
@endsection