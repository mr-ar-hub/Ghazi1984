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
                    <li class="breadcrumb-item active">Add Shippings Costs</li>
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
                            <h5>Add Shippings Cost<a href="{{ route('shipping') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="{{ route('postShipping') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Country Name</label>
                                <select id="country" name="country_name" class="form-control form-control-sm">
                                    <option value="">Country / region</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Shipping Cost</label>
                                <input type="number" name="shipping" class="form-control" placeholder="RS:"/>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    async function fetchCountries() {
        const response = await fetch('https://restcountries.com/v3.1/all');
        const countries = await response.json();
        return countries.map(country => country.name.common);
    }

    async function populateCountries() {
        const countrySelect = document.querySelector('#country');
        countrySelect.innerHTML = '<option value="">Country / region</option>';

        const countries = await fetchCountries();
        countries.forEach(country => {
            countrySelect.innerHTML += `<option value="${country}">${country}</option>`;
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        populateCountries();
    });
</script>
@endsection