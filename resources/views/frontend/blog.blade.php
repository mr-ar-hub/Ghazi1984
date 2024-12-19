@extends('layouts.layout')
@section('content')
<!-- 
    --------------------------------
    ------ / page title / ----------
    --------------------------------
     -->
     <div class="page-title">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Blog</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('index') }}">Home</a> » <span class="current">Blog</span>
                </div>
            </header>
        </div>
    </div>

    <!-- 
    --------------------------------
    ---------- / blog / ------------
    --------------------------------
     -->
    <div class="container">
        <div class="blog-section mt-5">
            @foreach ($blogs as $item)
            <div class="blog-post">
                <div class="blog-image-wrapper">
                    @php
                        $date = \Carbon\Carbon::parse($item->blog_date);
                    @endphp
                    <!--<div class="blog-date"><span>{{ $date->format('d') }}</span><span>{{ strtoupper($date->format('M')) }}</span></div>-->
                    <a href="{{ route('blogDetail', ['slug' => $item->slug]) }}"><img src="{{ asset('storage/' . $item->BlogImage->image_name) }}" class="img-fluid blog-image"
                            alt="Blog Image 1"></a>
                    <div class="blog-dots">•••</div>
                    <div class="blog-tag"><a href="#">ghazi1984</a></div>
                </div>
                <div class="blog-content">
                    <h3 class="blog-title">{{ $item->title }}</h3>
                    <div class="blog-info">
                        <a href="#">By {{ $item->auther_name }}</a>
                        <a href="#"><i class="fa-regular fa-comment"></i></a>
                        <div class="share-icon">
                            <i class="fas fa-share-alt"></i>
                            <div class="blog-post-icons">
                                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <p class="blog-description">{{ $item->short_description }}</p>
                    <a href="{{ route('blogDetail', ['slug' => $item->slug]) }}" class="blog-detail-link">Continue reading</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection