{{-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assetsCFPT/css/cssCreate/create.css">
    <title>Enregistrement</title>
    @vite('resources/js/app.js')
</head>
<body id="app">
    <div class="cote_gauche">
        <div class="elements">

            <img src="/assetsCFPT/image/logo_cfpt_bleu.png" alt="">
            <h1 class="titre">Enregistrement</h1>
            <p>Veuillez remplir ce formulaire</p>
        </div>
    </div>
    <unite-de-formation-create></unite-de-formation-create>
</body>
</html> --}}
@extends('layouts.app')
@section('fonction')
Administrateur
@endsection
@section('content')
<div class="page-content-wrapper" id="app">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Nouveau Filiere</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="{{ route('admin_index') }}">Tableau de Bord</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active" >Paramétres &nbsp;<a class="parent-item"></a>&nbsp;<i class="fa fa-angle-right"></i>
                    <li><a class="parent-item" :href="'/unite_de_formation/index'">Filière</a>&nbsp;<i class="fa fa-angle-right"></i>
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
                        <unite-de-formation-create></unite-de-formation-create>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
