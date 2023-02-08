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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
                            @else
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

        <div class="container mt-5 pt-5">
            <div class="container mt-5 pt-5">
                <h1>Upscale/Enhance Image</h1>
                <form action="{{ route('scale') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" value="">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br>
                <h1>Generate Image</h1>
                <p>Hint: <span style="color: red;"> Give A specific prompt for good results </span></p>
                <div class="row mb-4" id="data" style="color: rgb(24, 189, 24);">
                    @if ($results)
                        <p>Search Result</p><br>
                        @foreach($results->data as $key=> $item)
                            <div class="col-md-12">
                                <img src="{{ $item->url }}" alt="Generated Image"><br>
                                <a href="{{ route("download-image", ['id' => $id[$key] ]) }}" class="btn btn-success mt-4 mb-3">Download</a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- Button trigger modal-->
                <div class="text-center mt-4 mb-4">
                    <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Launch
                      Modal</a>
                  </div>

                    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Generate</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body mx-3">
                                    <form method="post" action="{{ route('image-generator') }}">
                                        @csrf
                                        <div class="md-form mb-4">
                                            <i class="fa fa-align-justify" aria-hidden="true"></i>
                                            <input type="text" id="defaultForm-email" class="prompt form-control validate" name="prompt" value="" required>
                                            <label data-error="wrong" data-success="right" for="defaultForm-email">Your Prompt</label>
                                        </div>

                                        <div class="md-form mb-4">
                                            <i class="fa fa-align-justify" aria-hidden="true"></i>
                                            <input type="number" class="number form-control validate" id="defaultForm-email" name="numberofImages" value="" required>
                                            <label data-error="wrong" data-success="right" for="defaultForm-email">Number of Images</label>
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <label class="input-group-text" for="inputGroupSelect01">Options (Image Size)</label>
                                            </div>
                                                <select class="custom-select options" id="inputGroupSelect01" name="type" required>
                                                    <option selected value="">Choose...</option>
                                                    <option value="256x256">256x256</option>
                                                    <option value="512x512">512x512</option>
                                                    <option value="1024x1024">1024x1024</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- preloader --}}
                                        <div class="md-form mb-3" id="loader">
                                            <div class="d-flex justify-content-center ml-5 mr-5">
                                                <strong style="color: red;">Your Request Is Processing...</strong>
                                                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                                            </div>
                                        </div>

                                        <div class="modal-footer d-flex justify-content-center">
                                        <button class="btn btn-default" id="generate" type="submit">Generate</button>
                                        </div>
                                    </form>

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
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        <style>
            body {
                background-color: rgba(238, 238, 238, 0)
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

            #mainNav{
                background-color: black !important;
                color: white !important;
            }
        </style>

        {{-- <script>
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
        </script> --}}
        <script>
            $("#loader").hide()
            $("#generate").click(function(){

                if($("#data").text() ==+ "" && $(".prompt").val() != ""  &&  $(".number").val() != "" &&  $(".options").val() != "" ){
                    $("#loader").show()
                }
            })

        </script>
    </body>
</html>
