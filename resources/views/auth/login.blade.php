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
    <link rel="stylesheet" href="/assetsCFPT/css/admin.css">
 <link rel="stylesheet" href="assetsCFPT/css/Login2.css">
  @vite('resources/js/app.js')
 </head>
<body id="app">
  {{-- <div class="chargement">
    <div class="roue">
      <div class="roue">
        <div class="roue"></div>
      </div>
    </div>
    <p>Encore un petit instant...</p>
  </div> --}}

  
    <div class="partie accueil">
      <img class="logo-cfpt" src="/assetsCFPT/image/logoCFPT--clr.png" alt="">
      <h3>Bienvenue sur</h3>
      <h1>CFPT Digital</h1>
    </div>

    <div class="partie connexion">
      <img src="/assetsCFPT/image/logoCFPT--clr_plus_clair.png" alt="">
        {{-- <form class="" action="" method="">
          <h1>connexion</h1>

          <div class="informations">

          
            <div class="champ">
              <label for="matricule"><span >Matricule</span></label>
              <input type="text" id="matricule" name="matricule">
            </div>
            <div class="champ">
              <label for="mdp">Mot de passe</label>
              <input type="password" id="mdp" name="mdp">
            </div>

          </div>
            <div class="groupe_champs">
              <p class="b">Informations erronées</p>
              <button type="submit" data-close-modal="0" class="suivant réessayer"><span data-statut="visible"> Je me connecte</span></button>
              <button type="submit" class="mdp_oublie"><span data-statut="visible">Mot de passe oublié ?</span></button>
            </div>
        </form> --}}
         <user-login></user-login>

      </div>

        <script>
          const chargement = document.querySelector('.chargement');
          window.addEventListener('load', () => {
            chargement.classList.add('disparition');
          });

            var suivant = document.querySelector('.suivant')
            //Pour éffectuer tous les changements à faire 
            //une fois que l'on passe d'une étape à une autre
            function changement_etape(avancer){
                    //suivant.innerHTML = "<span data-statut='visible'> Vérification</span><div class='roue'></div>";

                    suivant.innerHTML = "<span data-statut='visible'>Réessayer</span>";
                    suivant.previousElementSibling.style.color = "var(--rouge)";
                    suivant.style.backgroundColor = "var(--rouge)";
                    suivant.style.color = "white";
                
            }

            suivant.addEventListener('click', function(){
                suivant.firstChild.dataset.statut = "apres";

                setTimeout(function(){
                    suivant.firstChild.dataset.statut = "avant";
                }, 700);

                setTimeout(function(){
                    suivant.firstChild.dataset.statut = "visible";
                }, 1000);
                
                setTimeout(function(){
                  changement_etape(true);
                }, 1600);
                
            });


        </script>
</body>
</html>