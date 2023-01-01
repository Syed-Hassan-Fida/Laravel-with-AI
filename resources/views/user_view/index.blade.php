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
        {{-- jquery cdn --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        {{-- fontawesom --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"></script>


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
                        <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Projects</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Contact</a></li>
                        @auth
                            @if (Auth::user()->user_role == 'admin')
                                <li class="nav-item">
                                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                            @elseif(Auth::user()->user_role == 'client')
                                <li class="nav-item">
                                    <a href="{{ route('home.page') }}" class="nav-link">Search</a>
                                </li>
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

            <div class="container m-4 mb-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="fa-solid fa-blog"></i> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0">Text Generation</h6> <span>Rating: 4.6</span>
                                    </div>
                                </div>
                                <div class="badge"> <a href="{{ route('blog-generator-view') }}" class="btn"><span>AI Tool</span></a> </div>
                            </div>
                            <div class="mt-5">
                                <h3 class="heading">AI<br>BLOG-Generation</h3>
                                <div class="mt-5">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-3"> <span class="text1">32 Users <span class="text2">Applied</span></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="fa-solid fa-blog"></i> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0">Image Generation</h6> <span>Rating: 4.6</span>
                                    </div>
                                </div>
                                <div class="badge"> <a href="{{ route('image-view') }}" class="btn"><span>AI Tool</span></a> </div>
                            </div>
                            <div class="mt-5">
                                <h3 class="heading">AI<br>Qualty Images</h3>
                                <div class="mt-5">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-3"> <span class="text1">32 Users <span class="text2">Applied</span></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="fa-solid fa-blog"></i> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0">Blog Intro Generation</h6> <span>Rating: 4.6</span>
                                    </div>
                                </div>
                                <div class="badge"> <a href="" class="btn"><span>AI Tool</span></a> </div>
                            </div>
                            <div class="mt-5">
                                <h3 class="heading">AI<br>BLOG-Generation</h3>
                                <div class="mt-5">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-3"> <span class="text1">32 Users <span class="text2">Applied</span></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container m-4 mb-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="fa-solid fa-blog"></i> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0">Blog Body Generation</h6> <span>Rating: 4.6</span>
                                    </div>
                                </div>
                                <div class="badge"> <a href="" class="btn"><span>AI Tool</span></a> </div>
                            </div>
                            <div class="mt-5">
                                <h3 class="heading">AI<br>BLOG-Generation</h3>
                                <div class="mt-5">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-3"> <span class="text1">32 Users <span class="text2">Applied</span></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="fa-solid fa-blog"></i> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0">Blog Body Generation</h6> <span>Rating: 4.6</span>
                                    </div>
                                </div>
                                <div class="badge"> <a href="" class="btn"><span>AI Tool</span></a> </div>
                            </div>
                            <div class="mt-5">
                                <h3 class="heading">AI<br>BLOG-Generation</h3>
                                <div class="mt-5">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-3"> <span class="text1">32 Users <span class="text2">Applied</span></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="fa-solid fa-blog"></i> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0">Blog Body Generation</h6> <span>Rating: 4.6</span>
                                    </div>
                                </div>
                                <div class="badge"> <a href="" class="btn"><span>AI Tool</span></a> </div>
                            </div>
                            <div class="mt-5">
                                <h3 class="heading">AI<br>BLOG-Generation</h3>
                                <div class="mt-5">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-3"> <span class="text1">32 Users <span class="text2">Applied</span></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; By Source Code Solutions 2022</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        <style>
            body {
                background-color: #eee
            }

            .card {
                border: none;
                border-radius: 10px
            }

            .c-details span {
                font-weight: 300;
                font-size: 13px
            }

            .icon {
                width: 50px;
                height: 50px;
                background-color: #eee;
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 39px
            }

            .badge span {
                background-color: #fffbec;
                width: 60px;
                height: 25px;
                padding-bottom: 3px;
                border-radius: 5px;
                display: flex;
                color: #ff9900;
                justify-content: center;
                align-items: center
            }

            .progress {
                height: 10px;
                border-radius: 10px
            }

            .progress div {
                background-color: red
            }

            .text1 {
                font-size: 14px;
                font-weight: 600
            }

            .text2 {
                color: #a5aec0
            }
            .colored{
                /* background-color: #fff !important; */
                /* transition: background-color 200ms linear; */
                color: black;
            }
        </style>

        <script>
            $(document).ready(function(){
            $(window).scroll(function(){
                var scroll = $(window).scrollTop();
                console.log(scroll)
                if (scroll > 540) {
                    $(".nav-link").css("color", "black");
                    $(".navbar-brand").css("color", "black");
                } else {
                    $(".nav-link").css("color", "rgba(255, 255, 255, 0.5)");
                    $(".navbar-brand").css("color", "rgba(255, 255, 255, 0.5)");
                }


            })
        })
        </script>
    </body>
</html>
