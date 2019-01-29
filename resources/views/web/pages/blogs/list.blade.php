@extends('web.layout')

@section('title', 'Blogs')
@section('css')
    <link rel="stylesheet" href="{{ asset('web/css/blog.list.css') }}">
@endsection

@section('content')
    <div id="blog-list">
        <div class="container header-padding-top">
            <div class="row" id="blog-title-all">{{ __('homepage.blog_list') }}</div>
            <div class="row" id="blog">
                <!-- Latest Posts -->
                <main class="posts-listing col-lg-12">
                    <div class="container">
                        <div class="row">
                        @foreach($blogList as $blog)
                            @foreach($blog->translations as $trans)
                                @if(checkLanguage($trans->locale, 'boolean'))
                                    <!-- post -->
                                    <div class="post col-xl-4">
                                        <div class="pre-content">
                                            <div class="post-thumbnail blog-image">
                                                <a href="{{ route('blogs.detail', ['id' => $blog->blogs_id, 'slug' => $trans->slug]) }}">
                                                    <img src='{{ asset("$blog->image") }}' alt="{{ $trans->title }}" class="img-fluid" width="100%">
                                                </a>
                                            </div>
                                            <div class="post-details blog-detail">
                                                <div class="post-meta d-flex justify-content-between">
                                                    <div class="date meta-last blog-created">{{ dateFormat($blog->created_at, "F j| Y") }}</div>
                                                    <div class="category blog-tag">
                                                        @php $tag = breakStringToArray($trans->tags)[0]; @endphp
                                                        @if(isset($tag))
                                                            @if(strlen($tag) < 11)
                                                                <a href="#">{{ strtoupper($tag) }}</a>
                                                            @else
                                                                <a href="#">BLOGS</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <a class="blog-title" href="{{ route('blogs.detail', ['id' => $blog->id, 'slug' => $trans->slug]) }}">
                                                    <h3 class="h4">{{ $trans->title }}</h3>
                                                </a>
                                                <p class="text-muted blog-content">
                                                    {!! (strlen($trans->description) > 350) ? substr($trans->description, 0, 347) . ' ... ' : $trans->description !!}
                                                    <a href="{{ route('blogs.detail', ['id' => $blog->id, 'slug' => $trans->slug]) }}" class="blog-more">{{ __('homepage.continue_reading') }}</a>
                                                </p>
                                                <footer class="post-footer d-flex align-items-center">
                                                    <a href="#" class="author d-flex align-items-center flex-wrap">
                                                        <div class="avatar">
                                                            <img src="{{ asset('web/img/admin_logo.png') }}" alt="Admin" class="img-fluid">
                                                        </div>
                                                        <div class="title">
                                                            <span>{{ $blog->author }}</span>
                                                        </div>
                                                    </a>
                                                    <div class="date">
                                                        <i class="icon-clock"></i> {{ timeElapsedString($blog->created_at) }}
                                                    </div>
                                                    <div class="views meta-last">
                                                        <i class="icon-eye"></i> {{ $blog->view }}
                                                    </div>
                                                </footer>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                        </div>
                        <!-- Pagination -->

                        <nav aria-label="Page navigation example">
                            @if (isset($blogList) && $blogList->lastPage() > 1)
                                <ul class="pagination pagination-template d-flex justify-content-center">
                                @php
                                    $interval = isset($interval) ? abs(intval($interval)) : 3 ;
                                    $from = $blogList->currentPage() - $interval;
                                    if($from < 1){
                                        $from = 1;
                                    }

                                    $to = $blogList->currentPage() + $interval;
                                    if($to > $blogList->lastPage()){
                                        $to = $blogList->lastPage();
                                    }
                                @endphp


                                <!-- first/previous -->
                                    @if($blogList->currentPage() > 1)
                                        <li class="page-item">
                                            <a href="{{ $blogList->url(1) }}" class="page-link">
                                                <i class="fa fa-angle-double-left"></i>
                                            </a>
                                        </li>

                                        <li class="page-item">
                                            <a href="{{ $blogList->url($blogList->currentPage() - 1) }}" class="page-link">
                                                <i class="fa fa-angle-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                <!-- links -->
                                    @for($i = $from; $i <= $to; $i++)
                                        @php
                                            $isCurrentPage = $blogList->currentPage() == $i;
                                        @endphp
                                        <li class="page-item">
                                            <a href="{{ !$isCurrentPage ? $blogList->url($i) : '#' }}" class="page-link {{ $isCurrentPage }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                <!-- next/last -->
                                    @if($blogList->currentPage() < $blogList->lastPage())
                                        <li class="page-item">
                                            <a href="{{ $blogList->url($blogList->currentPage() + 1) }}" class="page-link">
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </li>

                                        <li class="page-item">
                                            <a href="{{ $blogList->url($blogList->lastpage()) }}" class="page-link">
                                                <i class="fa fa-angle-double-right"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </nav>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection