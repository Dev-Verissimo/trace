@extends('admin.master.master')
@section('title')
    Solicitações
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home mr5"></i> Home</a></li>
        <li class="active">
            <a href="{{route('admin.solicitacao.index')}}">
                <i class="fa fa-cubes mr5"></i> Solicitações
            </a>
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

    <div class="row" id="app">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">1. SELECIONE A ORIGEM</h4>
                    <p></p>
                    <small>
                        Escolha o local de origem dos equipamentos
                    </small>
                    <select id="select1" class="select2 form-control" style="width: 100%" name="local_id"
                            @@change="changeLocalId($event)">
                        <option value="" selected>Todos</option>
                        @verbatim
                            <option v-for="item in localOrigem" :key='item.id' :value="item.id"> {{item.nome}}</option>
                        @endverbatim
                    </select>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-primary nomargin">
                            <thead class="success">
                            <tr>
                                <th class="text-center">

                                </th>
                                <th>
                                    foto
                                </th>
                                <th>
                                    Nome
                                </th>
                            </tr>
                            </thead>
                            <tbody id="lista-equipamentos">
                            @verbatim
                                <tr v-for="(item, i) in equipamentos" :key="item.equipamento.id">
                                    <td class="text-center">
                                        <label class="ckbox ckbox-primary">
                                            <input type="checkbox" @change="addEquipamento($event,i, item.equipamento)">
                                            <span>

                                            </span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.unidade.index', item.id )}}">
                                            <img alt=""
                                                 :src="item.equipamento.imagem != '' ? 'http://127.0.0.1:8000/uploads/' + item.equipamento.imagem : 'http://127.0.0.1:8000/uploads/backend/assets/images/equipamento_sem_foto.png'"
                                                 width="40px" class="media-object img-circle">
                                        </a>
                                    </td>
                                    <td class="">{{item.equipamento.nome}}</td>
                                </tr>
                            @endverbatim
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>


        <div class="col-md-6">
            <form action="{{route('admin.solicitacao.store')}}" method="post">
                @csrf
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">2. Selecione o destino</h4>
                        <p></p>
                        <small>
                            Escolha o local para o envio dos equipamentos
                        </small>
                        @verbatim
                            <select v-model="destinos"
                                    id="select1"
                                    name="local_id"
                                    required class="select2 form-control"
                                    style="width: 100%">
                                <option value="0" selected>Todos</option>

                                <option v-for="item in localDestino" :key='item.id'
                                        :value="item.id"> {{item.nome}}</option>


                            </select>

                        @endverbatim
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <!-- DATA PROXIMA INSPECAO -->
                            <div class="col-md-12">
                                <div class="panel panel-info list-announcement">

                                    <div class="panel-heading">
                                        <h4 class="panel-title">quantidade por item </h4>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-unstyled mb20">
                                            @verbatim
                                                <li v-for="(item, i) in destino" :key="item.id">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-sm-2 col-md-2">
                                                            <img alt=""
                                                                 :src="item.imagem != '' ? 'http://127.0.0.1:8000/uploads/' + item.imagem : 'http://127.0.0.1:8000/uploads/backend/assets/images/equipamento_sem_foto.png'"
                                                                 width="40px" class="media-object img-circle">
                                                        </div>
                                                        <div class="col-lg-7 col-sm-7 col-md-7">
                                                            <small>
                                                                Nome
                                                            </small>
                                                            {{item.nome}}
                                                        </div>

                                                        <input type="hidden" :name="'eq-id-' + item.id"
                                                               :value="item.id">

                                                        <div class="col-lg-2 col-sm-2 col-md-2">
                                                            <small class="ng-binding">
                                                                Qtd: {{ item.unidade.length }}
                                                                <input type="number" :name="'eq-qtd-' + item.id"
                                                                       required
                                                                       class="input-sm form-control ">
                                                            </small>
                                                        </div>

                                                        <div class="col-lg-1 col-sm-1 col-md-1">
                                                            <small>
                                                                .
                                                            </small>

                                                            <span class="label label-danger ng-binding"
                                                                  @click="removeItem(i, item)">
                                                                  <i class="fa fa-close"></i>
                                                            </span>


                                                        </div>
                                                    </div>
                                                </li>
                                            @endverbatim
                                        </ul>
                                    </div>
                                    <div class="panel-footer" v-if="destino.length > 0">

                                        <button type="submit" v-if="destinos > 0"
                                                class="btn btn-success btn-quirk btn-stroke btn-block ng-scope">
                                            CONFIRMAR
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- DATA PROXIMA INSPECAO -->


                        </div>
                    </div>
                </div><!-- panel -->
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var equipamentos;
        var app = new Vue({
            el: '#app',
            data: {
                equipamentos: [],
                destino: [],
                localOrigem: [],
                localDestino: [],
                destinos: ''
            },
            methods: {
                carregarEquipamentos() {
                    axios.get('http://127.0.0.1:8000/api/equipamentos/todos').then(res => {
                        this.equipamentos = res.data;
                    });
                },
                changeLocalId(e) {
                    axios.get('http://127.0.0.1:8000/api/equipamentos/todos/' + e.target.value).then(res => {
                        this.equipamentos = res.data;
                        this.carregaLocalDestino(e.target.value)
                    });
                },
                addEquipamento(event, indice, equipamento) {
                    console.log(equipamento)
                    if (event.target.checked == true) {
                        this.destino.push(equipamento);
                    } else {
                        var id = this.destino.map(function (e) {
                            return e.id;
                        }).indexOf(equipamento.id);
                        this.destino.splice(id, 1)
                    }
                },
                removeItem(indice, item) {
                    this.destino.splice(indice, 1)
                    var id = this.equipamentos.equipamento.map(function (e) {
                        return e.id;
                    }).indexOf(item.id);
                },
                carregaLocalOrigem() {
                    axios.get('http://127.0.0.1:8000/api/locais/todos').then(res => {
                        this.localOrigem = res.data;
                    });
                },
                carregaLocalDestino(local) {
                    axios.get('http://127.0.0.1:8000/api/locais/todos/exceto/' + local).then(res => {
                        this.localDestino = res.data;
                    });
                }
            },
            beforeMount() {
                this.carregarEquipamentos();
                this.carregaLocalOrigem();
                this.carregaLocalDestino();
            }
        })

    </script>

@endsection
