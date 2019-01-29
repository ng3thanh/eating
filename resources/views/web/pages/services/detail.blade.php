@extends('web.layout')

@section('title', 'Service')
@section('css')

@endsection
@section('content')
    <div class="container header-padding-top">
        <div class="row">
            <!-- Latest Posts -->
            <main class="post blog-post col-lg-8">
                <div class="container">
                    <div class="post-single">
                        <div class="post-thumbnail">
                            <img src="{{ asset("$service->image") }}" alt="{{ $service->name }}" class="img-fluid">
                        </div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="category"><a href="#">Business</a><a href="#">Financial</a></div>
                            </div>
                            <h1>{{ $service->name }} <a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                            <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
                                <a href="#" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar">
                                        <img src="{{ asset('web/img/admin_logo.png') }}" alt="..." class="img-fluid">
                                    </div>
                                    <div class="name">
                                        <span>{{ $service->author }}</span>
                                    </div>
                                </a>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="date"><i class="icon-clock"></i> {{ timeElapsedString($service->created_at) }}</div>
                                    <div class="views meta-last"><i class="fa fa-star-o"></i> {{ $service->star }}</div>
                                </div>
                            </div>
                            <div class="post-body">
                                {!! $service->content !!}
                            </div>
                            <div class="post-tags">
                                @foreach(breakStringToArray($service->tags) as $key => $value)
                                    <a href="#" class="tag">#{{ $value }}</a>
                                @endforeach
                            </div>
                            <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
                                <a href="{{ isset($servicePrevious) ? route('blogs.detail', ['id' => $servicePrevious->id, 'slug' => $servicePrevious->slug]) : '#' }}" class="prev-post text-left d-flex align-items-center">
                                    <div class="icon prev">
                                        <i class="fa fa-angle-left"></i>
                                    </div>
                                    <div class="text">
                                        <strong class="text-primary">Previous Post </strong>
                                        <h6>{{ isset($servicePrevious) ? $servicePrevious->name : 'No post' }}</h6>
                                    </div>
                                </a>
                                <a href="{{ isset($serviceNext) ? route('blogs.detail', ['id' => $serviceNext->id, 'slug' => $serviceNext->slug]) : '#' }}" class="next-post text-right d-flex align-items-center justify-content-end">
                                    <div class="text">
                                        <strong class="text-primary">Next Post </strong>
                                        <h6>{{ isset($serviceNext) ? $serviceNext->name : 'No post' }}</h6>
                                    </div>
                                    <div class="icon next">
                                        <i class="fa fa-angle-right">   </i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <aside class="col-lg-4">
                <div class="widget latest-posts">
                    <header>
                        <h3 class="h6">Other Services</h3>
                    </header>
                    <div class="blog-posts">
                        @foreach ($randomService as $rService)
                            <a href="{{ route('blogs.detail', ['id' => $rService->id, 'slug' => $rService->slug]) }}">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="{{ asset("$rService->image") }}" alt="{{ $rService->name }}" class="img-fluid">
                                    </div>
                                    <div class="title">
                                        <strong>{{ $rService->name }}</strong>
                                        <div class="d-flex align-items-center">
                                            <div class="views"><i class="fa fa-star-o"></i> {{ $rService->star }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('script')

@endsection