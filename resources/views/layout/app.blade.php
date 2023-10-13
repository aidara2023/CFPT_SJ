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
    <link rel="stylesheet" href="/assetsCFPT/css/admin.css">
    <title>Utilisateurs</title>
    @vite('resources/js/app.js')
</head>
<body>
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
     

        
    @include('layout.left_bar')

   @yield('content')

  
     <script src="/assetsCFPT/js/dashboard.js"></script>
</body>

</html>