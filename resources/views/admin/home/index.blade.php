@extends('admin.master.master')



@section('content')

<div class="container">
    <div class="panel panel-site-traffic">



        <div class="panel-body">

            <div class="row">



                <div class="col-xs-6 col-sm-4">

                    <a href="{{route('admin.equipamento.index')}}">

                        <div class="pull-left">

                            <div class="cubo-dash" style="  background: #505b72;">

                                <i class="fa fa-cubes"></i>

                            </div>



                        </div>

                        <div class="pull-left">

                            <h4 class="panel-title">

                                Equipamentos

                            </h4>

                            <h3>{{$equipamentos}}</h3>

                        </div>

                    </a>

                </div>

                <div class="col-xs-6 col-sm-4">

                    <div class="pull-left">

                        <div class="cubo-dash" style="  background: #5bc0de;">

                            <i class="fa fa-cog"></i>

                        </div>

                    </div>

                    <div class="pull-left">

                        <h4 class="panel-title">Unidades</h4>

                        <h3>{{count($unidades)}}</h3>



                    </div>

                </div>

                <div class="col-xs-6 col-sm-4">

                    <div class="pull-left">

                        <div class="icon icon ion-clock"></div>

                    </div>

                    <h4 class="panel-title">Horário</h4>

                    <h3>{{date("H:i")}}</h3>

                </div>

            </div><!-- row -->

        </div><!-- panel-body -->

    </div><!-- panel -->



    <div class="panel">

        <div class="panel-heading">

            <h4 class="panel-title text-success">

                Inspeções

            </h4>

        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div id="myfirstchart" style="height: 250px;"></div>



                </div>

            </div>

        </div>

    </div>
</div>
    


<div class="col-md-3 col-lg-4 dash-right">

    @include('admin.includes.painel-direito')

</div>






@endsection



@section('js')

    <script>

        new Morris.Bar({

            // ID of the element in which to draw the chart.

            element: 'myfirstchart',

            // Chart data records -- each entry in this array corresponds to a point on

            // the chart.

            data: [

                {ano: '2017', valor: 20},

                {ano: '2018', valor: 10},

                {ano: '2019', valor: 5},

                {ano: '2020', valor: 5},

                {ano: '2021', valor: 20}

            ],

            // The name of the data record attribute that contains x-values.

            xkey: 'ano',

            // A list of names of data record attributes that contain y-values.

            ykeys: ['valor'],

            // Labels for the ykeys -- will be displayed when you hover over the

            // chart.

            labels: ['Quantidade']

        });



    </script>

@endsection

<style>
    .col-md-9.col-lg-8.dash-left{
        display: flex;
        width: 100%;
    }
    .col-md-9.col-lg-8.dash-left > div.container{
        width: 75%;
    }
</style>