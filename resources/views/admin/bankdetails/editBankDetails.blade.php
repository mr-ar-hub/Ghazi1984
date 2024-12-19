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
                    <li class="breadcrumb-item active">Add Bank Detail</li>
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
                            <h5>Edit Bank Detail <a href="{{ route('bankDetail') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="{{route('updateBankDetail', ['id' => $bank->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Account Holder Name</label>
                                <input type="text" name="account_holder_name" placeholder="Enter account holder name" value="{{ $bank->account_holder_name }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" name="bank_name" placeholder="Enter bank name" value="{{ $bank->bank_name }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="number" name="account_number" placeholder="Enter account number" value="{{ $bank->account_number }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Branch</label>
                                <input type="text" name="branch" placeholder="Enter branch name" value="{{ $bank->branch }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>IBAN</label>
                                <input type="text" name="iban" placeholder="Enter IBAN" value="{{ $bank->iban }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>BIC</label>
                                <input type="text" name="bic" placeholder="Enter BIC" value="{{ $bank->bic }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Swift Code</label>
                                <input type="text" name="swift_code" placeholder="Enter swift code" value="{{ $bank->swift_code }}" class="form-control" />
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Update</button>
                                    <a href="{{route('updateBankDetail', ['id' => $bank->id])}}" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection