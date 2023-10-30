document.addEventListener("DOMContentLoaded", function()  {
    var fond = document.querySelector('.fond');
    var flou = document.querySelectorAll('.flou');

    var mdl = document.querySelectorAll('.mdl');

    var contenu = "";

    //Nouveaux types de modal
    var ajout = document.querySelector("[data-modal-ajout]");
    var modification = document.querySelector("[data-modal-modification]");
    var suppression = document.querySelector("[data-modal-suppression]");


    var fermemod = document.querySelectorAll('[data-close-modal]');
<<<<<<< HEAD
    var fermemod_class = document.querySelectorAll('.data-close-modal');
=======

>>>>>>> c6201005c5d04f5d916cee9d3e700c336370ecb1
    var bouton_fermeture = document.querySelectorAll('.fermer');



    mdl.forEach(item => {
        item.addEventListener('click', function(){
            var index = Array.from(mdl).indexOf(this);
            contenu = mdl[index].textContent;
            contenu = contenu.trim(); 

            /* console.log(mdl[index].classList.contains("modifier")); */
            
            flou.forEach(item => {
                item.classList.add("actif");
            });
            fond.classList.add("actif");
            
            if(contenu == "Ajouter"){
                /* console.log(contenu); */

                setTimeout(function(){
                ajout.showModal();
                ajout.classList.add("actif");
                }, 20); 
            }

            if(mdl[index].classList.contains("modifier")){
                /* console.log(contenu); */
                //modification.style.backgroundColor = 'var(--clr)';

                setTimeout(function(){
                modification.showModal();
                modification.classList.add("actif");
                }, 20); 
            }

            if(mdl[index].classList.contains("supprimer")){
                console.log(contenu);

                suppression.style.backgroundColor = 'var(--rouge)';
                suppression.style.color = 'var(--clr2)';
                setTimeout(function(){
                suppression.showModal();
                suppression.classList.add("actif");
                }, 20); 
            }
        });
        });

    //Fermeture des modals
    fermemod.forEach(item => {
        item.addEventListener('click', () => {
            //console.log(fermemod[0].textContent);
        var actif = document.querySelectorAll('.actif');
            actif.forEach(item => {
                item.classList.remove("actif");
            });
                ajout.close();
                modification.close();
                suppression.close();

    })
    });
    fermemod_class.forEach(item => {
        item.addEventListener('click', () => {
            //console.log(fermemod[0].textContent);
        var actif = document.querySelectorAll('.actif');
            actif.forEach(item => {
                item.classList.remove("actif");
            });
                ajout.close();
                modification.close();
                suppression.close();

    })
    });
    bouton_fermeture.forEach(item => {
        item.addEventListener('click', () => {
            //console.log(fermemod[0].textContent);
        var actif = document.querySelectorAll('.actif');
            actif.forEach(item => {
                item.classList.remove("actif");
            });
                ajout.close();
                modification.close();
                suppression.close();

    })
    });

    bouton_fermeture.forEach(item => {
        item.addEventListener('click', () => {
            //console.log(fermemod[0].textContent);
        var actif = document.querySelectorAll('.actif');
            actif.forEach(item => {
                item.classList.remove("actif");
            });
                ajout.close();
                modification.close();
                suppression.close();

    })
    });

    //Fenêtre actif
    var li = document.querySelectorAll('.fntr');
    console.log(li);

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


   /*   erreur[1].textContent = "A remplir"; //Message à afficher */
    /*  erreur[1].previousElementSibling.style.borderColor = 'red'; */  //Trait rouge

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



