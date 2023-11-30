<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-thin-straight/css/uicons-thin-straight.css'>
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel="stylesheet" href="/pages_web/Users/mac6/Desktop/Pages/pages_web/CSS/admin.css">
    <link rel="stylesheet" href="/pages_web/Users/mac6/Desktop/Pages/pages_web/CSS/caissier.css">
    <title>Caissier</title>
</head>
<body >
    <!-- 
        <i class="fi fi-rr-user"></i>
        <i class="fi fi-rr-graduation-cap"></i>
        <i class="fi fi-rr-money-bill-wave"></i>
        <i class="fi fi-rs-book-bookmark"></i>
        <i class="fi fi-ss-pharmacy"></i>
        <i class="fi fi-rs-building"></i>
        <i class="fi fi-rr-tools"></i>
        <i class="fi fi-rs-folder-minus"></i>
        <i class="fi fi-ss-sign-out-alt"></i>

        <i class="fi fi-br-check"></i>

     -->
     

        
     <nav class="flou ">
        <ul >
            <li class="fntr menu"><a href="#">
                <div>
                    <i class="fi fi-rr-home"></i>
                    <span>Accueil</span>
                </div>
            </a>
            <ul class="deroulante">
                <li class="fntr" ><a href="#">
                    <i class="fi fi-rr-home"></i>
                    <span>option 1</span>
                </a>
            </li>
                <li class="fntr" ><a href="#">
                    <i class="fi fi-rr-home"></i>
                    <span>option 2</span>
                </a>
            </li>
                <li class="fntr" ><a href="#">
                    <i class="fi fi-rr-home"></i>
                    <span>option 3</span>
                </a>
            </li>
            </ul>
        </li>
        
            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-user"></i>
                    <span >Utilisateurs</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-graduation-cap"></i>
                    <span>Pédagogique</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-money-bill-wave"></i>
                    <span>Paiements</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-book-bookmark"></i>
                    <span>Bibliothèque</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rs-pharmacy"></i>
                    <span>Infirmerie</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-building"></i>
                    <span>Partenariats</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-tool-box"></i>
                    <span>Matériel</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-folder-minus"></i>
                    <span>Archives</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-sign-out-alt"></i>
                    <span>Me déconnecter</span>
                </div>
            </a></li>

        </ul>
     </nav>

     <div class="elements flou ">
        <div class="entete">
            <h1 class="titre">Caissier</h1>
             <!-- <div class="bloc">
                <h1 class="sous_titre">Etudiants</h1>
             <div class="recherche">
                <i class="fi fi-rr-search"></i>
                <input  type="text" name="" placeholder="Rechercher un étudiant">
            </div>
             </div> -->
         </div>
         <div class="affichage">
           
            <div class="sections">
                <div class="utilisateurnv" style="height: 60px;align-items: flex-start;/* grid-template-columns: 2fr 1fr; */border: none;">
                   

                    <!-- Informations sur le paiement -->
                    <!-- <div class="paiement"> -->
                        <div class="recherche" style="width: auto;">
                        <i class="fi fi-rr-search"></i>
                        <input  type="text" name="" placeholder="Rechercher">
                    <!-- </div> -->
                    </div>

                    <div class="paiemen">
                        <button class="texte recherche mdl filtrer" style="background-color: var(--clr); color: white;border: 1px solid;outline: none;gap: 0;">
                            <i class="fi fi-rr-bars-sort" style="color: white;"></i>
                            <span>Filtrer</span>
                        </button>
                    </div>
                    <!-- actions -->
                    <div class="actions" style="height: fit-content;">
                        <a href="#">
                            <button class="texte ajout mdl" > <i class="fi fi-rr-plus"></i><span >Ajouter</span></button>
                        </a>
                        </div>
                    
                </div>
                <div class="utilisateurnv" style="color: var(--clr);">
                    <!-- informations sur l'utilisateur  -->
                    <div class="info">
                        <img src="" alt="" class="petite">
                        <p class="texte matricule">Matricule</p>
                        <p class="texte prenom">Prénom </p>
                        <p class="texte nom">Nom</p>

                        <p class="texte classe">Classe</p><!-- 
                        <div class="texte classe deroulant">
                            <p>Classe </p><br>
                            <p class="filtre">Classe</p>
                            <p class="filtre">IIR 2</p>
                            <p class="filtre">MEL 1</p>
                            <p class="filtre">MA 1</p>
                            <p class="filtre">ET 3</p>
                        </div> -->
                    </div>

                    <!-- Informations sur le paiement -->
                    <div class="paiement">
                        <p class="texte montant">Montant</p>
                        <p class="texte statut" style="background-color: transparent;height: auto;">Statut</p>
                        <!-- <div class="texte statut deroulant" style="background-color: transparent;">
                            <p>Statut</p><br>
                            <p class="filtre">Statut</p>
                            <p class="filtre" style="color: lime;">Payé</p>
                            <p class="filtre" style="color: var(--rouge);">Impayé</p>
                        </div> -->
                        <p class="texte date">Date</p>
                    </div>

                    <!-- actions -->
                    <p class="actions texte" style="height: fit-content;">Actions</p>
                </div>
                <div class="utilisateurnv">
                    <!-- informations sur l'utilisateur  -->
                    <div class="info">
                        <img src="etudiant.png" alt="etu" class="petite">
                        <p class="texte matricule">M10023342</p>
                        <p class="texte prenom">Abdoulaye Mamadou Demba</p>
                        <p class="texte nom">SARR </p>
                        <p class="texte classe">IIR1</p>
                    </div>

                    <!-- Informations sur le paiement -->
                    <div class="paiement">
                        <p class="texte b montant">700.000</p>
                        <div class="statut paye"></div>
                        <p class="texte date">12/11/2023</p>
                    </div>

                    <!-- actions -->
                    <div class="actions">
                        <a href="#" class="texte b">
                            <i class="fi fi-rr-angle-small-down"></i>
                            <span class="modifier">Actions</span>
                    </a>
                        <a href="#" class="texte b encaisser mdl">
                            <i class="fi fi-rr-money-check-edit"></i>
                            <span class="">Encaisser</span>
                    </a>
            
                        <a href="" class="texte b">
                            <i class="fi fi-rr-comment-alt-dots"></i>
                            <span class="details">Détails</span>
                    </a>
            
                        <a href="#" class="texte b supprimer mdl">
                            <i class="fi fi-rr-cross "></i>
                            <span class="">Supprimer</span></a>
                    </div>

                    
                </div>
         </div>
        
     </div>
     </div>






     
    

  

  
    <dialog data-modal-ajout class="modal">
        
        <div class="titres">
            <h1>CREER UN UTILISATEUR</h1>
            <h3>Informations Personnelles</h3>
        </div>
        <!-- <div class="contenu"> -->
            <form action="" method="dialog" >
                
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

                    <!-- Le groupe qui contient les boutons -->
                    <div class="groupe_champs validation">
                        <!-- Mettre la valeur 1 dans le data-close-modal pour qu'il soit actif -->
                        <button type="button" data-close-modal="1" class="annuler"><span data-statut="visible">Annuler</span></button> 
                        <button type="submit" data-close-modal="0" class="suivant"><span data-statut="visible">Suivant</span></button>
                    </div>

                    </div>
                
              
            </form>


       <!--  </div> -->
    
    </dialog>
    <dialog data-modal-confirmation class="modal message">            
                   <img src="verified.gif" alt="">
                   <h1>Ajouté avec succés</h1>
    </dialog>
    <dialog data-modal-erreur class="modal message actif">            
                   <div>
                        <span></span>
                        <span></span>
                   </div>
                   <h1>Erreur lors de l'Ajout</h1>
    </dialog>
 <!-- class="modal actif" -->
    <dialog data-modal-modification class="modal">
        <h1>Encaissement</h1>
        <div class="contenu">

            <form action="" method="dialog" >
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
                        <input type="radio" name="sexe" id="feminin" value="feminin" >
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
                    <input  type="submit" class="texte" value="Modifier" >
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

    <dialog data-modal-filtre class="modal">
        <h1>Filtrer par</h1>
        <div class="contenu">
            <p>filtrer filtrer</p>
        </div>
        <div class="boutons">
            <button type="button" data-close-modal class="texte">Annuler</button>
            <input type="submit" value="Confirmer"> 
        </div>
    </dialog>

  
     <script>

            //changement de couleur et de texte
            var deroulant =  document.querySelectorAll('.deroulant');
            var filtre = document.querySelectorAll('.filtre') /* document.childNodes */
            console.log();

            filtre.forEach(item => {
                item.addEventListener('click', function(){
                    var titre = item.parentElement;
                    titre = titre.firstElementChild;

                    titre.textContent = item.textContent;

                });
            });

            deroulant.forEach(item => {
                item.addEventListener('mouseleave', function(){
                    item.scrollTo(0,-3);
                });
            });
            /* deroulant.forEach(item => (){
                item.addEventListener('click')
            }) */
/* 
            var fond = document.querySelector('.fond'); */
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
                item.addEventListener('click', function(){
                    var index = Array.from(mdl).indexOf(this);
                    contenu = mdl[index].textContent;
                    contenu = contenu.trim(); 

                    console.log(mdl[index].classList.contains("modifier"));
                    
                    flou.forEach(item => {
                        item.classList.add("actif");
                    });
                    /*  */
                    
                    if(contenu == "Ajouter"){
                        console.log(contenu);

                        setTimeout(function(){
                        ajout.showModal();
                        ajout.classList.add("actif");
                        }, 20); 

                        ClicExtérieur(ajout);

                    }

                    if(mdl[index].classList.contains("modifier")){
                        console.log(contenu);
                        //modification.style.backgroundColor = 'var(--clr)';

                        setTimeout(function(){
                        modification.showModal();
                        modification.classList.add("actif");
                        }, 20); 
                        ClicExtérieur(modification);
                    }

                    if(mdl[index].classList.contains("supprimer")){
                        console.log(contenu);

                        suppression.style.backgroundColor = 'var(--rouge)';
                        suppression.style.color = 'var(--clr2)';
                        setTimeout(function(){
                        suppression.showModal();
                        suppression.classList.add("actif");
                        }, 20); 

                        ClicExtérieur(suppression);
                    }
                    

                    if(mdl[index].classList.contains("encaisser")){
                        console.log(contenu);

                        setTimeout(function(){
                        encaissement.showModal();
                        encaissement.classList.add("actif");
                        }, 20); 

                        ClicExtérieur(encaissement);
                    }
                    

                    if(mdl[index].classList.contains("filtrer")){
                        console.log(contenu);

                        setTimeout(function(){
                        filtre.showModal();
                        filtre.classList.add("actif");
                        }, 20); 

                        ClicExtérieur(filtre);
                    }

                }); 
            });

            //Fermeture des modals
            fermemod.forEach(item => {
                item.addEventListener('click', () => {
                if(item.dataset.closeModal == "0") return;
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

            //Pour fermer le modal en cliquant hors de ce dernier
            function ClicExtérieur(modal_concerne){
                var actif = document.querySelectorAll('.actif');
                    actif.forEach(item => {
                        item.classList.remove("actif");
                    });


                document.addEventListener('click', e => {

                const dialogDimensions = modal_concerne.getBoundingClientRect()
                if (
                    e.clientX < dialogDimensions.left ||
                    e.clientX > dialogDimensions.right ||
                    e.clientY < dialogDimensions.top ||
                    e.clientY > dialogDimensions.bottom
                ) {
                    modal_concerne.classList.remove('actif');
                    
                    modal_concerne.close();
                }
                });
            }

            

            //Fenêtre actif
            var li = document.querySelectorAll('.fntr');
            

            li.forEach( liste => {
                    liste.addEventListener('click', function(){
                        li.forEach(item => {
                            item.classList.remove('actif');
                        });
                        this.classList.add('actif');
                    });
                });


            //Petit message d'erreur sous les inputs
            var erreur = document.querySelectorAll('.erreur');
            var nom = document.getElementById("nom");

            erreur[1].textContent = "A remplir";
            erreur[1].previousElementSibling.style.borderColor = 'var(--rouge)'; 
            erreur[1].previousElementSibling.previousElementSibling.style.color = 'var(--rouge)'; 
            

            
            var droit = document.querySelector('.droit');
            var etape = document.querySelector('.positions');
            var cercles = document.querySelector('.cercles');
            var suivant = document.querySelector('.suivant');
            var precedent= document.querySelector('.annuler');
            var avancer = false;

            var i_1_2_3 = 1;
            
            //Pour éffectuer tous les changements à faire 
            //une fois que l'on passe d'une étape à une autre
            function changement_etape(avancer){
                if(avancer) i_1_2_3++;
                if(!avancer) i_1_2_3--;

                if(i_1_2_3 > 3) i_1_2_3 = 3;
                if(i_1_2_3 < 1) i_1_2_3 = 1;

                if(i_1_2_3 < 3) {
                    suivant.firstChild.textContent = "Suivant";
                    suivant.dataset.closeModal = "0";
                }else{
                    suivant.firstChild.textContent = "Ajouter";
                    suivant.dataset.closeModal = "1";
                }
                if(i_1_2_3 > 1) {
                    precedent.firstChild.textContent = "Précédent";
                    precedent.dataset.closeModal = "0";
                }else{
                    precedent.firstChild.textContent = "Annuler";
                    precedent.dataset.closeModal = "1";
                }
                
                cercles.dataset.etape = i_1_2_3 - 1;
                etape.dataset.etape = i_1_2_3;
                etape.textContent = "etape " + i_1_2_3;
            }

            //Pour changer le texte automatiquement au cas ou
            //le data-close-modal est actif ( égal à "1" )
            if (suivant.dataset.closeModal == "1") {
                suivant.firstChild.textContent = "Ajouter";
            }
            if (precedent.dataset.closeModal == "1") {
                precedent.firstChild.textContent = "Annuler";
            }


            suivant.addEventListener('click', function(){
                suivant.firstChild.dataset.statut = "apres";

                setTimeout(function(){
                    suivant.firstChild.dataset.statut = "avant";
                }, 500);

                setTimeout(function(){
                    suivant.firstChild.dataset.statut = "visible";
                }, 900);
                
                changement_etape(true);
            });

            precedent.addEventListener('click', function(){
                precedent.firstChild.dataset.statut = "avant";

                setTimeout(function(){
                    precedent.firstChild.dataset.statut = "apres";
                }, 500);

                setTimeout(function(){
                    precedent.firstChild.dataset.statut = "visible";
                }, 900);

                changement_etape(false)
            });

            //Pour les champs avec plusieurs choix
            var menu = document.querySelectorAll('.select');
            var option = document.querySelectorAll('.option');

            menu.forEach(element => {
                element.addEventListener('click', () => {
                    element.parentElement.querySelector('.choix').classList.add('ouvert');
                    var option = document.querySelectorAll('.option');
                    option.forEach(item => {
                        item.addEventListener('click', () => {
                            element.value = item.textContent;
                            element.parentElement.querySelector('.choix').classList.remove('ouvert');
                        });
                    });
                });
            });   
            

/*         dialog.addEventListener("click", e => {
            const dialogDimensions = dialog.getBoundingClientRect()
            if (
                e.clientX < dialogDimensions.left ||
                e.clientX > dialogDimensions.right ||
                e.clientY < dialogDimensions.top ||
                e.clientY > dialogDimensions.bottom
            ) {
                ajout.close();
            }
        });   */         
           /*  Script channgment de jour
           
           var jour = new Date;
            var mess = jour.getDay();
            var jours = document.getElementsByTagName('li');
            console.log(mess);

            function aujourdhui(numero = jour.getDay() - 1){
                Array.from(jours).forEach(jrs => {
                    jrs.classList.remove('actif');
                });

                jours[numero].classList.add('actif');
            }

            if(jour.getDay() > 1){
                console.log('on est dans la semaine');
                aujourdhui();
            }else{
                console.log('on est pas dans la semaine');
            }
 */
            
  


     </script>
</body>

</html>