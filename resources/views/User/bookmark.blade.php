 @extends('../layouts.master')

@section('title', 'Bookmarks')
<style>
        .sidebar {
            background-color: #151515;
            height: 100vh;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ffffff;
        }
   
        .post {
            background-color: #1a1a1a;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .suggestions {
            background-color: #151515;
            padding: 20px;
            border-radius: 10px;
        }
        .suggestions .user {
            margin-bottom: 10px;
        }
        .bookmarks-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .bookmark-card {
            background-color: #1a1a1a;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin: 20px;
        }
        .bookmark-card img {
            max-width: 100px;
            border-radius: 10px;
        }
        .bookmark-card h5 {
            margin-top: 10px;
        }
    </style>
@section('content')

            <!-- Main content -->
          <main class="col-md-10">
    <div class="bookmarks-container">
        @foreach ($bookmarks as $bookmark)
            <div class="bookmark-card">
                <h5>{{ $bookmark->post->user->username }}</h5>
                <p>{{ $bookmark->post->created_at->diffForHumans() }}</p>
                <img src="{{ $bookmark->post->image_path }}" alt="Bookmark Image">
                <p>{{ $bookmark->post->content }}</p>
            </div>
        @endforeach
    </div>
</main>
        </div>
    </div>

   
@endsection
