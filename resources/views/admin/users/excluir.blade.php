@extends('admin.master.master')
@section('title')
    Excluir Usuário
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.usuarios.index')}}">Usuários</a></li>
        <li class="active"><a href="{{route('admin.usuarios.show', $user->id)}}">Excluir usuário</a></li>
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
            <div class="panel panel-danger">
                <div class="panel-heading ">
                    <h4 class="panel-title">Tem certeza que deseja excluir o usuário? </h4>
                </div>
                <form action="{{route('admin.usuarios.destroy', $user->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text"  id="nome" disabled value="{{$user->name}}" required placeholder="Nome" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email"  id="email"  disabled value="{{old('email') ?? $user->email}}" required placeholder="E-mail"
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone*</label>
                            <input type="text"    disabled value="{{old('telefone') ?? $user->telefone}}" id="telefone" required placeholder="Telefone"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <input type="text"   disabled value="{{old('endereco') ?? $user->endereco}}" id="endereco" placeholder="Endereço"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="profissao">Profissão</label>
                            <input type="text"   disabled value="{{old('profissao') ?? $user->profissao}}" id="profissao" placeholder="Profissão"
                                   class="form-control"/>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-danger btn-quirk btn-wide mr5">Excluir</button>
                        <a href="{{route('admin.usuarios.index')}}"
                           class="btn btn-quirk btn-wide btn-default">Voltar</a>
                    </div>
                </form>
            </div><!-- panel -->


        </div><!-- col-sm-6 -->

    </div>

@endsection
