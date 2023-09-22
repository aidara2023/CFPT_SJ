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
    <link rel="stylesheet" href="/pages_web/Users/mac6/Desktop/Pages/pages_web/CSS/liste_note.css">
    <title>Liste Etudiants</title>
</head>
<body>



<div class="entete">
    <img class="grande" src="professeur.png" alt="">
    <div class="info">
        <h1 class="titre" >Amadou GUEYE</h1>
        <h1 class="sous_titre">Professeur</h1>
      </div>
      <div class="menu"><!-- concerne uniquement le bouton -->
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="fenetre"></div>
      <!-- <div class="arrondi"></div> -->
      <div class="navigation">

        <ul>
            <li>
                <span class="icon"><i class="fi fi-rr-user"></i></span>
                <hr>
                <a href="#">
                    <span>Mon Profil</span></a></li>
            <li>
                <a href="#">
                    <span>Modifier mot de passe</span></a></li>
                    <li>
                        <span class="icon"><i class="fi fi-rr-info"></i></span>
                        <hr>
                    <a href="#">
                    <span>A propos du CFPT-SJ</span></a></li>
            <li>
                <a href="#">
                    <span>Me déconnecter</span></a></li>
        </ul>

      </div>
    </div>

    <section>
        <div class="bloc">
            <a href="#" class="cercle"> <!-- Bouton retour -->
                <i class="fi fi-rr-angle-small-right"></i>
            </a>
            <h1 class="classe sous_titre b">BTS IIR 2 <span class="matiere sous_titre">Programmation</span></h1>
        <a href="#">
                <button class="sous_titre ajout">Valider
                </button>
            </a>
        </div>
        <div class="sections">
            <div class="etudiant">
                <img src="etudiant.png" alt="Etu" class="petite">
                <p class="texte">Abdoulaye SARR</p>
                <form method="" action="" class="notes">
                    <input type="number" inputmode="numeric" name="note1" id="note1" placeholder="17">
                    <input type="number" inputmode="numeric" name="note2" id="note2" placeholder="14">
                    <input type="number" inputmode="numeric" name="note3" id="note3" placeholder="20">
                </form>

            </div>
            
     </div>
    </section>





<script>
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
</script>
</body>
</html>