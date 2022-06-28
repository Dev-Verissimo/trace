@extends('admin.master.master')
@section('title')
    Excluir Arquivo
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.arquivo.index', $arquivo->id)}}">Arquivos</a></li>
        <li class="active"><a href="{{route('admin.arquivo.show', $arquivo->id)}}">Excluir Arquivo</a></li>
    </ol>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Excluir Arquivo </h4>
                </div>
                <form action="{{route('admin.arquivo.destroy', $arquivo->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" name="nome" id="nome" value="{{$arquivo->nome}}" required placeholder="Nome"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição*</label>
                            <textarea name="descricao" id="descricao" rows="5" class="form-control">
                                {{$arquivo->descricao}}
                            </textarea>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-danger btn-quirk btn-wide mr5">Excluir</button>
                        <a href="{{route('admin.fabricante.index')}}"
                           class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->

    </div>

@endsection
