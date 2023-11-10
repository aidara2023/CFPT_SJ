@if (Auth::user()->id_role==5)
<div class="entete">
    <h1 class="titre">Administrateur</h1>
    <div class="bloc">
        <h1 class="sous_titre">@yield('page')</h1>
    <div class="recherche">
        <i class="fi fi-rr-search"></i>
        <input  type="text" name="" placeholder="Rechercher un utilisateur">
    </div>
    </div>
</div>
@endif


@if (Auth::user()->id_role==1)
<div class="entete">
    <h1 class="titre">Eleve</h1>
    <div class="bloc">
        <h1 class="sous_titre">@yield('page')</h1>
    <div class="recherche">
        <i class="fi fi-rr-search"></i>
        <input  type="text" name="" placeholder="Rechercher">
    </div>
    </div>
</div>
@endif


@if (Auth::user()->id_role==2)
    <div class="entete">
        <h1 class="titre">Tuteur</h1>
        <div class="bloc">
            <h1 class="sous_titre">@yield('page')</h1>
        <div class="recherche">
            <i class="fi fi-rr-search"></i>
            <input  type="text" name="" placeholder="Rechercher">
        </div>
        </div>
    </div>
@endif


@if (Auth::user()->id_role==3)
    <div class="entete">
        <h1 class="titre">Bibliothécaire</h1>
        <div class="bloc">
            <h1 class="sous_titre">@yield('page')</h1>
        <div class="recherche">
            <i class="fi fi-rr-search"></i>
            <input  type="text" name="" placeholder="Rechercher">
        </div>
        </div>
    </div>
@endif


@if (Auth::user()->id_role==4)
    <div class="entete">
        <h1 class="titre">Caissiere</h1>
        <div class="bloc">
            <h1 class="sous_titre">@yield('page')</h1>
        <div class="recherche">
            <i class="fi fi-rr-search"></i>
            <input  type="text" name="" placeholder="Rechercher">
        </div>
        </div>
    </div>
@endif


@if (Auth::user()->id_role==6)
    <div class="entete">
        <h1 class="titre">Formateur</h1>
        <div class="bloc">
            <h1 class="sous_titre">@yield('page')</h1>
        <div class="recherche">
            <i class="fi fi-rr-search"></i>
            <input  type="text" name="" placeholder="Rechercher">
        </div>
        </div>
    </div>
@endif


@if (Auth::user()->id_role==7)
    <div class="entete">
        <h1 class="titre">Infirmier</h1>
        <div class="bloc">
            <h1 class="sous_titre">@yield('page')</h1>
        <div class="recherche">
            <i class="fi fi-rr-search"></i>
            <input  type="text" name="" placeholder="Rechercher">
        </div>
        </div>
    </div>
@endif


@if (Auth::user()->id_role==9)
    <div class="entete">
        <h1 class="titre">Comptable</h1>
        <div class="bloc">
            <h1 class="sous_titre">@yield('page')</h1>
        <div class="recherche">
            <i class="fi fi-rr-search"></i>
            <input  type="text" name="" placeholder="Rechercher">
        </div>
        </div>
    </div>
@endif
