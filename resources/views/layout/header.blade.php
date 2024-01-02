@if (Auth::user()->id_role==3)
{{-- <div class="entete">
    <h1 class="titre">Administrateur</h1>
    <div class="bloc">
        <h1 class="sous_titre">Utilisateurs</h1>
    <div class="recherche">
        <i class="fi fi-rr-search"></i>
        <input  type="text" name="" placeholder="Rechercher un utilisateur">
    </div>
    </div>
</div> --}}

<div class="haut_de_page">

    <div class="logo">
        <img src="/assetsCFPT/image/logo_cfpt_bleu.png" alt="" class="moyenne_taille">
    </div>

     <liste-alerte></liste-alerte>
    
    <div class="profil">
        <div class="image-container">
            <img src="/assetsCFPT/image/etudiant.png" alt="" class="moyenne_taille"
                id="dropdown-trigger">
            <!-- Dropdown menu -->
            <div class="dropdown-content">
                <a href="#">Mon profil</a>
                <a href="{{ route('logout') }}">Me déconnecter</a>
            </div>
        </div>
    </div>
</div>

<h1 class="grand_ecran_seulement">Tableau de bord</h1>
@endif


@if (Auth::user()->id_role==1)

<liste-alerte></liste-alerte>
<div class="haut_de_page">
    <div class="logo">
        <img src="/assetsCFPT/image/logo_cfpt_bleu.png" alt="" class="moyenne_taille">
    </div>

    <div class="profil">
        <div class="image-container">
            <img src="/assetsCFPT/image/etudiant.png" alt="" class="moyenne_taille mdl"
                id="dropdown-trigger">
            <!-- Dropdown menu -->
            <div class="dropdown-content">
                <a href="#">Mon profil</a>
                <a href="{{ route('logout') }}">Me déconnecter</a>
            </div>
        </div>
    </div>
</div>

<h1 class="grand_ecran_seulement">Eleve</h1>
@endif


@if (Auth::user()->id_role==11)
<div class="haut_de_page">
    <div class="logo">
        <img src="/assetsCFPT/image/logo_cfpt_bleu.png" alt="" class="moyenne_taille">
    </div>

    <div class="profil">
        <div class="image-container">
            <img src="/assetsCFPT/image/etudiant.png" alt="" class="moyenne_taille mdl"
                id="dropdown-trigger">
            <!-- Dropdown menu -->
            <div class="dropdown-content">
                <a href="#">Mon profil</a>
                <a href="{{ route('logout') }}">Me déconnecter</a>
            </div>
        </div>
    </div>
</div>

<h1 class="grand_ecran_seulement">Tuteur</h1>
@endif


 @if (Auth::user()->id_role==7)
 <div class="haut_de_page">
    <div class="logo">
        <img src="/assetsCFPT/image/logo_cfpt_bleu.png" alt="" class="moyenne_taille">
    </div>

    <div class="profil">
        <div class="image-container">
            <img src="/assetsCFPT/image/etudiant.png" alt="" class="moyenne_taille mdl"
                id="dropdown-trigger">
            <!-- Dropdown menu -->
            <div class="dropdown-content">
                <a href="#">Mon profil</a>
                <a href="{{ route('logout') }}">Me déconnecter</a>
            </div>
        </div>
    </div>
</div>

<h1 class="grand_ecran_seulement">Bibliothecaire</h1>
    
@endif



 @if (Auth::user()->id_role==4)
 <div class="haut_de_page">
    <div class="logo">
        <img src="/assetsCFPT/image/logo_cfpt_bleu.png" alt="" class="moyenne_taille">
    </div>

    <div class="profil">
        <div class="image-container">
            <img src="/assetsCFPT/image/etudiant.png" alt="" class="moyenne_taille mdl"
                id="dropdown-trigger">
            <!-- Dropdown menu -->
            <div class="dropdown-content">
                <a href="#">Mon profil</a>
                <a href="{{ route('logout') }}">Me déconnecter</a>
            </div>
        </div>
    </div>
</div>

<h1 class="grand_ecran_seulement">Caissier</h1>
   
@endif


@if (Auth::user()->id_role==2)
<div class="haut_de_page">
    <div class="logo">
        <img src="/assetsCFPT/image/logo_cfpt_bleu.png" alt="" class="moyenne_taille">
    </div>

    <div class="profil">
        <div class="image-container">
            <img src="/assetsCFPT/image/etudiant.png" alt="" class="moyenne_taille mdl"
                id="dropdown-trigger">
            <!-- Dropdown menu -->
            <div class="dropdown-content">
                <a href="#">Mon profil</a>
                <a href="{{ route('logout') }}">Me déconnecter</a>
            </div>
        </div>
    </div>
</div>

<h1 class="grand_ecran_seulement">Formateur</h1>
@endif



 @if (Auth::user()->id_role==6)
    
 <div class="haut_de_page">
    <div class="logo">
        <img src="/assetsCFPT/image/logo_cfpt_bleu.png" alt="" class="moyenne_taille">
    </div>

    <div class="profil">
        <div class="image-container">
            <img src="/assetsCFPT/image/etudiant.png" alt="" class="moyenne_taille mdl"
                id="dropdown-trigger">
            <!-- Dropdown menu -->
            <div class="dropdown-content">
                <a href="#">Mon profil</a>
                <a href="{{ route('logout') }}">Me déconnecter</a>
            </div>
        </div>
    </div>
</div>

<h1 class="grand_ecran_seulement">Infirmier</h1>
@endif



 @if (Auth::user()->id_role==5)
 <div class="haut_de_page">
    <div class="logo">
        <img src="/assetsCFPT/image/logo_cfpt_bleu.png" alt="" class="moyenne_taille">
    </div>

    <div class="profil">
        <div class="image-container">
            <img src="/assetsCFPT/image/etudiant.png" alt="" class="moyenne_taille mdl"
                id="dropdown-trigger">
            <!-- Dropdown menu -->
            <div class="dropdown-content">
                <a href="#">Mon profil</a>
                <a href="{{ route('logout') }}">Me déconnecter</a>
            </div>
        </div>
    </div>
</div>

<h1 class="grand_ecran_seulement">Comptable</h1>
   
@endif
