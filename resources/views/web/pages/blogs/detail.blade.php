@extends('web.layout')

@section('title', 'Blogs')
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
                            <img src="{{ asset("$blog->image") }}" alt="{{ $blog->title }}" class="img-fluid">
                        </div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="category"><a href="#">Business</a><a href="#">Financial</a></div>
                            </div>
                            <h1>{{ $blog->title }} <a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                            <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
                                <a href="#" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar">
                                        <img src="{{ asset('web/img/admin_logo.png') }}" alt="..." class="img-fluid">
                                    </div>
                                    <div class="title">
                                        <span>{{ $blog->author }}</span>
                                    </div>
                                </a>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="date"><i class="icon-clock"></i> {{ timeElapsedString($blog->created_at) }}</div>
                                    <div class="views meta-last"><i class="icon-eye"></i> {{ $blog->view }}</div>
                                </div>
                            </div>
                            <div class="post-body">
                                {!! $blog->content !!}
                            </div>
                            <div class="post-tags">
                                @foreach(breakStringToArray($blog->tags) as $key => $value)
                                    <a href="#" class="tag">#{{ $value }}</a>
                                @endforeach
                            </div>
                            <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
                                <a href="{{ isset($blogPrevious) ? route('blogs.detail', ['id' => $blogPrevious->id, 'slug' => $blogPrevious->slug]) : '#' }}" class="prev-post text-left d-flex align-items-center">
                                    <div class="icon prev">
                                        <i class="fa fa-angle-left"></i>
                                    </div>
                                    <div class="text">
                                        <strong class="text-primary">Previous Post </strong>
                                        <h6>{{ isset($blogPrevious) ? $blogPrevious->title : 'No post' }}</h6>
                                    </div>
                                </a>
                                <a href="{{ isset($blogNext) ? route('blogs.detail', ['id' => $blogNext->id, 'slug' => $blogNext->slug]) : '#' }}" class="next-post text-right d-flex align-items-center justify-content-end">
                                    <div class="text">
                                        <strong class="text-primary">Next Post </strong>
                                        <h6>{{ isset($blogNext) ? $blogNext->title : 'No post' }}</h6>
                                    </div>
                                    <div class="icon next">
                                        <i class="fa fa-angle-right">   </i>
                                    </div>
                                </a>
                            </div>

                            <div class="add-comment">
                                <header>
                                    <h3 class="h6">Leave a reply</h3>
                                </header>
                                <form action="{{ route('feedbacks.store') }}" class="commenting-form" method="post" role="form">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="text" name="name" id="username" placeholder="Name" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" name="mail" id="useremail" placeholder="Email Address (will not be published)" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="text" name="subject" id="usersubject" placeholder="Subject of your comment" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea name="content" id="usercomment" placeholder="Type your comment" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-secondary">Submit Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <aside class="col-lg-4">
                <div class="widget latest-posts">
                    <header>
                        <h3 class="h6">Random Posts</h3>
                    </header>
                    <div class="blog-posts">
                        @foreach ($randomBlog as $rBlog)
                            <a href="{{ route('blogs.detail', ['id' => $rBlog->id, 'slug' => $rBlog->slug]) }}">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="{{ asset("$rBlog->image") }}" alt="{{ $rBlog->title }}" class="img-fluid">
                                    </div>
                                    <div class="title">
                                        <strong>{{ $rBlog->title }}</strong>
                                        <div class="d-flex align-items-center">
                                            <div class="views"><i class="icon-eye"></i> {{ $rBlog->view }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Widget [Tags Cloud Widget]-->
                <div class="widget tags">
                    <header>
                        <h3 class="h6">Tags</h3>
                    </header>
                    <ul class="list-inline">
                        @foreach(breakStringToArray($blog->tags) as $key => $value)
                            <li class="list-inline-item"><a href="#" class="tag">#{{ $value }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('script')

@endsection