@extends('admin.master.master')
@section('title')
    Detalhes da Função
@endsection
@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user-plus">Detalhes Função</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{route('admin.home')}}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{route('admin.roles.index')}}">Funçãos </a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{route('admin.roles.show', $role->id)}}" class="text-orange">Detalhes da
                                função</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="dash_content_app_box">

            @if($errors->all())
                @foreach($errors->all() as $error)
                    <x-Forms.message type="orange">
                        <p class="icon-asterisk">{{$error}}</p>
                    </x-Forms.message>
                @endforeach
            @endif

            @if(session()->exists('mensagem'))
                <x-Forms.message type="{{session()->get('color')}}">
                    <p class="icon-asterisk"> {{session()->get('mensagem')}}</p>
                </x-Forms.message>
            @endif

        </div>


        <div class="card" style="width: 18rem; margin: auto">
            <div class="card-header">
                {{$role->name}}
            </div>
            <ul class="list-group list-group-flush">
                @foreach($role->permissions as $permission)
                    <li class="list-group-item">{{$permission->name}}</li>
                @endforeach

            </ul>
        </div>


    </section>
@endsection
