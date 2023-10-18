
    /*    A ajouter
    le mouvement de l'indicateur en fonction des jours 
    
    */
    const list = document.querySelectorAll('.et');
    function aujourdhui(){
        list.forEach((item) => item.classList.remove('active'));
        this.classList.add('active');
    }
    list.forEach((item) => item.addEventListener('click', aujourdhui));

    let boutonMenu = document.querySelector('.menu');
    let titre = document.querySelector('.titre');
    let St = document.querySelector('.sous_titre');
    var couleur = 'linear-gradient(109deg ,white 50%, var(--clr))';
    var couleurSt = 'white';
    boutonMenu.onclick = function(){
        boutonMenu.classList.toggle('active');
        titre.style.backgroundImage = couleur;
        St.style.color = couleurSt;

        if(couleur == 'linear-gradient(109deg ,var(--clr2) 50%, var(--clr))'){
            couleur = 'linear-gradient(109deg ,white 50%, var(--clr))';
        }else{
            couleur = 'linear-gradient(109deg ,var(--clr2) 50%, var(--clr))';
        }
        if(couleurSt == 'white'){
            couleurSt = 'black';
        }else{
            couleurSt = 'white';
        }
    }
