<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SDN IPK MOCH TOHA</title>
    <link rel="icon" href="{{ asset('assets/img/sekolah/logo.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
</head>

<body class="bg-light">
    <div class="min-vh-100">

        <div class="position-relative">
            <img src="{{ asset('assets/img/sekolah/FotoSekolah.png') }}" class="w-100 d-block object-fit-cover"
                style="height: 50vh;">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-50"></div>
            <div
                class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-start align-items-center text-white pt-4 mt-5">
                <img src="{{ asset('assets/img/sekolah/logo.png') }}" width="65" height="65"
                    class="rounded-circle bg-white p-1 object-fit-contain">
                <h5 class="fw-bold mt-2 mb-0">SDN IPK MOCH TOHA</h5>
                <small>SDN IPK MOCH TOHA WEBSITE</small>
            </div>
        </div>
        <div class="container position-relative" style="margin-top: -150px;">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">

                    <div class="card border-0 shadow-lg rounded-4">
                        <div class="card-body px-4 py-3">
                            <div class="text-center mb-3">
                                <h4 class="fw-bold mb-1">Selamat Datang</h4>
                                <small class="text-secondary">Silahkan login menggunakan akun yang telah
                                    terdaftar.</small>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show py-2 small" role="alert">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $errors->first() }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show py-2 small" role="alert">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
                                    <i class="fas fa-check-circle me-1"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('login.process') }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label small fw-bold">USERNAME</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">
                                            <i class="fas fa-user text-secondary"></i>
                                        </span>
                                        <input type="text" name="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Masukkan username..." value="{{ old('username') }}" required
                                            autofocus>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small fw-bold">PASSWORD</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">
                                            <i class="fas fa-lock text-secondary"></i>
                                        </span>
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Masukkan password..." required>
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="togglePassword()">
                                            <i class="fas fa-eye-slash" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                                    <i class="fas fa-sign-in-alt me-1"></i> Masuk ke Dashboard
                                </button>
                            </form>
                            <div class="text-center mt-3">
                                <small class="text-secondary">© {{ date('Y') }} SDN IPK MOCH TOHA</small>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }

        setTimeout(function () {
            document.querySelectorAll('.alert').forEach(function (el) {
                el.remove();
            });
        }, 5000);
    </script>

</body>

</html>
