

@if(auth::user->id_role==3)
@extends('layouts.app')
@section('fonction')
 Administrateur
@endsection
@section('content')
    <div class="page-content-wrapper" id="app">
      <liste-inscription></liste-inscription>
    </div>
@endsection 
@elseif (auth::user->id_role==12)
@extends('layouts.app')
@section('fonction')
  Surveillant
@endsection
@section('content')
    <div class="page-content-wrapper" id="app">
      <liste-inscription></liste-inscription>
    </div>
@endsection