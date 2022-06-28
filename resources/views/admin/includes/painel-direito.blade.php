<div class="row " id="painel-direito">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-danger list-announcement">
            <div class="panel-heading">
                <h4 class="panel-title">PRÓXIMAS INSPEÇÕES
                </h4>
            </div>
            <div class="panel-body">
                @verbatim
                    <ul class="list-unstyled mb20">
                        <li v-for="(item, i) in equipamentos" :key="i">
                            <a :href="'/admin/equipamento/'  + item.equipamento_id + '/unidade'" class="">
                                {{item.equipamento.nome}}
                            </a>
                            <small>
                                <span class="next-inspect">
                                    {{ item.data_proxima_inspecao }}
                                </span>
                                <a :href="'/admin/equipamento/unidade/' + item.id+ '/inspecao'">Visualizar</a>
                            </small>
                        </li>
                    </ul>
                @endverbatim
            </div>
            <div class="panel-footer">
                <a href="{{route('admin.unidade.lista')}}" class="btn btn-info mt10" style="width: 100%">Ver Todos</a>
            </div>
        </div>
    </div><!-- col-md-12 -->


</div><!-- row -->


<style>
    .list-announcement .panel-body ul > li {
        padding: 10px 20px;
        border-bottom: 1px solid #eaecf0;
        letter-spacing: normal;
    }

</style>

<script>

    var appPainelDireito = new Vue({
        el: '#painel-direito',
        data: {
            equipamentos: [],
        },
        async mounted() {
            let res = await axios.get('https://app.4-trace.com.br/api/equipamentos/unidades');
            this.equipamentos = res.data;
            var setDiffDay = setInterval(function () {
                if (appPainelDireito.equipamentos.length > 0) {
                    appPainelDireito.carregaDiasFaltantes();
                    clearInterval(setDiffDay)
                }
            }, 10)

        },

        methods: {
            carregaDiasFaltantes() {
                var dias = document.querySelectorAll(".next-inspect");
                for (let i = 0; i < dias.length; i++) {
                    var a = moment();
                    var b = moment(dias[i].innerText);

                    var diffDays = b.diff(a, 'days');

                    dias[i].innerText = diffDays + " dias";

                }
            }
        }
    })
</script>
