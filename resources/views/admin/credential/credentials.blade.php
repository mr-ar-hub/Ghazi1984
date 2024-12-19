@extends('layouts.adminmaster')
    @section('title')
        Ghazi 1984 Credentials
    @endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Credentials</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Credentials</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">Social Login</h5>
                        <div class="table-responsive">
                            <table class="display" id="data-source-1" style="width:100%; table-layout: auto;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Client ID</th>
                                        <th>Client Secret</th>
                                        <th>Redirect URL</th>
                                    </tr>
                                </thead>    
                                <tbody>
                                    @foreach ($credential as $item)
                                        @if ($item->name == 'google' || $item->name == 'facebook')
                                            <tr>
                                                <td>
                                                    <a href="{{ route('editcredential', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                                </td>
                                                <td style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word; max-width: 20px;">{{ $item->client_id }}</td>
                                                <td style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word; max-width: 20px;">{{ $item->client_secret }}</td>
                                                <td style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word; max-width: 20px;">{{ $item->redirect }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h5 class="text-center fw-bold">Instagram Access Token</h5>
                            <table id="myDataTable" class="table table-hover table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Access Token</th>
                                        <th>No of Active Posts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($credential as $item)
                                        @if ($item->name == 'instagram')
                                            <tr>
                                                <td>
                                                    <a href="{{ route('editcredential', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                                </td>
                                                <td style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word; max-width: 600px;">{{ $item->access_token }}</td>
                                                <td>{{ $item->no_ig_posts }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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