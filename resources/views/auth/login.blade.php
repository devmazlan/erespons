<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>ERESPON - LOGIN</title>
    <!--favicon-->
    <link rel="icon" href="assets/pkulogo.png" type="image/png" />
    <!-- loader-->
    <link href="{{ asset('newtem/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('newtem/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('newtem/assets/css/bootstrap.min.css') }}" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('newtem/assets/css/icons.css') }}" />
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('newtem/assets/css/app.css') }}" />
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg mb-5 navbar-light bg-white fixed-top border-bottom">
            <a class="navbar-brand mt-2" href="javascript:;">
                <h5 class="font-weight-bold display-10">ERESPON KOTA PEKANBARU </h5>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item"> <a class="nav-link" href="javascript:;"><span>version : 1.0</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="error-404 d-flex mt-4 align-items-center justify-content-center">



            <div class="col-12 col-lg-4 mx-auto">
                <div class="card radius-2">
                    <form class="form-auth-small" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="col-12 col-lg-12">
                            <div class="card-body p-md-4">
                                <div class="text-center">
                                    <img src="{{ asset('assets/pkulogo.png') }}" height="70" alt="">

                                    <h5 class="font-weight-bold">LOGIN AKUN </h5>
                                </div>

                                <div class="form-group ">
                                    <label>Username/NIK </label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your Username" />

                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" />
                                </div>

                                <div class="btn-group mt-3 w-100">
                                    <button type="submit" class="btn btn-warning btn-block">LOGIN</button>

                                </div>
                                <hr>
                                <div class="text-center">
                                    <p class="mb-0">Don't have an account? <a href="#">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!--end row-->
                </div>
            </div>



        </div>

    </div>
    <!-- end wrapper -->
    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('newtem/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('newtem/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('newtem/assets/js/bootstrap.min.js') }}"></script>
</body>

</html>