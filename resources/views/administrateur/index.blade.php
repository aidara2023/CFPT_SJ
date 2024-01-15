{{-- @extends('layout.app')
@section('titre')
        Tableau de bord
        @endsection
@section('content')
    <div class="elements flou" id="app">
        @include('layout.header')
   
        <div class="liste">
            <dash-board></dash-board>
        </div>
    </div>
@endsection --}}
@extends('layouts.app')
@section('fonction')
        Administrateur
        @endsection
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Tableau de Bord</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="{{ route('admin_index') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Tableau de Bord</li>
                </ol>
            </div>
        </div>
        <div  id="app">
       <dashboard-user></dashboard-user>
    </div>
    </div>
</div>
@endsection



