@extends('../layouts.master')

@section('title', 'User Profile')
<style>
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
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .user-profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .user-profile .username {
            font-size: 1.2em;
            font-weight: bold;
        }
        .user-profile .fullname {
            font-size: 1em;
            color: #bbbbbb;
        }
        .user-profile .bio {
            margin-top: -10px;
            color: #bbbbbb;
        }
        .user-profile .stats {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .user-profile .stat {
            margin-right: 20px;
        }
        .user-profile .settings {
            margin-top: 10px;
        }
        .user-profile .settings i {
            font-size: 1.5em;
            color: #bbbbbb;
        }
        .posts .post p {
            color: #bbbbbb;
        }
</style>

@section('content')
<!-- Modal -->
<div class="modal fade" id="confirmPasswordModal" tabindex="-1" role="dialog" aria-labelledby="confirmPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmPasswordModalLabel" style="color: black;">Confirm Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="confirmPasswordForm">
          @csrf
          <div class="form-group">
            <label for="password" style="color: black;">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div id="error-message" class="text-danger"></div>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="col-md-10">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="user-profile text-center">
                <img src="{{ Auth::user()->photo ? asset('storage/profile/' . Auth::user()->photo) : asset('path/to/default/profile-image.png') }}" alt="User Avatar" class="rounded-circle" width="80" height="80">
                <h4 class="username mt-2">{{ $user->username }}</h4>
                <p class="fullname">{{ $user->nama }}</p>
                <p class="bio">{{ $user->bio }}</p>
                <div class="stats d-flex justify-content-center">
                    <div class="stat mr-4">
                        <strong>{{ $user->posts->count() }}</strong> Posts
                    </div>
                    <div class="stat mr-4">
                        <strong><a href="{{ route('user.followers', $user) }}">{{ $user->followers_count }}</a></strong> Followers
                    </div>
                    <div class="stat">
                        <strong><a href="{{ route('user.following', $user) }}">{{ $user->following_count }}</a></strong> Following
                    </div>
                </div>
            </div>
            <div class="posts mt-4">
                <a href="{{ route('user.edit.profile') }}" id="editProfileBtn"><i class="fa fa-cog" aria-hidden="true"></i></a>
                
                @forelse ($posts as $post)
                    <div class="post text-center">
                        <img src="{{ asset($post->image_path) }}" alt="Post Image" class="img-fluid" style="max-height: 300px;">
                      
                    </div>
                @empty
                    <div class="post text-center">
                        <p>Belum ada postingan yang dapat ditampilkan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editProfileBtn').addEventListener('click', function (e) {
        e.preventDefault();
        $('#confirmPasswordModal').modal('show');
    });

    document.getElementById('confirmPasswordForm').addEventListener('submit', function (e) {
        e.preventDefault();
        
        let password = document.getElementById('password').value;
        let errorMessage = document.getElementById('error-message');
        
        fetch('{{ route('user.confirm.password') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ password: password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route('user.edit.profile') }}';
            } else {
                errorMessage.textContent = data.message;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>

@endsection
