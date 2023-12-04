document.addEventListener("DOMContentLoaded", function()  {

    var flou = document.querySelectorAll('.flou');
            
    var mdl = document.querySelectorAll('.mdl');
            //Nouveaux types de modal
            var ajout = document.querySelector("[data-modal-ajout]");
            var modification = document.querySelector("[data-modal-modification]");
            var suppression = document.querySelector("[data-modal-suppression]");
            var encaissement = document.querySelector("[data-modal-encaissement]");
            var filtre = document.querySelector("[data-modal-filtre]");


            var droit = document.querySelector('.droit');
            var etape = document.querySelector('.positions');
            var cercles = document.querySelector('.cercles');
            var suivant = document.querySelector('.suivant');
            var precedent= document.querySelector('.annuler');
            var avancer = false;

            var i_1_2_3 = 1;
            

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
                alert(item.dataset.closeModal);

                if(item.dataset.closeModal == "0") {
                    alert("Suivant");
                    return;
                }
                var actif = document.querySelectorAll('.actif');
                    actif.forEach(item => {
                        item.classList.remove("actif");
                    });
                        ajout.close();
                        modification.close();
                        suppression.close();/* 
                        filtre.close();
                        encaissement.close(); */
                    
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
/* 
            erreur[1].textContent = "A remplir";
            erreur[1].previousElementSibling.style.borderColor = 'var(--rouge)'; 
            erreur[1].previousElementSibling.previousElementSibling.style.color = 'var(--rouge)';  */
            
            
            erreur.forEach(item => {
                item.addEventListener('onchange', () => {
                    if(item.textContent){
                        item.previousElementSibling.style.borderColor = 'var(--rouge)'; 
                        item.previousElementSibling.previousElementSibling.style.color = 'var(--rouge)'; 
                    }else{
                        item.previousElementSibling.style.borderColor = ''; 
                        item.previousElementSibling.previousElementSibling.style.color = ''; 
                    }
                });
            });
            
            erreur.forEach(item => {
              
                    if(item.textContent){
                        item.previousElementSibling.style.borderColor = 'var(--rouge)'; 
                        item.previousElementSibling.previousElementSibling.style.color = 'var(--rouge)'; 
                    }else{
                        item.previousElementSibling.style.borderColor = ''; 
                        item.previousElementSibling.previousElementSibling.style.color = ''; 
                    }
               
            });

           



            
            
           /*  //Pour éffectuer tous les changements à faire 
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
 */
            //Pour changer le texte automatiquement au cas ou
            //le data-close-modal est actif ( égal à "1" )
/*             if (suivant.dataset.closeModal == "1") {
                suivant.firstChild.textContent = "Ajouter";
            }
            if (precedent.dataset.closeModal == "1") {
                precedent.firstChild.textContent = "Annuler";
            } */

/* 
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
 */
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
            
  

    
});



// Script channgment de jour

// var jour = new Date;
// var mess = jour.getDay();
// var jours = document.getElementsByTagName('li');
// console.log(mess);

// function aujourdhui(numero = jour.getDay() - 1){
//     Array.from(jours).forEach(jrs => {
//         jrs.classList.remove('actif');
//     });

//     jours[numero].classList.add('actif');
// }

// if(jour.getDay() > 1){
//     console.log('on est dans la semaine');
//     aujourdhui();
// }else{
//     console.log('on est pas dans la semaine');
// }



