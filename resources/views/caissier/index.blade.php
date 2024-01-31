@extends('layouts.app')

    @if (Auth::user()->id_role == 4)
        @section('fonction') Caissier @endsection
    @elseif (Auth::user()->id_role == 12)
        @section('fonction') Surveillant @endsection
    @endif

    @section('content')
        <div class="page-content-wrapper" id="app">
            <caissier-dashboard></dashboard-user>
        </div>
    @endsection
