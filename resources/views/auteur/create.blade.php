@extends('layouts.app')
@section('fonction')
Bibliothcaire
@endsection
@section('content')
<div class="page-content-wrapper" id="app">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Nouveau Auteur</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('bibliothecaire_accueil') }}">Tableau de Bord</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active" >Paramétres &nbsp;<a class="parent-item"></a>&nbsp;<i class="fa fa-angle-right"></i>
                    <li><a class="parent-item" :href="'/auteur/accueil'">Auteur</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Information</header>
                        <button id="panel-button"
                            class="mdl-button mdl-js-button mdl-button--icon pull-right"
                            data-upgraded=",MaterialButton">
                            <i class="material-icons">more_vert</i>
                        </button>
                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            data-mdl-for="panel-button">
                            <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                            </li>
                            <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                            </li>
                            <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                                here</li>
                        </ul>
                    </div>
                    <div class="card-body row">
                        <auteur-create></auteur-create>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
