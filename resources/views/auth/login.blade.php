<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Favio Aurelio, GuitHub: AurelioTec">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} @yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/blade/favicon.ico') }}" type="image/x-icon">
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container mb-5">
                        <img src="{{ asset('img/blade/Logo.png') }}" class="brand_logo" alt="Logo">
                    </div>
                    <div class="pt-3 mb-3 titulo">
                        <h2>Login</h2>
                    </div>
                </div>
                <div class="mt-0 pt-0 d-flex justify-content-center form_container">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="email" id="email" class="form-control input_user"
                                value="" placeholder="email">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" id="password" class="form-control input_pass"
                                value="" placeholder="password">
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" class="btn login_btn">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        @if(session('login_error'))
        //alert("{{ session('login_error') }}");
        Swal.fire({
            icon: "error",
            title: "Erro!",
            text: "{{ session('login_error') }}",
        });
        //toastr.error("{{ session('login_error') }}");
        @endif
    </script>
</body>

</html>