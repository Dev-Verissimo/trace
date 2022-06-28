@extends('admin.master.master')

@section('title')

    Inspeções

@endsection

@section('content')



    <ol class="breadcrumb breadcrumb-quirk">

        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home </a></li>

        <li>

            <a href="{{route('admin.equipamento.index')}}"><i class="fa fa-cubes mr5"></i>

                Equipamentos

            </a>

        </li>

        <li>

            <a href="{{route('admin.unidade.index', $unidade->equipamento_id )}}">

                <i class="fa fa-cubes mr5"></i>

                Unidade

            </a>

        </li>

        <li>

            <i class="glyphicon glyphicon-indent-left mr5"></i>Inspeções

        </li>



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



    <div id="appvue">

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="panel">

                    <ul class="panel-options">

                        <li>

                            <button class="btn btn-default btn-quirk" onclick="window.history.go(-1); return false;"

                                    title="Voltar">

                                <i class="fa fa-reply"></i>

                            </button>

                        </li>

                        <li>

                            <button class="btn btn-success btn-quirk " title="Inspeção"

                                    @@click="toggleBtn = !toggleBtn">

                                <i class="fa " :class="toggleBtn == 0 ? 'fa-plus' : 'fa-minus' "></i>



                            </button>

                        </li>

                    </ul>

                    <div class="panel-heading">

                        <div class="media">

                            <div class="media-left">

                                <a href="{{route('admin.unidade.index', $unidade->equipamento_id )}}">

                                    <img alt="" width="80px" class="media-object img-circle"

                                         src="{{url( $unidade->equipamento->imagem != '' ? 'uploads/' . $unidade->equipamento->imagem : 'uploads/png.png' )}}">



                                </a>

                            </div>

                            <div class="media-body">



                                <h2 class="media-heading hidden-xs hidden-sm ">{{$unidade->equipamento->nome}}</h2>

                                <div class="hidden-lg hidden-md">

                                    <br>

                                    <br>

                                    <h4 class="media-usermeta">

                                        {{ $unidade->equipamento->nome}}

                                    </h4>

                                </div>

                                <p class="media-usermeta">

                                    <i class="glyphicon glyphicon-tag"></i> <span

                                        class="label label-info ng-binding">{{$unidade->tag}}</span>

                                </p>

                                <p class="media-usermeta">

                                    <i class="glyphicon glyphicon-map-marker"></i> <span

                                        class="label label-default ng-binding">{{$unidade->local->nome}}</span>

                                </p>

                            </div>

                        </div>

                    </div>





                    <div class="panel-body" v-if="toggleBtn">



                        <form action="{{route('admin.inspecao.store', $unidade->id)}}" method="post"

                              id="basicForm2"

                              class="form-horizontal" enctype="multipart/form-data">

                            @csrf

                            <hr>

                            <div class="error"></div>



                            <div class="form-group">



                                <label for="usuario" class="col-sm-3 control-label">

                                    Inspetor

                                    <span class="text-danger">*</span>

                                </label>

                                <div class="col-sm-8">

                                    <select id="usuario" name="user_id" class="form-control" style="width: 100%"

                                            required>

                                        <option disabled selected>Selecione uma opção</option>

                                        @foreach($users as $user)

                                            <option value="{{$user->id}}"> {{$user->name}}</option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>



                            <div class="form-group">

                                <label for="local" class="col-sm-3 control-label"> Local

                                    <span class="text-danger">*</span>

                                </label>

                                <div class="col-sm-8">

                                    <select id="local" name="local_id" class="form-control" required

                                            style="width: 100%">

                                        <option disabled selected>Selecione uma opção</option>

                                        @foreach($locais as $local)

                                            <option value="{{$local->id}}"> {{$local->nome}}</option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>





                            <div class="form-group">

                                <label for="dataInspecao" class="col-sm-3 control-label">

                                    Data da Inspeção

                                    <span class="text-danger">*</span>

                                </label>

                                <div class="col-sm-8">

                                    <input

                                        type="date" name="data_inspecao"

                                        required

                                        class="form-control hasDatepicker"

                                        value="{{date("Y-m-d")}}"

                                        id="dataInspecao" max="{{date("Y-m-d")}}">

                                </div>

                            </div>





                            <div class="form-group">

                                <label class="col-sm-3 control-label">

                                    Status <span class="text-danger">*</span>

                                </label>

                                <div class="col-sm-8">



                                    <label class="rdiobox">

                                        <input id="platform" type="radio" name="status" value="1"

                                               @@click="esconderMensagem()"

                                               checked

                                               required="" aria-required="true">

                                        <span class="text-success ng-binding"> Aprovado </span>

                                    </label>



                                    <label class="rdiobox">

                                        <input type="radio" name="status" value="2"

                                               @@click="mostrarMensagem()">

                                        <span class="text-danger ng-binding"> Reprovado </span>

                                    </label>



                                    <label class="rdiobox">

                                        <input type="radio" name="status" value="3"

                                               @@click="mostrarMensagem()">

                                        <span class="text-default ng-binding"> Retirados de uso </span>

                                    </label>



                                </div>

                            </div>



                            <div class="form-group" v-if="menssagem">

                                <label for="observacoes" class="col-sm-3 control-label ng-binding"> Observações <span

                                        class="text-danger">*</span> </label>

                                <div class="col-sm-8">

                                <textarea name="observacao"

                                          required

                                          id="observacoes" rows="5"

                                          class="form-control"

                                          placeholder="Observações"></textarea>

                                </div>

                            </div>





                            <div class="form-group">

                                <label class="col-sm-3 control-label">Foto</label>

                                <div class="col-sm-8">

                                    <input type="file" class="form-control" name="imagem" id="foto"

                                           accept=".jpg, .jpeg, .png, .gif">

                                </div>

                            </div>



                            <div class="row">

                                <div class="col-sm-9 col-sm-offset-3">

                                    <button type="submit" class="btn btn-wide btn-primary btn-quirk mr5 ">

                                        Salvar

                                    </button>

                                    <button type="reset" class="btn btn-wide btn-default btn-quirk ng-binding"

                                            onclick="window.history.go(-1); return false;">

                                        Voltar

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>



                </div>

            </div>

        </div>



        @if(count($unidade->inspecao) > 0)

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="timeline-wrapper">

                        <div class="timeline-date">Histórico</div>



                        @foreach($unidade->inspecao as $ip)

                            <div class="panel panel-post-item status">

                                <div class="panel-heading">



                                    <div class="media">

                                        <div class="media-body">

                                            <p class="media-usermeta">

                                            <span

                                                class="media-time">{{date('d/m/Y', strtotime($ip->data_inspecao))}}</span>

                                                <i class="glyphicon glyphicon-wrench"></i>

                                                <a href="#">

                                          <span class="label label-info">

                                            Inspeção

                                          </span>

                                                </a>

                                            </p>

                                            <p class="media-usermeta">

                                                <i class="glyphicon glyphicon-map-marker"></i>

                                                <a href="">

                                            <span class="label label-default ng-binding">

                                                {{$ip->unidade->local->nome}}

                                            </span>

                                                </a>

                                            </p>

                                            <p class="media-usermeta">

                                                <i class="glyphicon glyphicon-user"></i>

                                                <a href="">

                                            <span class="label label-success">

                                               {{ $ip->user->name }}

                                            </span>

                                                </a>

                                            </p>

                                        </div>

                                    </div><!-- media -->





                                    <ul class="panel-options">

                                        <li>

                                            <span class="label label-{{$ip->status == '1' ? 'success' : 'danger' }} ">

                                               {{$ip->status_inspecao}}

                                            </span>

                                        </li>

                                        <li>

                                            <button

                                                class="btn {{$ip->status == '1' ? 'btn-success' : 'btn-danger' }}   btn-stroke btn-icon">

                                                <i class="fa {{$ip->status == '1' ? 'fa-check' : 'fa-close' }} "></i>

                                            </button>

                                        </li>

                                    </ul>

                                </div>





                                <div class="panel-body ">

                                    <div class="media">

                                        <div class="media-body">

                                            @if($ip->imagem != '')



                                                <div class="mb10 d-block c-pointer" @@click="mostrarFoto($event)">

                                                    <span class="glyphicon  glyphicon-fullscreen"></span>

                                                    Visualizar



                                                    <div class="media">

                                                        <img class="img-responsive"

                                                             src="{{url('uploads/'.  $ip->imagem )}}"

                                                             style="width: 80px">

                                                    </div>

                                                </div>

                                            @endif

                                            <p class=""> {{$ip->observacao}}</p>

                                        </div>

                                    </div>

                                </div>



                            </div><!-- panel panel-post -->

                        @endforeach



                    </div>

                </div>

            </div>

        @endif

    </div>

@endsection



@section('js')

    <script>



        var appVue = new Vue({

            el: '#appvue',

            data: {

                toggleBtn: 0,

                menssagem: 0,

            },

            methods: {

                mostrarMensagem() {

                    this.menssagem = 1;

                },

                esconderMensagem() {

                    this.menssagem = 0;

                },

                mostrarFoto(e) {

                    console.log(e)

                    e.target.querySelector('img').style.width = '100%'

                }

            }

        });



    </script>



@endsection

