@extends('admin.master.master')
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class=""><a href="{{route('admin.usuarios.index')}}">Usuários</a></li>
        <li class="active"><a href="{{route('admin.usuarios.create')}}">Cadastrar usuário</a></li>
    </ol>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <form action="{{route('admin.usuarios.store')}}" method="post"  enctype="multipart/form-data">
                    @csrf

                    <div class="panel-heading">
                        <h4 class="panel-title">Informe os dados do usuário</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nome">Nome*</label>
                            <input type="text" name="name" id="nome" required placeholder="Nome" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" required placeholder="E-mail"
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" required placeholder="Senha"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="imagem">Imagem</label>
                            <input type="file" name="imagemup" id="imagem"  placeholder="Imagem"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone*</label>
                            <input type="text" name="telefone" id="telefone" required placeholder="Telefone"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <input type="text" name="endereco" id="endereco" placeholder="Endereço"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="profissao">Profissão</label>
                            <input type="text" name="profissao" id="profissao" placeholder="Profissão"
                                   class="form-control"/>
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
