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
    <link rel="stylesheet" href="assetsCFPT/css/Login.css">
    @vite('resources/js/app.js')


</head>
<body id="app" >

{{--   <div class="chargement">
    <div class="roue">
      <div class="roue">
        <div class="roue"></div>
      </div>
    </div>
    <p>Encore un petit instant...</p>
  </div> --}}
    
    {{-- Logo CFPT --}}
    <img class="logo-cfpt" src="/assetsCFPT/image/logo_cfpt_bleu.png" alt="CFPT">
  

  <h1 class="titre">Bienvenue au</h1>
  
    <h1 class="gros_titre" >CFPT Senegal-Japon</h1>

      <user-login></user-login>


    </div>

{{-- <script>
  const chargement = document.querySelector('.chargement');
          window.addEventListener('load', () => {
            chargement.classList.add('disparition');
          });
</script> --}}
</body>
</html>