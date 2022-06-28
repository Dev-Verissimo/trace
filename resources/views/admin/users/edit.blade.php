@extends('admin.master.master')
@section('title')
    Editar Usuário
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.usuarios.index')}}">Usuários</a></li>
        <li class="active"><a href="{{route('admin.usuarios.edit', $user->id)}}">Editar usuário</a></li>
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
                <form action="{{route('admin.usuarios.update', $user->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="panel-heading">
                        <h4 class="panel-title">Informe os dados do usuário</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" name="name" id="nome" value="{{old('name') ?? $user->name}}" required placeholder="Nome" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email"  value="{{old('email') ?? $user->email}}" required placeholder="E-mail"
                                   class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label for="imagem">Imagem</label>
                            <input type="file" name="imagemup" id="imagem" placeholder="Imagem" value="{{old('imagemup') ?? $user->imagem}}"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone*</label>
                            <input type="text" name="telefone" value="{{old('telefone') ?? $user->telefone}}" id="telefone" required placeholder="Telefone"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <input type="text" name="endereco" value="{{old('endereco') ?? $user->endereco}}" id="endereco" placeholder="Endereço"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="profissao">Profissão</label>
                            <input type="text" name="profissao" value="{{old('profissao') ?? $user->profissao}}" id="profissao" placeholder="Profissão"
                                   class="form-control"/>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-quirk btn-wide mr5">Salvar</button>
                        <a href="{{route('admin.usuarios.index')}}"
                           class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->

    </div>

@endsection
