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
                    <li class="breadcrumb-item active">Categories</li>
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
                    <h5>My Categories<a href="{{ route('addCategory') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add Category</a></h5>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <td>Category Name</td>
                            <td>Category Slug</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody id="first-body">
                        @php
                            function category($pid = 0, $space = '')
                            { 
                                $dbHost = 'localhost';
                                $dbUser = $_ENV['DB_USERNAME'];
                                $dbPassword = $_ENV['DB_PASSWORD'];
                                $dbName = $_ENV['DB_DATABASE'];
                                                        
                                $con = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
                                $sql = "SELECT * FROM categories WHERE cat_pid = $pid ORDER BY order_no";
                                $query = mysqli_query($con, $sql);
                                $count = 1;
                                while($data = mysqli_fetch_assoc($query))
                                {
                                    @endphp
                                    <tr class="{{ ($data['level'] == 1) ? 'item-drag' : '' }}" data-id="{{ $data['id'] }}-{{ $data['level'] }}">
                                        @if($data['level'] == 1)
                                            <td class="sortable-handle">
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M10,4c0,1.1-0.9,2-2,2S6,5.1,6,4s0.9-2,2-2S10,2.9,10,4z M16,2c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,2,16,2z M8,10 c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S9.1,10,8,10z M16,10c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,10,16,10z M8,18 c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S9.1,18,8,18z M16,18c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,18,16,18z"></path>
                                                </svg>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('editCategory', ['id' => $data['id']]) }}">
                                                {{ $space.$data['cat_name'] }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('editCategory', ['id' => $data['id']]) }}">
                                                {{ $data['cat_slug'] }}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="{{ route('editCategory', ['id' => $data['id']]) }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" href="{{ route('deleteCategory', ['id' => $data['id']]) }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>  
                                    @php
                                    $count++;
                                    category($data['id'], $space.'-');
                                }
                            } 
                        @endphp
                        <?php category(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    
<script src="https://unpkg.com/sortablejs@1.14.0/Sortable.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "ordering": false,
        });
    });
</script>
<script>
    $(document).ready(function() {

        var sortable = new Sortable(document.getElementById('first-body'), {
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
                url: "{{ route('updateCategoryOrder') }}",
                data: { "currentOrderList": currentOrderList },
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