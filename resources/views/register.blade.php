
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow-lg p-4" style="background-color: #000; border: none;">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="text-center mb-4" style="color: #fff;">Login</h3>

                    <form action="{{ route('register.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username" style="color: #fff;">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username kamu">
                        </div>
                        <div class="form-group">
                            <label for="nama" style="color: #fff;">Nama</label>
                            <input type="nama" class="form-control" id="nama" name="nama" placeholder="Masukkan password kamu">
                        </div>
                         <div class="form-group">
                            <label for="email" style="color: #fff;">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan password kamu">
                        </div>
                         <div class="form-group">
                            <label for="password" style="color: #fff;">password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password kamu">
                        </div>
                         <div class="form-group">
                            <label for="confirm password" style="color: #fff;">confirm password</label>
                            <input type="confirm password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Masukkan password kamu">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">register</button>
                        <p class="text-center mt-3" style="color: #fff;">sudah punya akun? <a href="{{ route('login')}}" style="color: #1da1f2;">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #000;
            font-family: Arial, sans-serif;
        }
        .container {
            padding-top: 50px;
        }
        .card {
            border-radius: 10px;
        }
        .form-control {
            border-radius: 30px;
            padding: 10px 20px;
            background-color: #222;
            color: #fff;
            border: none;
        }
        .form-control::placeholder {
            color: #aaa;
        }
        .btn-primary {
            background-color: #1da1f2;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #1a91da;
        }
        .alert-success {
            border-radius: 30px;
            padding: 10px 20px;
        }
        .text-center a {
            color: #1da1f2;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</body>
</html>
