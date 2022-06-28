@extends('admin.master.master')
@section('title')
    Excluir Unidade
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.equipamento.index')}}">Equipamentos</a></li>
        <li class=""><a href="{{route('admin.unidade.index', $unidade->equipamento_id)}}">Unidades</a></li>
        <li class="active"><a href="{{route('admin.unidade.show', $unidade->id)}}">Excluir Unidade</a></li>
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
            <div class="panel panel-danger ">
                <div class="panel-heading">
                    <h4 class="panel-title">Excluir Unidade </h4>
                </div>
                <form action="{{route('admin.unidade.destroy', $unidade->id)}}" method="post"  >
                    @csrf
                    @method('DELETE')
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="tag">Tag*</label>
                            <input type="text" name="tag" id="tag" value="{{$unidade->tag}}" readonly class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="local_id">Local</label>
                            <input type="text" name="tag" id="tag" value="{{$unidade->local->first()->nome}}" readonly class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="lote">Lote</label>
                            <input type="text" name="lote" id="lote" value="{{$unidade->lote}}" readonly class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="referencia">Referência</label>
                            <input type="text" name="referencia" id="referencia" value="{{$unidade->referencia}}" readonly class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="numeronf">Nota fiscal</label>
                            <input type="text" name="numeronf" id="numeronf" value="{{ $unidade->numeronf }}"  readonly class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="text" name="valor" id="valor" value="{{$unidade->valor}}"  readonly class="form-control mask-money"/>
                        </div>
                        <div class="form-group">
                            <label for="data_fabricacao">Data Fabricação *</label>
                            <input type="date" name="data_fabricacao" id="data_fabricacao" value="{{date('Y-m-d', strtotime($unidade->data_fabricacao))}}" readonly  class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="data_compra">Data da Compra *</label>
                            <input type="date" name="data_compra" id="data_compra" value="{{date('Y-m-d', strtotime($unidade->data_compra))}}" readonly  class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="data_validade">Data de validade *</label>
                            <input type="date" name="data_validade" id="data_validade" value="{{date('Y-m-d', strtotime($unidade->data_validade))}}" readonly class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="data_primeiro_uso">Data do primeiro uso *</label>
                            <input type="date" name="data_primeiro_uso" id="data_primeiro_uso" value="{{date('Y-m-d', strtotime($unidade->data_primeiro_uso))}}" readonly class="form-control"/>
                        </div>
                    </div>

                    <div class="panel-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-danger btn-quirk btn-wide mr5">Excluir</button>
                        <a href="{{route('admin.unidade.index', $unidade->equipamento_id)}}" class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->
    </div>

@endsection
