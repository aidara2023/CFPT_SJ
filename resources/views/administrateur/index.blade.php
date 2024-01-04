@extends('layout.app')
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
@endsection
