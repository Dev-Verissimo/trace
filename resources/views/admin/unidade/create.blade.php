@extends('admin.master.master')
@section('title')
    Adicionar Unidade
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.equipamento.index')}}">Equipamentos</a></li>
        <li class=""><a href="{{route('admin.unidade.index', $id)}}">Unidades</a></li>
        <li class="active"><a href="{{route('admin.unidade.create', $id)}}">Adicionar Unidade</a></li>
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
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <form action="{{route('admin.unidade.store')}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="panel-heading">
                        <h4 class="panel-title">Adicionar Unidade </h4>
                    </div>
                    <input type="hidden" name="equipamento_id" value="{{$id}}">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="tag">Tag*</label>
                            <input type="text" name="tag" id="tag" value="{{old('tag')}}" required placeholder="Tag" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="local_id">Local</label>
                            <select name="local_id" id="local_id"  required class="form-control">
                                <option selected disabled>Selecione um Local</option>
                                @foreach($locais as $local)
                                    <option value="{{$local->id}}">{{$local->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lote">Lote</label>
                            <input type="text" name="lote" id="lote" value="{{old('lote')}}"  placeholder="Lote" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="referencia">Referência</label>
                            <input type="text" name="referencia" id="referencia" value="{{old('referencia')}}"  placeholder="Referência" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="numeronf">Nota fiscal</label>
                            <input type="text" name="numeronf" id="numeronf" value="{{old('numeronf')}}"  placeholder="Nota fiscal" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="text" name="valor" id="valor" value="{{old('valor')}}"  placeholder="Valor" class="form-control mask-money"/>
                        </div>
                        <div class="form-group">
                            <label for="data_fabricacao">Data de Fabricação *</label>
                            <input type="date" name="data_fabricacao" id="data_fabricacao" value="{{old('data_fabricacao')}}"  placeholder="Data de Fabricação" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="data_compra">Data da Compra *</label>
                            <input type="date" name="data_compra" id="data_compra" value="{{old('data_compra')}}"  placeholder="Data Compra" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="data_validade">Data de Validade *</label>
                            <input type="date" name="data_validade" id="data_validade" value="{{old('data_validade')}}"  placeholder="Data de Validade" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="data_primeiro_uso">Data do Primeiro Uso *</label>
                            <input type="date" name="data_primeiro_uso" id="data_primeiro_uso" value="{{old('data_primeiro_uso')}}"  placeholder="Data do primeiro uso" class="form-control"/>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-quirk btn-wide mr5">Salvar</button>
                        <a href="{{route('admin.unidade.index', $id)}}" class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->
    </div>

@endsection
