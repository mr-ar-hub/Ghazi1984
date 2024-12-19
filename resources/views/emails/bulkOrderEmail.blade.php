@extends('emails.master')

@section('content')
<h1>Bulk Order Details</h1>
<p><strong>Customer Name:</strong> {{ $name }}</p>
<p><strong>Email:</strong> {{ $email }}</p>
<p><strong>Company Name</strong> {{ $company_name }}</p>
<p><strong>Whatsapp Number:</strong> {{ $phone }}</p>
<p><strong>Address:</strong> {{ $address }}</p>
<p><strong>Country:</strong> {{ $country }}</p>
<p><strong>Requirments:</strong></p>
<p>{!! $requirement !!}</p>
<h2>Bulk Order Details</h2>
<table>
    <thead>
        <tr>
            <th>Quantity</th>
            <th>Images</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $quantity }}</td>
            <td>
                <div class="image-container">
                    <div class="image-container">
                        @foreach($inquiries->SampleImage as $image)
                            <div class="file-wrapper">
                                @if(str_ends_with($image->image_name, '.pdf'))
                                    <div class="pdf-thumbnail">📄</div>
                                @else
                                    <img src="{{ asset('storage/' . $image->image_name) }}" alt="Sample Image">
                                @endif
                                <a href="{{ asset('storage/' . $image->image_name) }}" download class="download-icon" target="_blank">⬇️</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
@endsection