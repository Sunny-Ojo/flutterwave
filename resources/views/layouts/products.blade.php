<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>@yield('title', 'DTCE Event Registration  | Welcome')</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
          <!-- Custom styles for this template -->
        <link href="{{ asset('css1/shop-homepage.css') }}" rel="stylesheet" />
        <link href="{{asset('vendor1/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarResponsive"
                    aria-controls="navbarResponsive"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/ "
                                >Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/childrens">Teenagers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/teachers">Teachers</a>
                        </li>



                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">
            <div class="row ">
                <div class="col-lg-3">
                    {{-- <h1 class="my-4">Items<span class="text-danger">S</span><span class="text-warning">how</span> &circledR;</h1> --}}
                    <div class="list-group">

                        <h4 class="bg-success text-white p-1 text-center mt-5">Categories</h4>
                        <a href="/childrens " class="list-group-item text-decoration-none">Childrens/Teenagers</a>
                        <a href="/teachers " class="list-group-item text-decoration-none">Teachers</a>




                    </div>
                </div>
                <!-- /.col-lg-3 -->

                <div class="col-lg-9 mt-4">
                    {{-- @include('layouts.msg') --}}

                    <div
                        id="carouselExampleIndicators"
                        class="carousel slide my-4"
                        data-ride="carousel"
                    >
                        <ol class="carousel-indicators">
                            <li
                                data-target="#carouselExampleIndicators"
                                data-slide-to="0"
                                class="active"
                            ></li>
                            <li
                                data-target="#carouselExampleIndicators"
                                data-slide-to="1"
                            ></li>
                            <li
                                data-target="#carouselExampleIndicators"
                                data-slide-to="2"
                            ></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img
                                    class="d-block img-fluid"
                                    src="{{ asset('img/rccg.jpg') }}"
                                    alt="First slide"
                                />
                            </div>
                            <div class="carousel-item">
                                <img
                                    class="d-block img-fluid"
                                    src="{{ asset('img/rccg.jpg') }}"
                                    alt="Second slide"
                                />
                            </div>
                            <div class="carousel-item">
                                <img
                                    class="d-block img-fluid"
                                    src="{{ asset('img/rccg.jpg') }}"
                                    alt="Third slide"
                                />
                            </div>
                        </div>
                        <a
                            class="carousel-control-prev"
                            href="#carouselExampleIndicators"
                            role="button"
                            data-slide="prev"
                        >
                            <span
                                class="carousel-control-prev-icon"
                                aria-hidden="true"
                            ></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a
                            class="carousel-control-next"
                            href="#carouselExampleIndicators"
                            role="button"
                            data-slide="next"
                        >
                            <span
                                class="carousel-control-next-icon"
                                aria-hidden="true"
                            ></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <hr class="bg-warning">
        <div class="row justify-content-center">
                                @yield('content')

        </div>

                    <!-- /.row -->
                </div>
                <!-- /.col-lg-9 -->
                </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

        <!-- Footer -->

        <footer class=" bg-dark mb-2 p-2">
            <div class="container text-center ">
                <h4 class="text-white">Useful Links</h4>
                <a href="https://rccgjuniorchurch.org" class="text-warning">Home</a> <br>
            <a href="/info@rccgjuniorchurch.org" class="text-warning">Contact Us</a>
                <p class="m-0 text-white">
                    Copyright &copy; DTCE Junior Church - {{ date('Y') }}
                </p>
            </div>
            <!-- /.container -->
        </footer>


        <!-- Bootstrap core JavaScript -->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('js/main.js')}}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    </body>

</html>
