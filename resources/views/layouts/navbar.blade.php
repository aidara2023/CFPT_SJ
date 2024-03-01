@if (Auth::user())
    @if (Auth::user()->id_role == 3)
        <div class="sidebar-container">
            <div class="sidemenu-container navbar-collapse collapse fixed-menu">
                <div id="remove-scroll" class="left-sidemenu">
                    <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false"
                        data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>
                        <li class="sidebar-user-panel">
                            <div class="sidebar-user">
                                <div class="sidebar-user-picture">
                                    <img alt="image" src="{{ asset('/storage/' . Auth::user()->photo) }}">
                                </div>
                                <div class="sidebar-user-details">
                                    <div class="user-name">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</div>
                                    <div class="user-role">@yield('fonction')</div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item start active open">
                            <a href="{{ route('admin_index') }}" class="nav-link nav-toggle">
                                <i data-feather="airplay"></i>
                                <span class="title">Tableau de Bord</span>
                                <span class="selected"></span>
                               
                            </a>
                           
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link nav-toggle"> <i data-feather="user"></i>
                                <span class="title">Utilisateurs</span> <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('utilisateur_index') }}" class="nav-link "> <span
                                            class="title">Liste Utilisateur</span>
                                    </a>
                                </li>
                               
                                <li class="nav-item">
                                    <a href="{{ route('utilisateur_create') }}" class="nav-link "> <span
                                            class="title">Nouvel Utilisateur</span>
                                    </a>
                                </li> :
                               
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('liste_inscription') }}" class="nav-link nav-toggle"> <i
                                    data-feather="calendar"></i>
                                <span class="title">Inscription</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link nav-toggle"><i data-feather="users"></i>
                                <span class="title">Paramétres</span><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('direction_accueil') }}" class="nav-link "> <span
                                            class="title">Direction</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('service_accueil') }}" class="nav-link "> <span
                                            class="title">Service</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('departement_index') }}" class="nav-link "> <span
                                            class="title">Département</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('unite_de_formation_index') }}" class="nav-link "> <span
                                            class="title">Filière</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('type_formation_index') }}" class="nav-link "> <span
                                            class="title">Type Formation</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('classe_index') }}" class="nav-link "> <span
                                            class="title">Classe</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('batiment_accueil') }}" class="nav-link "> <span
                                            class="title">Batiment</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('salle_accueil') }}"class="nav-link "> <span
                                            class="title">Salle</span>
                                    </a>
                                </li>
                               
                            </ul>
                        </li>
                      
                        <li class="nav-item">

                            <a href="{{ route('logout') }}" class="nav-link nav-toggle"> <i class="icon-logout"></i>
                                <span class="title">Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if (Auth::user()->id_role == 7)
        <div class="sidebar-container">
            <div class="sidemenu-container navbar-collapse collapse fixed-menu">
                <div id="remove-scroll" class="left-sidemenu">
                    <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false"
                        data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>
                        <li class="sidebar-user-panel">
                            <div class="sidebar-user">
                                <div class="sidebar-user-picture">
                                    <img alt="image" src="{{ asset('/storage/' . Auth::user()->photo) }}">
                                </div>
                                <div class="sidebar-user-details">
                                    <div class="user-name">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</div>
                                    <div class="user-role">@yield('fonction')</div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item start active open">
                            <a href="{{ route('admin_index') }}" class="nav-link nav-toggle">
                                <i data-feather="airplay"></i>
                                <span class="title">Tableau de Bord</span>
                                <span class="selected"></span>
                                {{-- <span class="arrow open"></span> --}}
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item active">
                                    <a href="index.html" class="nav-link ">
                                        <span class="title">Dashboard</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link nav-toggle"> <i data-feather="user"></i>
                                <span class="title">Livre</span> <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('livre_index') }}" class="nav-link "> <span
                                            class="title">Liste Livre</span>
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="{{ route('livre_create') }}" class="nav-link "> <span
                                            class="title">Nouveau livre</span>
                                    </a>
                                </li>

                            </ul>

                            <a href="#" class="nav-link nav-toggle"> <i data-feather="user"></i>
                                <span class="title">Livre Emprunter</span> <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('emprunter_livre_index') }}" class="nav-link "> <span
                                            class="title">Liste des livres emprunter</span>
                                    </a>
                                </li>
                               
                                <li class="nav-item">
                                    <a href="{{ route('emprunter_livre_create') }}" class="nav-link "> <span
                                            class="title">Nouveau demande livre</span>
                                    </a>
                                </li>
                            </ul>

                        </li>

                      
                        <li class="nav-item">

                            <a href="/auteur/accueil" class="nav-link "> <span
                                    class="title">Auteur</span>
                            </a>
                        </li>


                            <a href="#" class="nav-link nav-toggle"><i data-feather="users"></i>
                                <span class="title">Paramétres</span><span class="arrow"></span></a>

                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('rayon_accueil') }}" class="nav-link "> 
                                    <span class="title">Rayon</span>
                                    </a>
                                </li>
                               
                                <li class="nav-item">
                                    <a href="{{ route('categorie_accueil') }}" class="nav-link "> <span
                                            class="title">Categorie</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/auteur/create" class="nav-link "> <span
                                            class="title">Auteur</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/editeur/create" class="nav-link "> <span
                                            class="title">Editeur</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/edition/create" class="nav-link "> <span
                                            class="title">Edition</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">

                            <a href="{{ route('logout') }}" class="nav-link nav-toggle"> <i class="icon-logout"></i>
                                <span class="title">Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if (Auth::user()->id_role == 4)
        <div class="sidebar-container">
          
            <div class="sidemenu-container navbar-collapse collapse fixed-menu">
                <div id="remove-scroll" class="left-sidemenu">
                    <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false"
                        data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>
                        <li class="sidebar-user-panel">
                            <div class="sidebar-user">
                                <div class="sidebar-user-picture">
                                    <img alt="image" src="{{ asset('/storage/' . Auth::user()->photo) }}">
                                </div>
                                <div class="sidebar-user-details">
                                    <div class="user-name">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</div>
                                    <div class="user-role">@yield('fonction')</div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item start active open">
                            <a href="{{ route('caissier_accueil') }}" class="nav-link nav-toggle">
                                <i data-feather="airplay"></i>
                                <span class="title">Tableau de Bord</span>
                                <span class="selected"></span>
                                {{-- <span class="arrow open"></span> --}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('validation_inscription') }}" class="nav-link nav-toggle"> <i
                                    data-feather="user"></i>
                                <span class="title">Valider Inscription</span> 
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('paiement_accueil') }}" class="nav-link nav-toggle"> <i
                                    data-feather="user"></i>
                                <span class="title">Paiement</span> 
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('recouvrement_index') }}" class="nav-link nav-toggle"><i
                                    data-feather="users"></i>
                                <span class="title">Récouvrement</span>
                            </a>
                        </li>

                        <li class="nav-item">

                            <a href="{{ route('logout') }}" class="nav-link nav-toggle"> <i class="icon-logout"></i>
                                <span class="title">Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif


    @if (Auth::user()->id_role == 12)
    <div class="sidebar-container">
      
        <div class="sidemenu-container navbar-collapse collapse fixed-menu">
            <div id="remove-scroll" class="left-sidemenu">
                <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false"
                    data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <li class="sidebar-user-panel">
                        <div class="sidebar-user">
                            <div class="sidebar-user-picture">
                                <img alt="image" src="{{ asset('/storage/' . Auth::user()->photo) }}">
                            </div>
                            <div class="sidebar-user-details">
                                <div class="user-name">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</div>
                                <div class="user-role">@yield('fonction')</div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item start active open">
                        <a href="{{ route('caissier_accueil') }}" class="nav-link nav-toggle">
                            <i data-feather="airplay"></i>
                            <span class="title">Tableau de Bord</span>
                            <span class="selected"></span>
                            {{-- <span class="arrow open"></span> --}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('liste_inscription') }}" class="nav-link nav-toggle"> <i
                                data-feather="user"></i>
                            <span class="title"> Inscription</span> 
                        </a>
                    </li>

                    <li class="nav-item">

                        <a href="{{ route('logout') }}" class="nav-link nav-toggle"> <i class="icon-logout"></i>
                            <span class="title">Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif
@endif