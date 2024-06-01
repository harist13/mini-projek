<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        .upload-section {
            background-color: #1a1a1a;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .upload-section input[type="file"] {
            display: none;
        }
        .upload-section label {
            cursor: pointer;
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            border-radius: 5px;
            color: #fff;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Explore</a>
                    </li>

                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @endguest

                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="#">Notifikasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Posting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bookmarks</a>
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
            <!-- Main content -->
            <main class="col-md-10 ml-sm-auto col-lg-10 px-4">
                @yield('content')
                
                @auth
                <!-- Image Upload Section -->
                <div class="upload-section">
                    <h5>Deskripsi Postingan</h5>
                   <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <textarea name="description" class="form-control mb-3" rows="3" placeholder="Deskripsi postingan"></textarea>
    <label for="imageUpload">Pilih gambar</label>
    <input type="file" name="image" id="imageUpload" accept="image/*">
    <br>
    <button type="submit" class="btn btn-primary">Posting</button>
</form>

                </div>
                @endauth
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
