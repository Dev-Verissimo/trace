<div class="leftpanel">
    <div class="leftpanelinner">

        <!-- ################## LEFT PANEL PROFILE ################## -->

        <div class="media leftpanel-profile">
            <div class="media-left">
                <a href="#">
                        <img src="{{ (Auth::user()->imagem == '' ? env('APP_URL') . 'images/avatar.jpg' :
                        url('uploads/' . Auth::user()->imagem))}}" alt="" class="media-object img-circle">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{Auth::user()->name}}
                    <a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a>
                </h4>
                <span>{{Auth::user()->profissao}}</span>
            </div>
        </div><!-- leftpanel-profile -->

        <div class="leftpanel-userinfo collapse" id="loguserinfo">
            <h5 class="sidebar-title">Endereço</h5>
            <address>
                {{Auth::user()->endereco}}
            </address>
            <h5 class="sidebar-title">Contato</h5>
            <ul class="list-group">
                <li class="list-group-item">
                    <label class="pull-left">Email</label>
                    <span class="pull-right">{{Auth::user()->email}}</span>
                </li>
                <li class="list-group-item">
                    <label class="pull-left">Telefone</label>
                    <span class="pull-right">{{Auth::user()->telefone}}</span>
                </li>

            </ul>
        </div><!-- leftpanel-userinfo -->

        <ul class="nav nav-tabs nav-justified nav-sidebar">
            <li class="tooltips active" data-toggle="tooltip" title="Menu">
                <a data-toggle="tab" data-target="#mainmenu"><i class="tooltips fa fa-ellipsis-h"></i></a>
            </li>
{{--            <li class="tooltips unread" data-toggle="tooltip" title="Logs">--}}
{{--                <a data-toggle="tab" data-target="#emailmenu"><i class="tooltips fa fa-eye"></i></a>--}}
{{--            </li>--}}
{{--            <li class="tooltips" data-toggle="tooltip" title="Usuário">--}}
{{--                <a data-toggle="tab" data-target="#contactmenu"><i class="fa fa-user"></i></a>--}}
{{--            </li>--}}
            <li class="tooltips" data-toggle="tooltip" title="Configurações">
                <a data-toggle="tab" data-target="#settings"><i class="fa fa-cog"></i></a>
            </li>
            <li class="tooltips" data-toggle="tooltip" title="Sair">
                <a href="{{route('admin.logout')}}"><i class="fa fa-sign-out"></i></a>
            </li>
        </ul>

        <div class="tab-content">

            <!-- ################# MAIN MENU ################### -->

            <div class="tab-pane active" id="mainmenu">


                <ul class="nav nav-pills nav-stacked nav-quirk">
                    <li class="{{isActive('admin.home')}}">
                        <a href="{{route('admin.home')}}">
                            <i class="fa fa-home"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-parent {{isActive('admin.usuarios')}}  {{isActive('admin.roles')}} c-pointer">
                        <a><i class="fa fa-user"></i> <span>Usuários</span></a>
                        <ul class="children">
                            <li>
                                <a href="{{route('admin.roles.index')}}">
                                <i class="fa fa-group"></i>
                                    Perfis de usuários
                                </a>
                            </li>
                            <li class="{{isActive('admin.usuarios.index')}}">
                                <a href="{{route('admin.usuarios.index')}}">
                                <i class="fa fa-user"></i>
                                    Usuários
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{isActive('admin.fabricante')}}">
                        <a href="{{route('admin.fabricante.index')}}">
                            <i class="fa fa fa-gears"></i> <span>Fabricantes</span>
                        </a>
                    </li>
                    <li class="{{isActive('admin.categoria')}}">
                        <a href="{{route('admin.categoria.index')}}">
                            <i class="fa fa-sitemap"></i> <span>Categorias</span>
                        </a>
                    </li>
                    <li class="{{isActive('admin.equipamento')}} {{isActive('admin.arquivo')}} {{isActive('admin.unidade')}} {{isActive('admin.inspecao')}} ">
                        <a href="{{route('admin.equipamento.index')}}">
                            <i class="fa fa-cubes"></i> <span>Equipamentos</span>
                        </a>
                    </li>
                    <li class="{{isActive('admin.relatorio')}} ">
                        <a href="{{route('admin.relatorio.index')}}">
                            <i class="fa fa-bar-chart"></i> <span>Relatórios</span>
                        </a>
                    </li>

                    <li class="{{isActive('admin.local')}}">
                        <a href="{{route('admin.local.index')}}">
                            <i class="fa fa-map-marker"></i> <span>Locais</span>
                        </a>
                    </li>

                    <li class="nav-parent {{isActive('admin.solicitacao')}} {{isActive('admin.despacho')}}">
                        <a href=""><i class="fa fa-retweet"></i> <span>Movimentações</span></a>
                        <ul class="children">
                            <li>
                                <a href="{{route('admin.solicitacao.index')}}">
                                    <i class="fa fa-asterisk"></i> Solicitações
                                </a>
                            </li>
                            <li class="{{isActive('admin.solicitacao.lista')}}">
                                <a href="{{route('admin.solicitacao.lista')}}"> <i class="fa fa-arrow-right"></i> Listas de envio</a>
                            </li>
                            <li class="{{isActive('admin.despacho')}}">
                                <a href="{{route('admin.despacho.lista')}}">
                                    <i class="fa fa-arrow-left"></i> Lista de recebimentos
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </div><!-- tab-pane -->


            <!-- #################### SETTINGS ################### -->

            <div class="tab-pane" id="settings">
                <h5 class="sidebar-title">Informações</h5>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="nomeinfo" class="control-label center-block">Nome:</label>
                        <input id="nomeinfo" type="text" class="form-control" readonly disabled value="{{auth()->user()->name}}" >
                    </div>
                    <div class="form-group">
                        <label class="control-label center-block" for="emailinfo">Email:</label>
                        <input id="emailinfo" type="text" class="form-control" readonly disabled value="{{auth()->user()->email}}">
                    </div>

                    <a href="{{route('admin.usuarios.edit', auth()->user()->id )}}" class="btn btn-success btn-quirk btn-block">Editar informações</a>
                </div>

            </div>
            <!-- tab-pane -->
        </div><!-- tab-content -->
    </div><!-- leftpanelinner -->
</div><!-- leftpanel -->
