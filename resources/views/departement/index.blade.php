
@extends('layout.app')

@section('content')

<div class="elements flou " id="app">

    <div class="entete">
        @include('layout.header')
    </div>

     <liste-departement></liste-departement>

    <!-- debut modal pour modifier utilisateur -->
    


    {{--  Debut modal pour ajouter utilisateur --}}
        <departement-create></departement-create>
    {{--  Fin modal pour ajouter utilisateur --}}


    {{--  Debut modal pour supprimer utilisateur --}}
    <dialog data-modal-suppression class="modal">
        <h1>Suppression</h1>
        <div class="contenu">
            <p>Etes vous sûr de vouloir supprimer cet utilisateur ?</p>
        </div>
        <div class="boutons">
            <button type="button" data-close-modal class="texte">Annuler</button>
            <input type="submit" value="Confirmer">
        </div>
    </dialog>
    {{--  Fin modal pour supprimer utilisateur --}}


    <dialog data-modal-confirmation class="modal">
        <img src="../assetsCFPT/image/verified.gif" alt="" class="anime">
        <h1>Réussi !</h1>
        <br>
        <p class="">Département ajouté avec succès</p>
    </dialog>

    <dialog data-modal-confirmation-sup class="modal">
        <img src="../assetsCFPT/image/verified.gif" alt="" class="anime">
        <h1>Réussi !</h1>
        <br>
        <p class="">Département supprimé avec succès</p>
    </dialog>
</div>
 <span class="fond "></span>
@endsection 


