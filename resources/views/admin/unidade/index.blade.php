@extends('admin.master.master')
@section('title')
    Unidades
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class="">
            <a href="{{route('admin.equipamento.index')}}">
                <i class="fa fa-cubes mr5"></i>Equipamentos
            </a>
        </li>
        <li class="active"><a href="{{route('admin.unidade.index', $equipamento->id)}}">Unidade</a></li>
    </ol>


    @if($errors->all())
        @foreach($errors->all() as $error)
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{$error}}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @if(session()->exists('mensagem'))
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="alert alert-{{session()->get('tipo')}}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{session()->get('mensagem')}}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-xs-12 col-md-4 col-lg-4 profile-left mb20">
            <div class="profile-left-heading">

                <a href="#" class="profile-photo">
                    <img class="img-circle img-responsive"
                         src="{{ $equipamento->imagem != '' ? url('uploads/' . $equipamento->imagem) : url(asset('backend/assets/images/equipamento_sem_foto.png')) }}"
                         alt="{{$equipamento->nome}}"></a>
                <h2 class="profile-name">{{$equipamento->nome}}</h2>

                <a href="{{route('admin.unidade.create', $equipamento->id)}}"
                   class="btn btn-danger btn-quirk btn-block profile-btn-follow">
                    Adicionar Unidade
                </a>

                <ul class="list-group">
                    @foreach($equipamento->arquivo as $arquivo)
                        <li class="list-group-item">{{$arquivo->nome}}
                            <a href="{{url('uploads/' . $arquivo->path_arquivo)}}" target="_blank">
                                <span class="label label-success">Download</span>
                            </a>
                    @endforeach
                </ul>
            </div>
            <div class="profile-left-body">
                <h4 class="panel-title">Fabricante</h4>
                <p><i class="fa fa-gears mr5"></i> {{$equipamento->fabricante->first()->nome}}</p>


                <hr class="fadeout">

                <h4 class="panel-title">Fornecedor</h4>
                <p><i class="glyphicon glyphicon-briefcase mr5"></i> {{$equipamento->fornecedor}}</p>

                <hr class="fadeout">

                <h4 class="panel-title">Categoria</h4>
                <p><i class="glyphicon glyphicon-phone mr5"></i> {{$equipamento->categoria->first()->nome}}</p>

                <hr class="fadeout">

                <h4 class="panel-title">Descrição</h4>
                <p><i class="glyphicon glyphicon-phone mr5"></i> {{$equipamento->descricao}}</p>
            </div>
        </div>
        <div class="col-xs-12 col-md-8 col-lg-8">


            {{--            <div class="profile-right-body mb-3">--}}
            {{--                <div class="panel panel-default-full">--}}
            {{--                    <div class="panel-body">--}}
            {{--                        <div class="input-group">--}}
            {{--                            <input type="text" class="form-control  " placeholder="Filtrar">--}}
            {{--                            <span class="input-group-btn">--}}
            {{--                                <button class="btn btn-default btn-quirk" type="button">--}}
            {{--                                    <i class="glyphicon glyphicon-filter"></i></button>--}}
            {{--                            </span>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            @foreach($unidades as $unidade)
                <div class="panel panel-post-item">
                    <ul class="panel-options">
                        <li>
                            <a href="{{route('admin.inspecao.index', $unidade->id)}}"
                               class="btn btn-success btn-quirk text-white" title="Inspeções">
                                <i class="glyphicon glyphicon-indent-left"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.unidade.edit', $unidade->id)}}"
                               class="btn btn-info btn-quirk text-white" title="Editar">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.unidade.show', $unidade->id)}}"
                               class="btn btn-danger btn-quirk text-white" title="Excluir">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="panel-heading">
                        <div class="media">
                            <div class="media-left">
                                <img alt=""
                                     src="{{ $equipamento->imagem != '' ? url('uploads/' . $equipamento->imagem) : url(asset('backend/assets/images/equipamento_sem_foto.png')) }}"
                                     class="media-object img-circle">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading hidden-xs hidden-sm ng-binding">
                                    {{$equipamento->nome}}
                                </h4>
                                <div class="hidden-lg hidden-md">
                                    <br>
                                    <br>
                                    <h4 class="media-usermeta ng-binding">
                                        {{$equipamento->nome}}
                                    </h4>
                                </div>

                                <p class="media-usermeta">
                            <span class="media-time"><i class="glyphicon glyphicon-tag mr5"></i><span
                                    class="label label-info ">{{$unidade->tag}}</span></span>
                                </p>
                                <p class="media-usermeta">
                            <span class="media-time">
                                <i class="glyphicon glyphicon-map-marker mr5"></i>
                                <span class="label label-default ">
                                     {{$unidade->local->nome}}
                                </span>
                            </span>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        @if(date('Y-m-d', strtotime($unidade->data_proxima_inspecao)) >= date('Y-m-d'))
                            <ul class="list-inline">
                                <li class=" ">
                                    Próxima Inspeção em

                                    <strong>
                                        {{$unidade->dias_diff}}
                                    </strong>
                                    dias
                                </li>
                                <li class="pull-right">
                                    {{ $porcent = number_format(($unidade->dias_diff * 100) / $unidade->total_dias_diff), 2, '.', '' }}
                                    %
                                </li>
                            </ul>
                            <div class="progress">
                                <div
                                    class="progress-bar  progress-bar-{{$unidade->dias_diff >= intval($unidade->total_dias_diff / 2)  ? 'info' : 'danger'}} "
                                    role="progressbar" aria-valuenow="{{$porcent}}"
                                    aria-valuemin="0" aria-valuemax="100" style="width:{{$porcent}}%">

                                </div>
                            </div>
                        @else
                            A inspeção está atrasada desde o dia {{date('d/m/Y', strtotime($unidade->data_proxima_inspecao))}}
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
