@if (Auth::user()->id_role == 4)
    @extends('layouts.app')
    @section('fonction')
        Caissier
    @endsection
    @section('content')
        <div class="page-content-wrapper" id="app">

            <liste-valider-inscription></liste-valider-inscription>
        </div>
    @endsection
{{-- @elseif (Auth::user()->id_role == 12)
    @extends('layouts.app')
    @section('fonction')
        Surveillant
    @endsection
    @section('content')
        <div class="page-content-wrapper" id="app">
            <caissier-dashboard></dashboard-user>
        </div>
    @endsection --}}
@endif