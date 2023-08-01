<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('argon/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('argon/img/favicon.png') }}">
    <title>
        {{ config('app.name') }}
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('argon/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('argon/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('argon/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('argon/css/argon-dashboard.css?v=2.0.2') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('js/sweetalert2/sweetalert2.min.css') }}">
    <style>
        .tengah {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <style>
        .pagination {
            float: right;
        }
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
                target="_blank">
                <img src="{{ asset('argon/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">{{ config('app.name') }}</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                {{-- @if (Auth::user()->role == 'admin')
                    @include('navbar.admin')
                @elseif(Auth::user()->role == 'penulis')
                    @include('navbar.penulis')
                @else
                    @include('navbar.pembeli')
                @endif --}}

                @switch(Auth::user()->role)
                    @case('admin')
                        @include('navbar.admin')
                    @break

                    @case('penulis')
                        @include('navbar.penulis')
                    @break

                    @default
                        @include('navbar.pembeli')
                @endswitch
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                href="javascript:;">{{ ucfirst(Request::segment(1)) }}</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                            {{ ucfirst(Request::segment(2)) }}</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">{{ ucfirst(Request::segment(2)) }}</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        {{-- <div class="input-group">
							<span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
							<input type="text" class="form-control" placeholder="Type here...">
						</div> --}}
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('content')
            {{-- <footer class="footer pt-3  ">
				<div class="container-fluid">
					<div class="row align-items-center justify-content-lg-between">
						<div class="col-lg-6 mb-lg-0 mb-4">
							<div class="copyright text-center text-sm text-muted text-lg-start">
								© <script>
									document.write(new Date().getFullYear())
								</script>,
								made with <i class="fa fa-heart"></i> by
								<a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
								for a better web.
							</div>
						</div>
						<div class="col-lg-6">
							<ul class="nav nav-footer justify-content-center justify-content-lg-end">
								<li class="nav-item">
									<a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative
										Tim</a>
								</li>
								<li class="nav-item">
									<a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
										target="_blank">About Us</a>
								</li>
								<li class="nav-item">
									<a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
										target="_blank">Blog</a>
								</li>
								<li class="nav-item">
									<a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
										target="_blank">License</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer> --}}
        </div>
    </main>
    @include('layouts._sidebar')
    <!--   Core JS Files   -->
    <script src="{{ asset('argon/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('argon/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('argon/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('argon/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('argon/js/plugins/chartjs.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('argon/js/argon-dashboard.min.js?v=2.0.2') }}"></script>

    <script src="{{ asset('js/sweetalert2/sweetalert2.all.min.js') }}"></script>

    @yield('script')
    @if (Session::has('success'))
        <script type="text/javascript">
            Swal.fire('Success', '{{ Session::get('success') }}', 'success');
        </script>
    @endif

    @if (Session::has('warning'))
        <script type="text/javascript">
            Swal.fire('Warning', '{{ Session::get('warning') }}', 'warning');
        </script>
    @endif

    @if (Session::has('error'))
        <script type="text/javascript">
            Swal.fire('Error', '{{ Session::get('error') }}', 'error');
        </script>
    @endif
    <script>
        function accepted(url) {
            // console.log('accepted');
            $('#accepted').modal("show");
            $('#accepted').modal();
            $('#formAccepted').html('<form action="' + url +
                '" method="POST"> @csrf<button type="submit" class="btn btn-primary">Accept</button></form>'
            );
        }

        function rejected(url) {
            $('#rejected').modal("show");
            $('#rejected').modal();
            $('#formRejected').html('<form action="' + url +
                '" method="POST"> @csrf<button type="submit" class="btn btn-danger">Reject</button></form>'
            );
        }

        function hide() {
            // console.log('update');
            $('#accepted').modal("hide");
            $('#rejected').modal("hide");
        }
    </script>

</body>

</html>
