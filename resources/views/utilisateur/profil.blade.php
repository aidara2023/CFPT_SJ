@extends('layouts.app')
@section('fonction')
    Administrateur
@endsection
@section('content')
    <div class="page-content-wrapper" id="app">
        @if (Auth::user()->role->intitule == 'Formateur')
            <profil-user :authid="{{ json_encode(Auth::user()->id) }}" 
          		 :authphoto="{{ json_encode(Auth::user()->photo) }}" 
				:authmatricule="{{ json_encode(Auth::user()->matricule) }}"
				:authprenom="{{ json_encode(Auth::user()->prenom) }}"
                :authnom="{{ json_encode(Auth::user()->nom) }}" 
                :authadresse="{{ json_encode(Auth::user()->adresse) }}" 
				:authtelephone="{{ json_encode(Auth::user()->telephone) }}"
                :authemail="{{ json_encode(Auth::user()->email) }}"
                :authdate_de_naissance="{{ json_encode(Auth::user()->date_de_naissance) }}"
                :authlieu_de_naissance="{{ json_encode(Auth::user()->lieu_de_naissance) }}"
                :authnationalite="{{ json_encode(Auth::user()->nationalite) }}"
                :authstatus="{{ json_encode(Auth::user()->status) }}"
                :authrole="{{ json_encode(Auth::user()->role->intitule) }}"
                :authdepartement="{{ json_encode(Auth::user()->departement->nom_departement) }}"
                :authunite_de_formation="{{ json_encode(Auth::user()->unite_de_formation->nom_unite_formation) }}">
			</profil-user>
        @else
            <profil-user :authid="{{ json_encode(Auth::user()->id) }}"
				:authphoto="{{ json_encode(Auth::user()->photo) }}" 
				:authmatricule="{{ json_encode(Auth::user()->matricule) }}"
                :authprenom="{{ json_encode(Auth::user()->prenom) }}" 
				:authnom="{{ json_encode(Auth::user()->nom) }}"
				:authadresse="{{ json_encode(Auth::user()->adresse) }}" 
                :authtelephone="{{ json_encode(Auth::user()->telephone) }}"
                :authemail="{{ json_encode(Auth::user()->email) }}"
                :authdate_de_naissance="{{ json_encode(Auth::user()->date_de_naissance) }}"
                :authlieu_de_naissance="{{ json_encode(Auth::user()->lieu_de_naissance) }}"
                :authnationalite="{{ json_encode(Auth::user()->nationalite) }}"
                :authstatus="{{ json_encode(Auth::user()->status) }}"
                :authrole="{{ json_encode(Auth::user()->role->intitule) }}"
                :authgenre="{{ json_encode(Auth::user()->genre) }}"
               
             >
			</profil-user>
        @endif
		
    </div>
@endsection
