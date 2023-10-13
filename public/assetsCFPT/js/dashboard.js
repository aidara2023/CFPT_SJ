var fond = document.querySelector('.fond');
var flou = document.querySelectorAll('.flou');

var mdl = document.querySelectorAll('.mdl');
var contenu = "";

//Nouveaux types de modal
var ajout = document.querySelector("[data-modal-ajout]");
var modification = document.querySelector("[data-modal-modification]");
var suppression = document.querySelector("[data-modal-suppression]");


var fermemod = document.querySelectorAll('[data-close-modal]');     
    

// Ouverture des modals
 mdl.forEach(item => {
    item.addEventListener('click', function(){
        var index = Array.from(mdl).indexOf(this);
        contenu = mdl[index].textContent;
        contenu = contenu.trim(); 

        console.log(contenu == "Modifier")
        
        flou.forEach(item => {
            item.classList.add("actif");
        });
        fond.classList.add("actif");
        
        if(contenu == "Ajouter"){
            console.log(contenu);

            setTimeout(function(){
            ajout.showModal();
            ajout.classList.add("actif");
            }, 20); 
        }

        if(contenu == "Modifier"){
            console.log(contenu);
            //modification.style.backgroundColor = 'var(--clr)';

            setTimeout(function(){
            modification.showModal();
            modification.classList.add("actif");
            }, 20); 
        }

        if(contenu == "Supprimer"){
            console.log(contenu);

            suppression.style.backgroundColor = 'var(--rouge)';
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


