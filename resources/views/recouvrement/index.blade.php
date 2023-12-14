@extends('layout.app')
<link rel="stylesheet" href="/assetsCFPT/recouvrementCss/caissier.css">
@section('content')
    {{-- @include('layout.left_bar') --}}
    <div class="elements flou " id="app">
        <div class="entete">
            @include('layout.header')
        </div>
        <recouvrement-tableau></recouvrement-tableau>
   

        <dialog data-modal-modification class="modal">
            <h1>Encaissement</h1>
            <div class="contenu">
    
                <form action="" method="dialog">
                    <h1 class="sous_titre">Informations Personnelles</h1>
    
    
                    <div class="personnel">
                        <div>
    
                            <input type="text" name="nom" id="nghfhom" placeholder="Nom">
                            <span class="erreur">Le nomcompter au moins 3 caractéres Lorem</span>
                        </div>
    
                        <div>
                            <input type="text" name="prenom" id="prenom" placeholder="Prenom">
                            <span class="erreur">Le prénom doit compter au moins 3 caractéres</span>
                        </div>
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
                        <input type="submit" class="texte" value="Modifier">
                    </div>
                </form>
            </div>
            <div class="boutons">
                <button type="button" data-close-modal class="texte">Annuler</button>
            </div>
        </dialog>
    
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
    
        <dialog data-modal-encaissement class="modal">
            <h1>Encaisser</h1>
            <div class="contenu">
                <p>encaissement encaisser </p>
            </div>
            <div class="boutons">
                <button type="button" data-close-modal class="texte">Annuler</button>
                <input type="submit" value="Confirmer">
            </div>
        </dialog>
    
        <dialog data-modal-filtre class="modal" >
            <recouvrement-create></recouvrement-create>
        </dialog>
    
    </div>






    <span class="fond "></span>





    {{-- <dialog data-modal-ajout class="modal">
        <h1>Ajout</h1>
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


        <div class="boutons ">
            <button type="button" data-close-modal class="texte annuler">Annuler</button> 
        </div>
    </dialog> --}}
    <!-- class="modal actif" -->
   

    <script>
        //changement de couleur et de texte
        var deroulant = document.querySelectorAll('.deroulant');
        var filtre = document.querySelectorAll('.filtre') /* document.childNodes */
        console.log();

        filtre.forEach(item => {
            item.addEventListener('click', function() {
                var titre = item.parentElement;
                titre = titre.firstElementChild;

                titre.textContent = item.textContent;

            });
        });

        deroulant.forEach(item => {
            item.addEventListener('mouseleave', function() {
                item.scrollTo(0, -3);
            });
        });
        /* deroulant.forEach(item => (){
            item.addEventListener('click')
        }) */

        var fond = document.querySelector('.fond');
        var flou = document.querySelectorAll('.flou');

        var mdl = document.querySelectorAll('.mdl');
        var contenu = "";

        //Nouveaux types de modal
        var ajout = document.querySelector("[data-modal-ajout]");
        var modification = document.querySelector("[data-modal-modification]");
        var suppression = document.querySelector("[data-modal-suppression]");
        var encaissement = document.querySelector("[data-modal-encaissement]");
        var filtre = document.querySelector("[data-modal-filtre]");


        var fermemod = document.querySelectorAll('[data-close-modal]');

        // Ouverture des modals
        mdl.forEach(item => {
            item.addEventListener('click', function() {
                var index = Array.from(mdl).indexOf(this);
                contenu = mdl[index].textContent;
                contenu = contenu.trim();

                console.log(mdl[index].classList.contains("modifier"));

                flou.forEach(item => {
                    item.classList.add("actif");
                });
                fond.classList.add("actif");

                if (contenu == "Ajouter") {
                    console.log(contenu);

                    setTimeout(function() {
                        ajout.showModal();
                        ajout.classList.add("actif");
                    }, 20);
                }

                if (mdl[index].classList.contains("modifier")) {
                    console.log(contenu);
                    //modification.style.backgroundColor = 'var(--clr)';

                    setTimeout(function() {
                        modification.showModal();
                        modification.classList.add("actif");
                    }, 20);
                }

                if (mdl[index].classList.contains("supprimer")) {
                    console.log(contenu);

                    suppression.style.backgroundColor = 'var(--rouge)';
                    suppression.style.color = 'var(--clr2)';
                    setTimeout(function() {
                        suppression.showModal();
                        suppression.classList.add("actif");
                    }, 20);
                }


                if (mdl[index].classList.contains("encaisser")) {
                    console.log(contenu);

                    setTimeout(function() {
                        encaissement.showModal();
                        encaissement.classList.add("actif");
                    }, 20);
                }


                if (mdl[index].classList.contains("filtrer")) {
                    console.log(contenu);

                    setTimeout(function() {
                        filtre.showModal();
                        filtre.classList.add("actif");
                    }, 20);
                }

            });
        });

        //Fermeture des modals
        fermemod.forEach(item => {
            item.addEventListener('click', () => {
                var actif = document.querySelectorAll('.actif');
                actif.forEach(item => {
                    item.classList.remove("actif");
                });
                ajout.close();
                modification.close();
                suppression.close();
                filtre.close();
                encaissement.close();

            })
        });



        //Fenêtre actif
        var li = document.querySelectorAll('.fntr');


        li.forEach(liste => {
            liste.addEventListener('click', function() {
                li.forEach(item => {
                    item.classList.remove('actif');
                });
                this.classList.add('actif');
            });
        });

        var spans = document.getElementsByTagName("span");
        console.log(spans);


        //Petit message d'erreur sous les inputs
        var erreur = document.querySelectorAll('.erreur');
        var nom = document.getElementById("nom");

        erreur[1].textContent = "A remplir";
        erreur[1].previousElementSibling.style.borderColor = 'red';

    </script>
@endsection
