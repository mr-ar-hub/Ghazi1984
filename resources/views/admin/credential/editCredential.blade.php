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
        <div class="card">
            <div class="card-body">
                <form class="needs-validation" action="{{ route('updatecredential', ['id' => $credential->id]) }}" method="POST" novalidate="">
                    @csrf
                    @method('PUT')
                    @if ($credential->name == 'google' || $credential->name == 'facebook')
                        <div class="form-group">
                            <label>Client id</label>
                            <input type="text" class="form-control required" name="client_id" required="" value="{{ $credential->client_id }}" >
                        </div>
                        <div class="form-group mt-3">
                            <label>Client Secret</label>
                            <input type="text" class="form-control required" name="client_secret" required="" value="{{ $credential->client_secret }}">
                        </div>
                        <div class="form-group mt-3">
                            <label>Redirect URL</label>
                            <input type="text" class="form-control required" name="redirect" required="" value="{{ $credential->redirect }}">
                        </div>
                    @endif
                    @if ($credential->name == 'instagram')
                        <div class="form-group">
                            <label>Access Token</label>
                            <input type="text" class="form-control required" name="access_token" required="" value="{{ $credential->access_token }}" >
                        </div>
                        <div class="form-group col-md-4 mt-3">
                            <label>No of Active Posts</label>
                            <input type="number" class="form-control required" name="no_ig_posts" min="6" value="{{ $credential->no_ig_posts }}">
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12 mt-2">
                            <button type="submit" class="btn btn-success ml-2" style="float: right; margin-left: 5px;">Update</button>
                            <a href="{{ route('editcredential', ['id' => $credential->id]) }}" class="btn btn-danger" style="float: right;">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection