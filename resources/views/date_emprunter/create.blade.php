@extends('layout.app')
@section('content')

<div class="elements flou ">
    <div class="entete">
        <h1 class="titre">Administrateur</h1>
         <h1 class="sous_titre">Utilisateurs</h1>
     </div>
     <div class="affichage">
        <div class="avant">
            <h1 class="texte">Personnel Administratif</h1>
            <a href="#">
                <button class="texte ajout mdl" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
            </a>
        </div>
        <div class="sections">
            <!-- Répéter la div utilisateur pour un autre utilisateur -->
            <div class="utilisateur">
                <img src="image1.png" alt="Etu" class="petite">
                <p class="texte" id="n">Mariama BA</p>
                <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-edit"></i>
                        <span class="modifier mdl">Modifier</span>
                    </a>
                    <a href="" class="texte b">
                        <i class="fi fi-rr-comment-alt-dots"></i>
                        <span class="details">Détails</span>
                    </a>
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-cross"></i>
                        <span class="supprimer mdl">Supprimer</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="affichage">
            <div class="avant">
                <h1 class="texte">Formateurs</h1>
                <a href="#">
                    <button class="texte ajout  mdl" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
                </a>
            </div>
            <div class="sections">
                <!-- Répéter la div utilisateur pour un autre utilisateur -->
                <div class="utilisateur">
                    <img src="professeur.png" alt="Etu" class="petite">
                    <p class="texte" id="n">Amadou GUEYE</p>
                    <div  class="presences">
                        <a href="#" class="texte b">
                            <i class="fi fi-rr-edit"></i>
                            <span class="modifier mdl">Modifier</span>
                        </a>
                        <a href="" class="texte b">
                            <i class="fi fi-rr-comment-alt-dots"></i>
                            <span class="details">Détails</span>
                        </a>
                        <a href="#" class="texte b">
                            <i class="fi fi-rr-cross"></i>
                            <span class="supprimer mdl">Supprimer</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <span class="fond "></span>

<!-- debut modal pour modifier utilisateur -->
<dialog data-modal-modification class="modal">
    <h1>Modification</h1>
    <div class="contenu">
        <form action="" method="dialog" >
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
                    <input type="radio" name="sexe" id="feminin" value="feminin" >
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
                <input type="tel" name="contact_urgence_1" id="contact_urgence_1" placeholder="Contact d'urgence 1">
                <input type="tel" name="contact_urgence_2" id="contact_urgence_2" placeholder="Contact d'urgence 2">
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
                <input  type="submit" class="texte" value="Ajouter">
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
        <div id="app">
            <utilisateur-create></utilisateur-create>
        </div>
</dialog>
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


@endsection