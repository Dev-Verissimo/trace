<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <meta name="description" content="">

    <meta name="author" content="">

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link rel="shortcut icon" href="{{ env('APP_URL') }}images/favicon.png" type="image/png">



    <title>

        @hasSection('title')

            @yield('title')

        @endif

        4-trace</title>



    <link rel="stylesheet" href="{{ env('APP_URL') }}lib/Hover/hover.css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}lib/fontawesome/css/font-awesome.css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}lib/weather-icons/css/weather-icons.css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}lib/ionicons/css/ionicons.css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}lib/jquery-toggles/toggles-full.css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}lib/morrisjs/morris.css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}css/quirk.css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}css/style.css">



    <link rel="stylesheet" href="{{ env('APP_URL') }}backend/assets/datatables/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}backend/assets/datatables/css/responsive.dataTables.min.css">



    <script src="{{ env('APP_URL') }}lib/modernizr/modernizr.js"></script>



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>

    <script src="{{ env('APP_URL') }}lib/html5shiv/html5shiv.js"></script>

    <script src="{{ env('APP_URL') }}lib/respond/respond.src.js"></script>

    <![endif]-->

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ env('APP_URL') }}backend/assets/js/moment.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

</head>



<body>



<header>

    <div class="headerpanel">



        <div class="logopanel">

        </div><!-- logopanel -->



        <div class="headerbar">



            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>



            <div class="searchpanel">

                <form action="{{route('admin.busca.pesquisa')}}" method="post">

                    @csrf

                    <div class="input-group">

                        <input type="text"

                               value="{{isset($pesquisa) ? $pesquisa : ''}}"

                               required name="pesquisa" class="form-control" placeholder="Buscar">

                        <span class="input-group-btn">

                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>

                    </span>

                    </div><!-- input-group -->

                </form>

            </div>



            <div class="header-right">

                <ul class="headermenu">

                    <li>

                        <a href="{{route("admin.logout")}}" class="btn btn-chat">

                            <i class="fa fa-sign-out"></i>

                        </a>

                    </li>

                </ul>

            </div><!-- header-right -->

        </div><!-- headerbar -->

    </div><!-- header-->

</header>



<section>



    @include('admin.includes.sidbar')

    <div class="mainpanel">



        <!--<div class="pageheader">

          <h2><i class="fa fa-home"></i> Dashboard</h2>

        </div>-->



        <div class="contentpanel">

            <div class="row">

                <div class="col-md-9 col-lg-8 dash-left">

                    @yield('content')

                </div>

                

            </div>





        </div><!-- contentpanel -->



    </div><!-- mainpanel -->



</section>



<script src="{{ env('APP_URL') }}lib/jquery/jquery.js"></script>

<script src="{{ env('APP_URL') }}lib/jquery-ui/jquery-ui.js"></script>

<script src="{{ env('APP_URL') }}lib/bootstrap/js/bootstrap.js"></script>

<script src="{{ env('APP_URL') }}lib/jquery-toggles/toggles.js"></script>

<script src="{{ env('APP_URL') }}lib/morrisjs/morris.js"></script>

<script src="{{ env('APP_URL') }}lib/raphael/raphael.js"></script>

<script src="{{ env('APP_URL') }}lib/flot/jquery.flot.js"></script>

<script src="{{ env('APP_URL') }}lib/flot/jquery.flot.resize.js"></script>

<script src="{{ env('APP_URL') }}lib/jquery-knob/jquery.knob.js"></script>

<script src="{{ env('APP_URL') }}js/quirk.js"></script>

<script src="{{ env('APP_URL') }}js/site.js"></script>

<script src="{{env('APP_URL') }}backend/assets/js/tinymce/tinymce.min.js"></script>

<script src="{{env('APP_URL') }}backend/assets/js/lib.js"></script>

<script src="{{ env('APP_URL') }}backend/assets/js/scripts.js"></script>

{{--<script src="{{asset('js/dashboard.js')}}"></script>--}}

{{--<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>--}}

{{--<!-- Chartisan -->--}}

{{--<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>--}}

{{--<!-- Charting library -->--}}

{{--<script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>--}}

{{--<!-- Chartisan -->--}}

{{--<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>--}}

@hasSection('js')

    @yield('js')

@endif



</body>

</html>

