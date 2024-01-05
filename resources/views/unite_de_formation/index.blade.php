@extends('layout.app')
@section('titre')
    Filière
@endsection
@section('content')
    <div class="elements flou " id="app">
        @include('layout.header')

        <div class="controle">
            <div class="recherche_filtre">
                <div class="recherche">
                    <input type="text" placeholder="Rechercher...">
                </div>
                {{--  <button class="filtrer mdl">
                <i class="fi fi-rr-bars-sort"></i>
                <span class="grand_ecran_seulement">Filtrer</span>
            </button> --}}
            </div>
            <!-- Onglets de navigation -->
            {{--      <div class="recherche onglets grand_ecran_seulement">
            <div data-fenetre="">Formateurs</div>
            <div data-fenetre="">Eleve</div>
            <div data-fenetre="">Administration</div>
            <div data-fenetre="">Appui</div>
        </div> --}}
            <div class="petit_ecran_seulement"></div>

            <button class="ajouter mdl">
                <i class="fi fi-rr-plus"></i>
                <span class="grand_ecran_seulement">Ajouter</span>
            </button>
        </div>


        <liste-unite-de-formation> </liste-unite-de-formation>

        <!-- debut modal pour modifier utilisateur -->
        <dialog data-modal-modification class="modal">
            <h1>Modification</h1>
            <div class="contenu">
                <form action="" method="dialog">
                    <h1 class="sous_titre">Informations Personnelles</h1>

                    <div class="personnel">
                        <input type="text" name="nom" id="nom" placeholder="Nom">
                        <input type="text" name="prenom" id="prenom" placeholder="Prenom">
                        <input type="date" name="date_naissance" id="date_naissance" placeholder="Jour/Mois/Annee">
                        <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance">
                    </div>
                    <div class="sexe">
                        <span class="b2">Sexe</span>
                        <label for="masculin">Masculin
                            <span></span>
                            <input type="radio" name="sexe" id="masculin" value="masculin">
                        </label>
                        <label for="feminin">Feminin
                            <span></span>
                            <input type="radio" name="sexe" id="feminin" value="feminin">
                        </label>
                    </div>
                    <div class="num-addr">
                        <input type="tel" name="telephone" id="telephone" placeholder="Tel : 77 234 48 43">
                        <input type="text" name="adresse" id="adresse" placeholder="Adresse">
                        <input type="text" name="nom_tuteur" id="nom_tuteur" placeholder="Nom tuteur">
                        <input type="text" name="prenom_tuteur" id="prenom_tuteur" placeholder="Prénom tuteur">
                        <input type="tel" name="telephone_tuteur" id="telephone_tuteur" placeholder="Telephone tuteur">
                    </div>

                    <p><span class="str">*</span> Personnes à contacter en cas d'urgence</p>
                    <div class="urgence">
                        <input type="tel" name="contact_urgence_1" id="contact_urgence_1"
                            placeholder="Contact d'urgence 1">
                        <input type="tel" name="contact_urgence_2" id="contact_urgence_2"
                            placeholder="Contact d'urgence 2">
                    </div>
                    <h1 class="sous_titre">Informations Académiques</h1>
                    <div class="academiques">
                        <select name="niveau" id="niveau" aria-placeholder="Niveau">
                            <optgroup label="BTI">
                                <option value="">Niveau</option>
                                <option value="">BTI</option>
                                <option value="">BTI</option>
                                <option value="">BTI</option>
                            </optgroup>
                            <optgroup label="BTS">
                                <option value=""></option>
                            </optgroup>
                            <optgroup label="formations_continues">
                                <option value=""></option>
                            </optgroup>
                        </select>

                        <select name="classe" id="classe" placeholder="Niveau">
                            <option value="">Classe</option>
                            <option value="prive"> Privée</option>
                            <option value="public"> Publique</option>
                        </select>

                        <select name="filiere" id="filiere" placeholder="Niveau">
                            <optgroup label="Département Informatique">
                                <option value="">Filiere</option>
                                <option value="iir">Informatique Industrielle et Réseaux</option>
                                <option value="auto">Automatique</option>
                            </optgroup>
                            <optgroup label="Département Mécanique">
                                <option value=""></option>
                            </optgroup>
                            <optgroup label="Département Electrique">
                                <option value=""></option>
                            </optgroup>
                        </select>

                        <select name="annee_academique" id="annee_academique" placeholder="Niveau">
                            <optgroup label="BTI">
                                <option value="">Année académiques</option>
                            </optgroup>
                            <optgroup label="BTS">
                                <option value=""></option>
                            </optgroup>
                            <optgroup label="formations_continues">
                                <option value=""></option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="boutons">
                        <input type="submit" class="texte" value="Ajouter">
                    </div>
                </form>
            </div>
            <div class="boutons">
                <button type="button" data-close-modal class="texte">Annuler</button>
            </div>
        </dialog>
        {{--  Fin modal pour modifier utilisateur --}}


        {{--  Debut modal pour ajouter utilisateur --}}
        <dialog data-modal-ajout class="modal">
            <unite-de-formation-create></unite-de-formation-create>
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
            <h1>Encaissement</h1>
            <div class="contenu">

                <form action="" method="dialog">
                    <h1 class="sous_titre">Informations Personnelles</h1>


                    <div class="personnel">
                        <div>

                            <input type="text" name="nom" id="nghfhom" placeholder="Nom">
                            <span class="erreur"></span>
                            <span class="erreur">Le nomcompter au moins 3 caractéres Lorem</span>
                        </div>

                        <div>
                            <input type="text" name="prenom" id="prenom" placeholder="Prenom">
                            <span class="erreur"></span>
                            <span class="erreur">Le prénom doit compter au moins 3 caractéres</span>
                        </div>
                        <input type="date" name="date_naissance" id="date_naissance" placeholder="Jour/Mois/Annee">
                        <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance">
                        <span class="erreur"></span>
                    </div>
                    <div class="sexe">
                        <span class="b2">Sexe</span>
                        <label for="masculin">Masculin
                            <span></span>
                            <input type="radio" name="sexe" id="masculin" value="masculin">
                        </label>
                        <label for="feminin">Feminin
                            <span></span>
                            <input type="radio" name="sexe" id="feminin" value="feminin">
                        </label>
                    </div>
                    <div class="num-addr">

                        <input type="tel" name="telephone" id="telephone" placeholder="Tel : 77 234 48 43">
                        <input type="text" name="adresse" id="adresse" placeholder="Adresse">
                        <span class="erreur"></span>
                        <input type="text" name="nom_tuteur" id="nom_tuteur" placeholder="Nom tuteur">
                        <span class="erreur"></span>
                        <input type="text" name="prenom_tuteur" id="prenom_tuteur" placeholder="Prénom tuteur">
                        <span class="erreur"></span>
                        <input type="tel" name="telephone_tuteur" id="telephone_tuteur"
                            placeholder="Telephone tuteur">
                    </div>

                    <p><span class="str">*</span> Personnes à contacter en cas d'urgence</p>
                    <div class="urgence">
                        <input type="tel" name="contact_urgence_1" id="contact_urgence_1"
                            placeholder="Contact d'urgence 1">
                        <input type="tel" name="contact_urgence_2" id="contact_urgence_2"
                            placeholder="Contact d'urgence 2">
                    </div>

                    <h1 class="sous_titre">Informations Académiques</h1>


                    <div class="academiques">
                        <select name="niveau" id="niveau" aria-placeholder="Niveau">
                            <optgroup label="BTI">
                                <option value="">Niveau</option>
                                <option value="">BTI</option>
                                <option value="">BTI</option>
                                <option value="">BTI</option>
                            </optgroup>
                            <optgroup label="BTS">
                                <option value=""></option>
                            </optgroup>
                            <optgroup label="formations_continues">
                                <option value=""></option>
                            </optgroup>
                        </select>

                        <select name="classe" id="classe" placeholder="Niveau">
                            <option value="">Classe</option>
                            <option value="prive"> Privée</option>
                            <option value="public"> Publique</option>

                        </select>

                        <select name="filiere" id="filiere" placeholder="Niveau">
                            <optgroup label="Département Informatique">
                                <option value="">Filiere</option>
                                <option value="iir">Informatique Industrielle et Réseaux</option>
                                <option value="auto">Automatique</option>
                            </optgroup>
                            <optgroup label="Département Mécanique">
                                <option value=""></option>
                            </optgroup>
                            <optgroup label="Département Electrique">
                                <option value=""></option>
                            </optgroup>
                        </select>

                        <select name="annee_academique" id="annee_academique" placeholder="Niveau">
                            <optgroup label="BTI">
                                <option value="">Année académiques</option>
                            </optgroup>
                            <optgroup label="BTS">
                                <option value=""></option>
                            </optgroup>
                            <optgroup label="formations_continues">
                                <option value=""></option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="boutons">
                        <input type="submit" class="texte" value="Modifier">
                    </div>
                </form>
            </div>
            <div class="boutons">
                <button type="button" data-close-modal class="texte">Annuler</button>
            </div>
        </dialog>

        <dialog data-modal-suppression class="modal message">
            <img src="../assetsCFPT/image/verified.gif" alt="" style="width:30%; height:50%">
            <h1>Suppression</h1>
            <p style="color:red">Filiére supprimée avec succés </p>


        </dialog>


        <span class="fond"></span>
    </div>
@endsection
