@extends('admin.master.master')

@section('title')

    Relatório

@endsection

@section('content')



    <div id="relatorio-app">

        <div class="panel panel-site-traffic">

            <div class="panel-heading">

                <h4 class="panel-title text-success ">Relatório</h4>

            </div>

            <div class="panel-body">



                <form action="{{route('admin.relatorio.exportar')}}" method="get" target="_blank">

                    @csrf

                    @verbatim

                        <div class="row">

                            <div class="col-xs-6 col-sm-4">

                                <label for="locais" class="col-sm-12 control-label "> Local </label>

                                <div class="col-sm-12">

                                    <select name="local_id"

                                            v-model="local"

                                            id="locais" class="form-control " style="width: 100%">

                                        <option value="0" selected="selected">Todos</option>



                                        <option v-for="(item, i) in loadData.locais" :key="item.id"

                                                :value="item.id">{{item.nome}}</option>

                                    </select>



                                </div>

                            </div>



                            <div class="col-xs-6 col-sm-4">

                                <label for="categorias" class="col-sm-12 control-label "> Categoria </label>

                                <div class="col-sm-12">

                                    <select name="categoria_id"

                                            v-model="categoria"

                                            id="categorias" class="form-control" style="width: 100%">

                                        <option value="0" selected="selected">Todos</option>



                                        <option v-for="(item, i) in loadData.categorias" :key="item.id"

                                                :value="item.id">{{item.nome}}</option>

                                    </select>

                                </div>

                            </div>



                            <div class="col-xs-6 col-sm-4">

                                <label for="equipamentos" class="col-sm-12 control-label "> Equipamento </label>

                                <div class="col-sm-12">

                                    <select name="equipamento_id"

                                            v-model="equipamento"

                                            id="equipamentos" class="form-control" style="width: 100%">

                                        <option value="0"

                                                selected="selected">Todos

                                        </option>



                                        <option v-for="(item, i) in loadData.equipamentos" :key="item.id"

                                                :value="item.id">{{item.nome}}</option>

                                    </select>

                                </div>

                            </div>



                        </div>

                        <br>

                        <div class="row">

                            <div class="col-xs-6 col-sm-4">

                                <label for="datainicial" class="col-sm-4 control-label "> Data Inicial </label>

                                <div class="col-sm-12">

                                    <input name="datainicial"

                                           v-model="dataInicial"

                                           id="datainicial" type="date" class="form-control hasDatepicker"

                                           placeholder="mm/dd/yyyy">

                                </div>

                            </div>

                            <div class="col-xs-6 col-sm-4">



                                <label for="datafinal" class="col-sm-4 control-label "> Data Final </label>

                                <div class="col-sm-12">

                                    <input name="datafinal"

                                           v-model="dataFinal"

                                           type="date" id="datafinal" class="form-control hasDatepicker"

                                           placeholder="mm/dd/yyyy">

                                </div>



                            </div>



                            <div class="col-xs-6 col-sm-4">



                                <label for="statusep" class="col-sm-12 control-label"> Status </label>

                                <div class="col-sm-12">

                                    <select name="status"

                                            v-model="status"

                                            id="statusep" class="form-control" style="width: 100%">



                                        <option value="0"

                                                selected="selected">Todos

                                        </option>



                                        <option value="1" class="">Aprovado</option>

                                        <option value="2" class="">Reprovado</option>

                                        <option value="3" class="">Retirados de uso</option>

                                        <option value="4">Em transito</option>

                                    </select>

                                </div>





                            </div>



                        </div><!-- row -->

                        <br>

                        <div class="row">



                            <div class="col-xs-6 col-sm-4">

                                <br>

                                <label class="ckbox ckbox-primary">

                                    <input type="checkbox"

                                           v-model="vencidas" class="">

                                    <span class="">

                                        Incluir Inspeções vencidas

                                    </span>

                                </label>



                            </div>



                            <div class="col-xs-6 col-sm-4">

                                <label class="col-sm-12 control-label"> </label>

                                <div class="col-sm-12">

                                    <span @click="gerarRelatorio"

                                          class="btn btn-success btn-quirk btn-stroke btn-block ">

                                        Gerar relatório

                                    </span>



                                </div>

                            </div>



                            <div class="col-xs-6 col-sm-4">

                                <label class="col-sm-12 control-label"> </label>

                                <div class="col-sm-12">

                                    <button

                                        v-if="resultados.length > 0"

                                        href=""

                                        class="btn btn-danger btn-quirk btn-stroke btn-block">exportar

                                    </button>

                                </div>

                            </div>



                        </div><!-- row -->

                    @endverbatim

                </form>



            </div><!-- panel-body -->



        </div>



        @verbatim

            <div class="spinner" v-if="isLoad">

                <div class="double-bounce1"></div>

                <div class="double-bounce2"></div>

            </div>

            <div class="panel panel-site-traffic"  v-if="showTable"

                 style="padding: 15px; background: none">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12">

                        <table

                            v-if="resultados.length > 0"

                            id="relatorioTable"

                            class="table table-bordered table-default table-striped nomargin"

                        >

                            <thead class="success">

                            <tr>

                                <th class="text-left" style="cursor: pointer">

                                    Tag

                                </th>

                                <th class="text-left" style="cursor: pointer">

                                    Nome

                                </th>

                                <th class="text-left" style="cursor: pointer">

                                    Status

                                </th>

                                <th class="text-right" style="cursor: pointer">

                                    Inspetor

                                </th>

                                <th class="text-right" style="cursor: pointer">

                                    última inspeção

                                </th>

                                <th class="text-right" style="cursor: pointer">

                                    Data de Validade

                                </th>

                            </tr>

                            </thead>

                            <tbody>

                            <tr v-for="(item,i) in resultados" :key="item.id">

                                <td class="text-left">{{ tag[i] }}</td>

                                <td class="text-left">{{ nomes[i] }}</td>

                                <td class="text-left ">{{formatarStatus(item.status)}}</td>

                                <td class="text-right">{{item.user.name}}</td>

                                <td class="text-right">{{moment(item.data_inspecao).format("DD/MM/YYYY") }}</td>

                                <td class="text-right">{{moment(item.data_validade).format("DD/MM/YYYY")  }}</td>


                            </tr>
                            
                         

                            </tbody>

                        </table>

                        <div v-else>

                            <p class="text-center mt20" style="font-size: 20px">Sem Resultados</p>



                        </div>



                    </div>

                </div>

            </div>







        @endverbatim



    </div>

@endsection

@section('js')

    <script>

        var obg;

        let appRelatorio = new Vue({

            filterId: '#relatorioTable5',

            el: '#relatorio-app',

            data: {

                loadData: [],

                resultados: [],

                local: '0',

                categoria: '0',

                equipamento: '0',

                status: '0',

                dataInicial: '',

                dataFinal: '',

                vencidas: '',

                isLoad: false,

                showTable: false,

                resultado: '',

                unidade:'',

                tag:[],

                quantidade: '0',

                resul:'0',

                nomes: []

            },

            

            methods: {

                

                gerarRelatorio() {

                    this.isLoad = true
                    
                    const vm = this

                    axios.post("{{ env('APP_URL') }}" + "admin/relatorio/gerar-relatorio", {

                        'local_id': this.local,

                        'categoria_id': this.categoria,

                        'equipamento_id': this.equipamento,

                        'datainicial': this.dataInicial,

                        'datafinal': this.dataFinal,

                        'status': this.status,

                    }).then(res => {

                        this.resultados = res.data;

                        vm.isLoad = false

                        this.showTable = true

                        this.getUnidade()

                        console.log(this.resultado)

                        this.percorrendoEquipamentos()

                       aplicarDataTable('#relatorioTable5')

                    
                    })

                },
                

                getUnidade(){
                    this.resultado = this.resultados
                },

                carregarDespachos() {

                    axios.get("{{ env('APP_URL') }}" + "admin/relatorio/load-files").then(res => {

                        this.loadData = res.data;

                    });

                },

                excluirDespachos() {

                    axios.post('https://app.4-trace.com.br/api/despachos/excluir', {

                        'despachoId': this.despachoId

                    }).then(res => {

                        this.carregarDespachos();

                    });

                },

                formatarStatus(e) {

                    if (e == 1) {

                        return 'Aprovado';

                    }

                    if (e == 2) {

                        return 'Reprovado';

                    } else {

                        return 'Retirados de Uso';

                    }

                },

                //Coleta manual de cada dado

               
                quantidadeDeEquipamentos(){
                    this.resul= (this.resultado).length
                    console.log(this.resul, 'oi')

                    return this.resul
                },
                percorrendoEquipamentos(){
                    this.quantidade = this.quantidadeDeEquipamentos()

                    for (let i = 0; i < this.quantidade; i++) {
                        if(this.resultado[i].unidade != null ){
                            this.tag[i] = this.resultado[i].unidade.tag
                            this.nomes[i] = this.resultado[i].unidade.equipamento.nome 
                        
                            console.log(this.tag[i],this.nomes[i],i)
                        } 
                    }
                }

            },

            mounted(){
                //this.getUnidade()
            },

            beforeMount() {

                this.carregarDespachos();


            }

        })



    </script>



@endsection

