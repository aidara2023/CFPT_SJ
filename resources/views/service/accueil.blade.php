@extends('layout.app')
@section('titre')
    Service
@endsection
@section('content')
    <div class="elements flou" id="app">
        @include('layout.header')

        <div class="controle">
            <div class="recherche_filtre">
                <div class="recherche">
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div></div>
                {{--  <button class="filtrer mdl">
                    <i class="fi fi-rr-bars-sort"></i>
                    <span class="grand_ecran_seulement">Filtrer</span>
                </button> --}}
            </div>
            <div></div>
            <!-- Onglets de navigation -->
            {{--      <div class="recherche onglets grand_ecran_seulement">
                <div data-fenetre="">Formateurs</div>
                <div data-fenetre="">Eleve</div>
                <div data-fenetre="">Administration</div>
                <div data-fenetre="">Appui</div>
            </div> 
            <div class="petit_ecran_seulement"></div> --}}

            <button class="ajouter mdl">
                <i class="fi fi-rr-plus"></i>
                <span class="grand_ecran_seulement">Ajouter</span>
            </button>
        </div>

        <liste-service></liste-service>




        <!-- Modals -->
        {{-- <dialog data-modal-ajout class="modal">

        <div class="titres">
            <h1>CREER UN UTILISATEUR</h1>
            <h3 class="trouver" style="display: none;">Informations Personnelles</h3>
        </div>
        <!-- <div class="contenu"> -->
        <form action="">


            <div class="droit">

                <div class="image">


                    <div class="roue">
                        <div class="roue">
                            <label for="photo" class="photo">
                                <i class="fi fi-rr-picture"></i>
                                téléchargez votre photo ici
                                <input type="file" id="photo">
                            </label>
                        </div>
                    </div>

                    <label for="photo" class="photo visible">
                        <i class="fi fi-rr-picture"></i>
                        téléchargez votre photo ici
                        <input type="file" id="photo">
                    </label>
                </div>

                <label for="">photo</label>
                <div class="etapes">
                    <div class="cercles" data-etape="1">
                        <div class="actuel"><i class="fi fi-rr-check"></i></div><!-- Cercle -->
                        <span></span> <!--Ligne -->
                        <div class="actuel"><i class="fi fi-rr-check"></i></div>
                        <span></span>
                        <div class="actuel"><i class="fi fi-rr-check"></i></div>
                    </div>
                    <label for="" class="positions" data-etape = "1">ETApe 1</label>
                </div>
            </div>

            <!-- mettre class = "informations" uniquement pour un modal qui n'a pas de photo
                Et enlever la div au dessus -->
            <div class="informations plus">
                <div class="titres">
                    <h1>CREER UN UTILISATEUR</h1>
                    <h3>Informations Personnelles</h3>
                </div>
                <div class="groupe_champs">

                    <div class="champ">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom">
                        <span class="erreur"></span>
                    </div>

                    <div class="champ">
                        <label for="nom">Prenom</label>
                        <input type="text" name="prenom" id="prenom">
                        <span class="erreur"></span>
                    </div>

                </div>
                <div class="groupe_champs">

                    <div class="champ">
                        <label for="nom">Lieu de Naissance</label>
                        <input type="text" name="nom" id="nom">
                        <span class="erreur"></span>
                    </div>

                    <div class="champ">
                        <label for="nom">Date de naissance</label>
                        <input type="text" name="prenom" id="prenom">
                        <span class="erreur"></span>
                    </div>

                </div>
                <div class="groupe_champs">

                    <div class="champ">
                        <label for="nom">Sexe</label>
                        <!-- Mettre la classe select pour un champ avec plusieurs choix
                                et ajouter une div class = "choix" qui va contenir les différentes options
                                sans oublier la class="option" -->
                        <input type="text" name="nom" id="nom" class="select">
                        <span class="erreur"></span>
                        <div class="choix">
                            <p class="option">Masculin</p>
                            <p class="option">Féminin</p>
                        </div>
                    </div>

                    <div class="champ">
                        <label for="nom">nationalité</label>
                        <input type="text" name="prenom" id="prenom">
                        <span class="erreur"></span>
                    </div>

                </div>
                <div class="groupe_champs">

                    <div class="champ">
                        <label for="nom">Adresse</label>
                        <input type="text" name="nom" id="nom">
                        <span class="erreur"></span>
                    </div>

                    <div class="champ">
                        <label for="nom">telephone</label>
                        <input type="text" name="prenom" id="prenom">
                        <span class="erreur"></span>
                    </div>

                </div>

                <div class="champ">
                    <label for="nom">Email</label>
                    <input type="text" name="prenom" id="prenom">
                    <span class="erreur"></span>
                </div>

                <div class="champ">
                    <label for="nom">Email</label>
                    <input type="text" name="prenom" id="prenom">
                    <span class="erreur"></span>
                </div>

                <div class="champ">
                    <label for="nom">Email</label>
                    <input type="text" name="prenom" id="prenom">
                    <span class="erreur"></span>
                </div>

                <div class="champ">
                    <label for="nom">Email</label>
                    <input type="text" name="prenom" id="prenom">
                    <span class="erreur"></span>
                </div>

                <div class="champ">
                    <label for="nom">Email</label>
                    <input type="text" name="prenom" id="prenom">
                    <span class="erreur"></span>
                </div>

                <div class="champ">
                    <label for="nom">Email</label>
                    <input type="text" name="prenom" id="prenom">
                    <span class="erreur"></span>
                </div>

                <div class="champ">
                    <label for="nom">Email</label>
                    <input type="text" name="prenom" id="prenom">
                    <span class="erreur"></span>
                </div>

                <div class="champ">
                    <label for="nom">Email</label>
                    <input type="text" name="prenom" id="prenom">
                    <span class="erreur"></span>
                </div>

                <!-- Le groupe qui contient les boutons -->
                <div class="groupe_champs validation">
                    <!-- Mettre la valeur 1 dans le data-close-modal pour qu'il soit actif -->
                    <button type="button" data-close-modal="1" class="annuler"><span
                            data-statut="visible">Annuler</span></button>
                    <button type="submit" data-close-modal="0" class="suivant"><span
                            data-statut="visible">Suivant</span></button>
                </div>

            </div>


        </form>


        <!--  </div> -->

    </dialog> --}}
        <dialog data-modal-ajout class="modal">
            <service-create></service-create>
        </dialog>
         

        <dialog data-modal-confirmation class="modal message">
            <img src="../assetsCFPT/image/verified.gif" alt="" style="width:30%; height:50%">
            <h1>Ajouté avec succés</h1>
        </dialog>

        <dialog data-modal-erreur class="modal message ">

            <div class="bordure">
                <span class="croix"></span>
                <span class="croix"></span>
            </div>
            <h1>Erreur lors de l'Ajout</h1>
        </dialog>

        <dialog data-modal-détails class="modal message">
            <h1>Détails</h1>
            <div>
                <h3>Service Comptabilité</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias at adipisci eum? Architecto sunt nisi
                    unde, asperiores omnis culpa voluptatum reiciendis, non odit delectus est nihil, itaque iste!</p>
            </div>
        </dialog>

        <!-- class="modal actif" -->
        <dialog data-modal-modification class="modal">
           <img src="../assetsCFPT/image/verified.gif" alt="" style="width:30%; height:50%">
            <h1>Modifier</h1>
            <p style="color:red">Service modifié avec succés </p>
        </dialog>

        <dialog data-modal-suppression class="modal message">
            <img src="../assetsCFPT/image/verified.gif" alt="" style="width:30%; height:50%">
            <h1>Suppression</h1>
            <p style="color:red">Service supprimé avec succés </p>


        </dialog>
          <dialog data-modal-verification class="modal message">
            <img src="../assetsCFPT/image/verified.gif" alt="" style="width:30%; height:50%">
            <h1>Echec</h1>
            <p style="color:red">Ce service existe déja </p>


        </dialog>

        <span class="fond"></span>
    </div>
@endsection
