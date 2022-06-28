@extends('admin.master.master')
@section('title')
    Resultado da pesquisa
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li>
            <a href="{{route('admin.home')}}">
                <i class="fa fa-home mr5"></i> Home
            </a>
        </li>
        <li class="active">
            <a href="{{route('admin.categoria.index')}}">
                <i class="fa fa-search mr5"></i>Resultados da Pesquisa
            </a>
        </li>
    </ol>

    <div class="panel panel-primary">
        <div class="panel-heading">
            Resultados da Pesquisa: {{isset($pesquisa) ? $pesquisa : ''}}
        </div>
        @if(count($equipamentos) == 0  && count($unidades) == 0)
            <div class="painel-body mt20 padding10">
                <p class="text-center">
                    <i class="fa fa-search-minus" style="font-size: 60px"></i>
                </p>
                <p class="text-center" style="font-size: 22px">Sem resultados para: <strong>{{isset($pesquisa) ? $pesquisa : ''}}</strong></p>
            </div>
        @endif
    </div>
    @if(count($equipamentos) > 0)
        @foreach($equipamentos as $eq)
            <div class="panel panel-profile list-view mb10">
                <div class="panel-heading">
                    <div class="media">
                        <a href="{{route('admin.unidade.index', $eq->id)}}">
                            <div class="media-left">

                                <img class="media-object img-circle"
                                     src="{{ $eq->imagem != null ? '../' . $eq->url_img : '../../uploads/equipamentos/equipamento_sem_foto.png'}}"
                                     alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{$eq->nome}}</h4>
                                <p class="media-usermeta">
                                    <i class="fa fa-sitemap"></i>Categoria: {{$eq->categoria->nome}}
                                </p>
                            </div>
                        </a>
                    </div><!-- media -->
                </div><!-- panel-heading -->

                <div class="panel-body people-info">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h4 style="color: #000">Unidades: ({{count($eq->unidade)}})</h4>
                        </div>
                    </div>
                    @foreach($eq->unidade as $uni)
                        <a href="{{route('admin.inspecao.index', $uni->id)}}">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mb15">
                                    <div class="info-group">
                                        <p class="media-usermeta">
                                    <span class="media-time d-flex">
                                        <i class="glyphicon glyphicon-tag mr5" style="color: #aeb6c6"></i>
                                        <span class="label label-info ">{{$uni->tag}}</span>
                                    </span>
                                        </p>
                                        <p class="media-usermeta">
                                            <span class="media-time d-flex">
                                                <i class="glyphicon glyphicon-map-marker" style="color: #aeb6c6"></i>
                                                <span class="label label-default">
                                                     {{$uni->local->nome}}
                                                </span>
                                             </span>
                                        </p>
                                        <br>
                                        Status: {{$uni->status_string}}
                                    </div>
                                </div>
                            </div><!-- row -->
                        </a>
                    @endforeach

                </div>
            </div>
        @endforeach
    @endif
    @if(count($unidades) > 0)
        @foreach($unidades as $un)
            <div class="panel panel-profile list-view mb10">
                <div class="panel-heading">
                    <div class="media">  
                        <a href="{{route('admin.inspecao.index', $un->id)}}" class="btn btn-success btn-quirk text-white" title="Inspeções">
                            <i class="glyphicon glyphicon-indent-left"></i> 
                        </a>
                        <a href="{{route('admin.unidade.index', $un->equipamento->id)}}">
                            <div class="media-left">

                                <img class="media-object img-circle"
                                     src="{{ $un->equipamento->imagem != null ? '../' . $un->equipamento->url_img : '../../uploads/unuipamentos/unuipamento_sem_foto.png'}}"
                                     alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{$un->equipamento->nome}}</h4>
                                <p class="media-usermeta">
                                    <i class="fa fa-sitemap"></i>Categoria: {{$un->equipamento->categoria->nome}}
                                </p>
                            </div>
                        </a>
                    </div><!-- media -->
                </div><!-- panel-heading -->

                <div class="panel-body people-info">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h4 style="color: #000">Unidade</h4>
                        </div>
                    </div>

                    <a href="{{route('admin.inspecao.index', $un->id)}}">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb15">
                                <div class="info-group">
                                    <p class="media-usermeta">
                                    <span class="media-time d-flex">
                                        <i class="glyphicon glyphicon-tag mr5" style="color: #aeb6c6"></i>
                                        <span class="label label-info ">{{$un->tag}}</span>
                                    </span>
                                    </p>
                                    <p class="media-usermeta">
                                    <span class="media-time d-flex">
                                    <i class="glyphicon glyphicon-map-marker" style="color: #aeb6c6"></i>
                                        <span class="label label-default">
                                             {{$un->local->nome}}
                                        </span>
                                     </span>
                                    </p>
                                    <br>
                                    Status: {{$un->status_string}}
                                </div>
                            </div>
                        </div><!-- row -->
                    </a>


                </div>
            </div>
        @endforeach
    @endif

@endsection
