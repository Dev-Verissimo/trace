@extends('admin.master.master')
@section('title')
    Excluir Local
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.local.index')}}">Locais</a></li>
        <li class="active"><a href="{{route('admin.local.show', $local->id)}}">Excluir Local</a></li>
    </ol>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h4 class="panel-title">Excluir Local </h4>
                </div>
                <form action="{{route('admin.local.destroy', $local->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" name="nome" id="nome" value="{{$local->nome}}" required placeholder="Nome"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço*</label>
                            <input type="text" name="endereco" id="endereco" value="{{$local->endereco}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" id="descricao" rows="5" class="form-control">{{$local->descricao}}</textarea>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-danger btn-quirk btn-wide mr5">Excluir</button>
                        <a href="{{route('admin.local.index')}}"
                           class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->

    </div>

@endsection
