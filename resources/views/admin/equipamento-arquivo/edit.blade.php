@extends('admin.master.master')
@section('title')
    Editar arquivo
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li>
            <a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a>
        </li>
        <li class="">
            <a href="{{route('admin.equipamento.index')}}">Equipamentos</a>
        </li>
        <li class=""><a href="{{route('admin.arquivo.index', $arquivo->equipamento_id)}}">Arquivos do Equipamento</a></li>
        <li class="active"><a href="{{route('admin.arquivo.create', $arquivo->equipamento_id)}}">Adicionar Arquivo</a></li>
    </ol>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <form action="{{route('admin.arquivo.update', $arquivo->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="panel-heading">
                        <h4 class="panel-title">Editar Arquivo </h4>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" name="equipamento_id" value="{{$arquivo->equipamento_id}}">
                        <div class="form-group">
                            <label for="path_arquivo">Arquivo</label>
                            <input type="file" name="path_arquivo" id="path_arquivo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" name="nome" id="nome" value="{{$arquivo->nome}}" required placeholder="Nome"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" id="descricao" class="form-control" rows="5">{{$arquivo->descricao}}</textarea>
                        </div>

                    </div>

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-quirk btn-wide mr5">Atualizar</button>
                        <a href="{{route('admin.arquivo.index', $arquivo->equipamento_id)}}"
                           class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->
    </div>

@endsection
