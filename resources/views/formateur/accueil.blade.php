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
    <link rel="stylesheet" href="/assetsCFPT/css/accueil_professeur.css">
    <title>Accueil</title>
    @vite('resources/js/app.js')
</head>
<body>



<div class="entete">
    @include('formateur.entete')

    <div class="emploi_du_temps" id="app">
        <h1 class="sous_titre">Emploi du temps</h1>
        <accueil-formateur></accueil-formateur>

    </div>


    @include('formateur.section')




<script src="assetsCFPT/js/formateur.js"></script>



</body>
</html>