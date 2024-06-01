<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #101010;
            color: #ffffff;
        }
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
        .user-profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .user-profile .username {
            font-size: 1.2em;
            font-weight: bold;
        }
        .user-profile .fullname {
            font-size: 1em;
            color: #bbbbbb;
        }
        .suggestions {
            background-color: #1a1a1a;
            padding: 15px;
            border-radius: 10px;
        }
        .suggestions h5 {
            margin-bottom: 15px;
        }
        .suggestions .user {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .suggestions .user img.avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .suggestions .user div {
            flex-grow: 1;
            margin-left: 10px;
        }
        .suggestions .user strong {
            display: block;
            color: #fff;
        }
        .suggestions .user p {
            margin: 0;
            color: #ccc;
        }
        .suggestions .btn {
            margin-left: auto;
        }
        .post-menu {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .post-menu a {
            color: #ffffff;
            margin: 0 15px;
            font-size: 1.2em;
            font-weight: bold;
        }
        .post-menu a.active {
            border-bottom: 2px solid #ffffff;
        }
        .main-content {
            display: flex;
        }
        .content {
            flex-grow: 1;
        }
        .who-to-follow {
            width: 300px;
            background-color: #1a1a1a;
            padding: 15px;
            border-radius: 10px;
            margin-left: 20px;
        }
        .who-to-follow .user {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .who-to-follow .user img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .who-to-follow .user div {
            flex-grow: 1;
        }
        .who-to-follow .user strong {
            display: block;
            color: #fff;
        }
        .who-to-follow .user p {
            margin: 0;
            color: #ccc;
        }
        .who-to-follow .btn {
            margin-left: auto;
        }
        .search-container {
            margin-top: 20px;
            background-color: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
        }
        .search-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
        }
        .follow-container {
            margin-top: 20px;
            background-color: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
        }
        .follow-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .follow-header button {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 1.2em;
            cursor: pointer;
        }
        .follow-header button.active {
            border-bottom: 2px solid #ffffff;
        }
        .follow-list {
            margin-top: 20px;
        }
        .follow-list .user {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .follow-list .user img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .follow-list .user .user-info {
            flex-grow: 1;
        }
        .follow-list .user .user-info strong {
            display: block;
            color: #fff;
        }
        .follow-list .user .user-info p {
            margin: 0;
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <ul class="nav flex-column">
                    @guest
                    <div class="user-profile">
                        <img src="" alt="User Avatar">
                        <div>
                            <div class="username">silakan login dahulu</div>
                            <div class="fullname">ayo login</div>
                        </div>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('hom') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @endguest

                    @auth
                    <div class="user-profile">
                        <img src="{{ Auth::user()->photo ? asset('storage/profile/' . Auth::user()->photo) : asset('path/to/default/profile-image.png') }}" alt="User Avatar">
                        <div>
                            <a href="{{ route('user.profile') }}"><div class="username">{{ Auth::user()->username }}</div></a>
                            <div class="fullname">{{ Auth::user()->nama }}</div>
                        </div>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Notifikasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posting.form') }}">Posting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.bookmarks') }}">Bookmarks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endauth
                </ul>
            </nav>

            <!-- Main Content -->
   <main class="col-md-10 main-content">
    <!-- Search Container -->
    <div class="search-container">
        <input type="text" id="searchFollow" placeholder="Cari {{ $type == 'followers' ? 'Followers' : 'Following' }}">
    </div>

    <!-- Follow Container -->
    <div class="follow-container">
        <div class="follow-header">
            <button id="followersTab" class="{{ $type == 'followers' ? 'active' : '' }}">Followers</button>
            <button id="followingTab" class="{{ $type == 'following' ? 'active' : '' }}">Following</button>
        </div>
        <div class="follow-list" id="followersList" style="{{ $type == 'followers' ? 'display: block;' : 'display: none;' }}">
            @isset($followers)
                @foreach ($followers as $follower)
                    <div class="user">
                        <div class="user-info">
                            <img src="{{ $follower->photo ? asset('storage/profile/' . $follower->photo) : asset('path/to/default/profile-image.png') }}" alt="User Avatar">
                            <div>
                                <strong>{{ $follower->username }}</strong>
                                <p>{{ '@' . $follower->username }}</p>
                            </div>
                        </div>
                        <form action="{{ route('user.follow', $follower) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-primary">Follow</button>
                        </form>
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="follow-list" id="followingList" style="{{ $type == 'following' ? 'display: block;' : 'display: none;' }}">
            @isset($following)
                @foreach ($following as $follow)
                    <div class="user">
                        <div class="user-info">
                            <img src="{{ $follow->photo ? asset('storage/profile/' . $follow->photo) : asset('path/to/default/profile-image.png') }}" alt="User Avatar">
                            <div>
                                <strong>{{ $follow->username }}</strong>
                                <p>{{ '@' . $follow->username }}</p>
                            </div>
                        </div>
                        <form action="{{ route('user.unfollow', $follow) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-secondary">Unfollow</button>
                        </form>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</main>

<script>
    document.getElementById('followersTab').addEventListener('click', function() {
        window.location.href = "{{ route('user.followers', Auth::user()) }}";
    });

    document.getElementById('followingTab').addEventListener('click', function() {
        window.location.href = "{{ route('user.following', Auth::user()) }}";
    });

    document.getElementById('searchFollow').addEventListener('input', function() {
        var searchQuery = this.value.toLowerCase();
        var users = document.querySelectorAll('.user');
        users.forEach(function(user) {
            var username = user.querySelector('strong').textContent.toLowerCase();
            if (username.includes(searchQuery)) {
                user.style.display = 'block';
            } else {
                user.style.display = 'none';
            }
        });
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
