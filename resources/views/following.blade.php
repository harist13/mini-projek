@extends('layouts.master')
@section('title', 'Beranda')

@section('content')
 
<main class="col-md-8">
    <div class="post-menu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">For You</a>
        <a href="{{ route('following') }}" class="{{ request()->routeIs('following') ? 'active' : '' }}">Following</a>
    </div>
    @foreach ($posts as $post)
        <div class="post" data-post-id="{{ $post->id }}">
            <div class="d-flex justify-content-between">
                <div>
                    <strong>{{ $post->user->username }}</strong>
                    <p>{{ $post->created_at->diffForHumans() }}</p>
                </div>
                <div>
                    <button class="btn btn-link text-white">...</button>
                </div>
            </div>
            <div class="text-center">
                <img src="{{ $post->image_path }}" alt="Post Image" class="img-fluid">
            </div>
            <div class="mt-3">
                <p>{{ $post->content }}</p>
                <div class="d-flex justify-content-between">
                    @if (Auth::check() && $post->likes->contains('user_id', Auth::id()))
                        <i class="fa-solid fa-heart unlike" style="cursor:pointer;"></i>
                    @else
                        <i class="fa-regular fa-heart like" style="cursor:pointer;"></i>
                    @endif
                    <span class="likes-count">{{ $post->likes->count() }} likes</span>
                    <span>{{ $post->comments->count() }} comments</span>
                    @if (Auth::check() && $post->bookmarks->contains('user_id', Auth::id()))
                        <i class="fa-solid fa-bookmark unbookmark" style="cursor:pointer;"></i>
                    @else
                        <i class="fa-regular fa-bookmark bookmark" style="cursor:pointer;"></i>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</main>

 <div class="content">
                  
                    
                </div>



<script>
$(document).ready(function() {
    $('.like').on('click', function() {
        var post = $(this).closest('.post');
        var postId = post.data('post-id');
        var likeButton = $(this);
        var unlikeButton = post.find('.unlike');

        $.ajax({
            url: '/posts/' + postId + '/like',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                likeButton.removeClass('fa-regular fa-heart like').addClass('fa-solid fa-heart unlike');
                post.find('.likes-count').text(response.likes_count + ' likes');
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    // Redirect to login page if user is not authenticated
                    window.location.href = '{{ route("login") }}';
                } else {
                    console.log(xhr.responseText);
                }
            }
        });
    });

    $(document).on('click', '.unlike', function() {
        var post = $(this).closest('.post');
        var postId = post.data('post-id');
        var unlikeButton = $(this);
        var likeButton = post.find('.like');

        $.ajax({
            url: '/posts/' + postId + '/unlike',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                unlikeButton.removeClass('fa-solid fa-heart unlike').addClass('fa-regular fa-heart like');
                post.find('.likes-count').text(response.likes_count + ' likes');
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    // Redirect to login page if user is not authenticated
                    window.location.href = '{{ route("login") }}';
                } else {
                    console.log(xhr.responseText);
                }
            }
        });
    });

    $('.bookmark').on('click', function() {
        var post = $(this).closest('.post');
        var postId = post.data('post-id');
        var bookmarkButton = $(this);
        var unbookmarkButton = post.find('.unbookmark');

        $.ajax({
            url: '/posts/' + postId + '/bookmark',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                bookmarkButton.removeClass('fa-regular fa-bookmark bookmark').addClass('fa-solid fa-bookmark unbookmark');
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    window.location.href = '{{ route("login") }}';
                } else {
                    console.log(xhr.responseText);
                }
            }
        });
    });

    $(document).on('click', '.unbookmark', function() {
        var post = $(this).closest('.post');
        var postId = post.data('post-id');
        var unbookmarkButton = $(this);
        var bookmarkButton = post.find('.bookmark');

        $.ajax({
            url: '/posts/' + postId + '/unbookmark',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                unbookmarkButton.removeClass('fa-solid fa-bookmark unbookmark').addClass('fa-regular fa-bookmark bookmark');
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    window.location.href = '{{ route("login") }}';
                } else {
                    console.log(xhr.responseText);
                }
            }
        });
    });
});
</script>

@endsection
