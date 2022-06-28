@extends('admin.master.master')
@section('title')
    Adicionar Equipamento
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.equipamento.index')}}">Equipamentos</a></li>
        <li class="active"><a href="{{route('admin.equipamento.create')}}">Cadastrar Equipamento</a></li>
    </ol>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <form action="{{route('admin.equipamento.store')}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="panel-heading">
                        <h4 class="panel-title">Adicionar Equipamento </h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" name="nome" id="nome" value="{{old('nome')}}" required placeholder="Nome" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <input type="text" name="modelo" id="modelo" value="{{old('modelo')}}"  placeholder="Modelo" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="fornecedor">Fornecedor</label>
                            <input type="text" name="fornecedor" id="fornecedor" value="{{old('fornecedor')}}"  placeholder="Fornecedor" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="categoria_idphp">Categoria</label>
                            <select name="categoria_id" id="categoria_id" class="form-control">
                                <option selected disabled>Selecione uma categoria</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fabricante_id">Fabricante</label>
                            <select name="fabricante_id" id="fabricante_id" class="form-control">
                                <option selected disabled>Selecione um fornecedor</option>
                                @foreach($fabricantes as $fabricante)
                                    <option value="{{$fabricante->id}}">{{$fabricante->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" id="descricao" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="imagem">Foto</label>
                            <input type="file" name="imagem" id="imagem" class="form-control">
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-quirk btn-wide mr5">Salvar</button>
                        <a href="{{route('admin.usuarios.index')}}" class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->
    </div>

@endsection
