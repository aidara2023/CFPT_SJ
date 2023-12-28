document.addEventListener("DOMContentLoaded", function()  {

    var flou = document.querySelectorAll('.flou');
    
    var mdl = document.querySelectorAll('.mdl');
    var onglet = document.querySelectorAll("[data-fenetre]");

    onglet.forEach(item => {
        item.addEventListener('click', function(){
            onglet.forEach(item => {
                item.dataset.fenetre = "";
            })
            this.dataset.fenetre = "actif";
        })
    })

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

               

            }

            if(mdl[index].classList.contains("modifier")){
                console.log(contenu);
                //modification.style.backgroundColor = 'var(--clr)';

                setTimeout(function(){
                modification.showModal();
                modification.classList.add("actif");
                }, 20); 
               
            }

            if(mdl[index].classList.contains("supprimer")){
                console.log(contenu);

                //suppression.style.backgroundColor = 'var(--rouge)';
                suppression.style.color = 'var(--clr2)';
                setTimeout(function(){
                suppression.showModal();
                suppression.classList.add("actif");
                }, 20); 

                
            }
            

            if(mdl[index].classList.contains("encaisser")){
                console.log(contenu);

                setTimeout(function(){
                encaissement.showModal();
                encaissement.classList.add("actif");
                }, 20); 

               
            }
            

            if(mdl[index].classList.contains("filtrer")){
                console.log(contenu);

                setTimeout(function(){
                filtre.showModal();
                filtre.classList.add("actif");
                }, 20); 

               
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
       /*      function ClicExtérieur(modal_concerne){
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
            } */

            

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
            
            document.addEventListener("DOMContentLoaded", function () {
                // Écoutez le clic sur l'image
                document.getElementById("dropdown-trigger").addEventListener("click", function () {
                    // Obtenez le menu déroulant
                    var dropdownContent = document.querySelector(".dropdown-content");
            
                    // Inversez l'état d'affichage du menu déroulant
                    if (dropdownContent.style.display === "none" || dropdownContent.style.display === "") {
                        dropdownContent.style.display = "block";
                    } else {
                        dropdownContent.style.display = "none";
                    }
                });
            });

            var actions = document.querySelector('.boutons_actions');
            var fleche = document.querySelector('.fi-rr-angle-small-left').parentElement;
    
            /* Une fois la souris dessus, le menu qui contient les boutons d'actions va s'ouvrir */
            fleche.addEventListener('mouseover', () => {
                actions.classList.toggle('actif');
            });
            fleche.addEventListener('mouseleave', () => {
                actions.classList.toggle('actif');
            });

     // Initialisez vos graphiques ici en utilisant une bibliothèque comme Chart.js
     var ctx = document.getElementById("myChart").getContext("2d");
     var myChart = new Chart(ctx, {
         type: "bar", // ou un autre type de graphique
         data: {
             labels: ["Janvier", "Février", "Mars", "Avril", "Mai"],
             datasets: [
                 {
                     label: "Nombre de données",
                     data: [12, 19, 3, 5, 2],
                     backgroundColor: "rgba(75, 192, 192, 0.2)",
                     borderColor: "rgba(75, 192, 192, 1)",
                     borderWidth: 1,
                 },
             ],
         },
         options: {
             scales: {
                 y: {
                     beginAtZero: true,
                 },
             },
         },
     });
});


