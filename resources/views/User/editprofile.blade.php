@extends('../layouts.master')

@section('title', 'edit Profile')
@section('content')

    <style>
           .edit-profile {
            background-color: #1a1a1a;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            max-width: 400px;
            text-align: center;
        }
        .edit-profile h2 {
            text-align: center;
        }
        .edit-profile input, .edit-profile textarea {
            background-color: #101010;
            border: 1px solid #333333;
            color: #ffffff;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .edit-profile button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .edit-profile button:hover {
            background-color: #0056b3;
        }
        .edit-profile .profile-image {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }
        .edit-profile .profile-image img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
    </style>

            <!-- Main Content -->
            <main class="col-md-10">
                @yield('content')
                <!-- Edit Profile Section -->
                <div class="edit-profile">
                    <h2>Edit Profile</h2>
                    
                      <form method="POST" action="{{ route('user.update.profile') }}" enctype="multipart/form-data">
            @csrf
            <div class="profile-image">
                <img src="{{ Auth::user()->photo ? asset('storage/profile/' . Auth::user()->photo) : asset('path/to/default/profile-image.png') }}" alt="User Avatar">
            </div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ Auth::user()->username }}">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ Auth::user()->nama }}">
            <label for="bio">Bio</label>
            <textarea id="bio" name="bio">{{ Auth::user()->bio }}</textarea>
            <label for="photo">Profile Photo</label>
            <input type="file" id="photo" name="photo">
            <button type="submit">Edit</button>
        </form>
                </div>
            </main>
        </div>
    </div>
@endsection

