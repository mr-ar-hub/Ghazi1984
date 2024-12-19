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
                    <a href="{{ route('index') }}">Home</a> » <span class="current">Ghazi1984</span>
                </div>
            </header>
        </div>
    </div>
    <!-- 
    --------------------------------
    ------ / blog detail / ---------
    --------------------------------
     -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 col-md-12 left-part">
                <div class="blog-details">
                    <div class="blog-meta mb-4">
                        <a href="#">Ghazi1984</a>
                        <h1 class="mt-3">{{ $blog->title }}</h1>
                        <p>Posted by {{ $blog->auther_name }}</p>
                    </div>
                    @php
                        $date = \Carbon\Carbon::parse($blog->blog_date);
                    @endphp
                    <div class="blog-image mb-4">
                        <!--<div class="blog-date"><span>{{ $date->format('d') }}</span><span>{{ strtoupper($date->format('M')) }}</span></div>-->
                        <img src="{{ asset('storage/' . $blog->BlogImage->image_name) }}" class="img-fluid" alt="Blog Image">
                    </div>
                    <div class="blog-detailed-content mb-4">
                        {!! $blog->blog_description !!}
                    </div>
                    <hr>
                    <div class="social-media-icons mb-4">
                        <div class="social-icons">
                            <a href="https://www.facebook.com/Ghazi1984thebrand" target="_blank"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://twitter.com/ApparelGhazi" target="_blank"><i
                                    class="fa-brands fa-twitter"></i></a>
                            <a href="https://www.instagram.com/ghazi1984thebrand" target="_blank"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.youtube.com/channel/UCfd-JXr9ZkIWzDfjiJ2fLIg" target="_blank"><i
                                    class="fa-brands fa-youtube"></i></a>
                            <a href="https://www.pinterest.com/Ghazi1984TheBrand" target="_blank"><i
                                    class="fa-brands fa-pinterest"></i></a>
                        </div>
                    </div>
                    <hr>
                    <div class="comment-list pb-3">
                        <h2 class="comments-title pb-5 pt-3">
                        One thought on “<span>Seating collection inspiration</span>”		</h2>
                        @foreach($comments as $comment)
                        <div class="comment-list pb-4">
                            <div class="comment-body d-flex flex-row">
                                <div class="comment-author vcard" style="margin-right: 20px">
                                    <img alt="" src="{{asset('/avatar.png')}}" class="avatar " height="74" width="74" loading="lazy" decoding="async">
                                </div>
                                <div class="col-md-10 comment-meta commentmetadata ">
                                    <div class="row justify-content-between">
                                        <div class="col-md-9" style="font-weight:600;">
                                            <cite class="fn">{{$comment->name}}</cite> <span class="says">says:</span>
                                        </div>
                                        <div class="col-md-3">
                                            <a style="font-size:13px; font-weight:600">{{ \Carbon\Carbon::parse($comment->created_at)->format('F j, Y') }}</a>
                                        </div>
                                    </div>
                                    <div class="comment-message pt-3" style="text-align: justify">
                                        {{$comment->message}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>


                    <form action="{{ route('uploadcomment') }}" method="POST">
                        @csrf
                        <div class="comment-section mb-4">
                            <h3>LEAVE A REPLY</h3>
                            <p>Your email address will not be published. Required fields are marked <span class="red">*</span></p>
                            
                            <label for="comment">Comment <span class="red">*</span></label>
                            <textarea class="mb-3" name="message" required></textarea>
                            
                            <div class="row">
                                <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                <div class="col-md-4 mb-3">
                                    <label for="Name">Name <span class="red">*</span></label>
                                    <input type="text" name="name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <input type="checkbox" id="notify">
                                <label class="form-check-label" for="notify">Save my name, email, and website in this browser for the next time I comment.</label>
                            </div>
                            
                            <button type="submit" class="comment-btn">Post comment</button>
                        </div>
                    </form>                    
                </div>
            </div>
            <div class="col-lg-4 col-md-12 right-part" id="sidebar">
                <div class="blog-categories mb-4">
                    <h3>Categories</h3>
                    <ul class="list-group">
                        <li class="blog-category-item"><a href="#">Ghazi1984</a></li>
                    </ul>
                </div>
                <div class="recent-blogs mb-4">
                    <h3>Recent Posts</h3>
                    @foreach ($recentBlogs as $item)
                        <div class="recent-blog-item mb-3">
                            <a href="#"><img src="{{ asset('storage/' . $item->BlogImage->image_name) }}" class="img-fluid" alt="Recent Blog 1"></a>
                            <div>
                                <a href="{{ route('blogDetail', ['slug' => $item->slug]) }}">
                                    <p>{{ $item->title }}</p>
                                </a>
                                @php
                                    $date = \Carbon\Carbon::parse($item->blog_date);
                                @endphp
                                <!--<span>{{ $date->format('d M Y') }}</span> -->
                                <a href="#"><span>
                                    @php
                                        $count = $comments->where('blog_id', $item->id)->count();
                                    @endphp
                                            @if($count)
                                                {{ $count }} Comment{{ $count > 1 ? 's' : '' }}
                                            @else
                                                <span>No Comment</span>
                                            @endif
                                </span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="instagram-posts">
                    <h3>Instagram</h3>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <a href="#"><img src="{{ asset('assets/images/products-1.webp') }}" class="img-fluid" alt="Instagram Post 1"></a>
                        </div>
                        <div class="col-4 mb-3">
                            <a href="#"><img src="{{ asset('assets/images/product-2.webp') }}" class="img-fluid" alt="Instagram Post 2"></a>
                        </div>
                        <div class="col-4 mb-3">
                            <a href="#"><img src="{{ asset('assets/images/product-3.webp') }}" class="img-fluid" alt="Instagram Post 3"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <a href="#"><img src="{{ asset('assets/images/product-4.webp') }}" class="img-fluid" alt="Instagram Post 4"></a>
                        </div>
                        <div class="col-4 mb-3">
                            <a href="#"><img src="{{ asset('assets/images/product-5.webp') }}" class="img-fluid" alt="Instagram Post 5"></a>
                        </div>
                        <div class="col-4 mb-3">
                            <a href="#"><img src="{{ asset('assets/images/product-6.webp') }}" class="img-fluid" alt="Instagram Post 6"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="sidebar-toggle" class="d-lg-none"><i class="fa-solid fa-ellipsis"></i></button>
@endsection