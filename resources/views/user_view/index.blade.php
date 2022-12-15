<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>AI Blogs</title>
        <link rel="icon" type="image/x-icon" href="{{asset('assets2\assets\favicon.ico')}}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('assets2\css\styles.css')}}" rel="stylesheet" />
        {{-- <link href="{{asset('assets\scss\my_scss.scss')}}" rel="stylesheet" /> --}}

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Blogging With Ai</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                        <li class="nav-item"><a class="nav-link" href="#signup">Contact</a></li>
                        @auth
                            @if (Auth::user()->user_role == 'admin')
                                <li class="nav-item">
                                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                            @else

                            @endif
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <li class="nav-item">
                                    <button type="submit" class="btn btn-primary mt-3">Logout</button>
                                </li>

                            </form>

                        @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="ml-4 nav-link">Register</a>
                                </li>
                            @endif
                        @endauth

                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">Artificial Intelligence</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">Scale Your Business With AI</h2>
                        <a class="btn btn-primary" href="#about">Get Started</a>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <h1>Welcome</h1>
        </div>


        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; Your Website 2022</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
