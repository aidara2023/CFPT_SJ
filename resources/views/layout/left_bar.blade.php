@if (Auth::user())
    @if (Auth::user()->id_role==5)
        <nav class="flou">
            <ul>
                <li class="fntr actif"><a href="#"><i class="fi fi-rr-home"></i><span>Accueil</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-user"></i><span >Utilisateurs</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-graduation-cap"></i><span>Gestion pédagogique</span></a></li>
                <li class="fntr"><a href="{{route('eleve_inscription')}}"><i class="fi fi-rr-graduation-cap"></i><span>Inscription</span></a></li>
                <li class="fntr"><a href="{{route('paiement_create')}}"><i class="fi fi-rr-money-bill-wave"></i><span>Paiements</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-book-bookmark"></i><span>Bibliothèque</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rs-pharmacy"></i><span>Infirmerie</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-building"></i><span>Partenariats</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-tool-box"></i><span>Matériel</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-folder-minus"></i><span>Archives</span></a></li>
                <li class="fntr"><a href="{{route('logout')}}"><i class="fi fi-rr-sign-out-alt"></i><span>Me déconnecter</span></a></li>
            </ul>
        </nav>
    @endif
    @if (Auth::user()->id_role==9)
        <nav class="flou">
            <ul>
                <li class="fntr actif"><a href="#"><i class="fi fi-rr-home"></i><span>Accueil</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-user"></i><span >Inscription</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-graduation-cap"></i><span>Bulletin</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-graduation-cap"></i><span>Attestation</span></a></li>
                <li class="fntr"><a href="{{route('logout')}}"><i class="fi fi-rr-sign-out-alt"></i><span>Me déconnecter</span></a></li>
            </ul>
        </nav>
    @endif
    @if (Auth::user()->id_role==4)
        <nav class="flou">
            <ul>
                <li class="fntr actif"><a href="#"><i class="fi fi-rr-home"></i><span>Accueil</span></a></li>
                <li class="fntr"><a href="{{route('paiement_create')}}"><i class="fi fi-rr-user"></i><span >Paiement</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-graduation-cap"></i><span>Inscription</span></a></li>

                <li class="fntr"><a href="{{route('logout')}}"><i class="fi fi-rr-sign-out-alt"></i><span>Me déconnecter</span></a></li>
            </ul>
        </nav>
    @endif

    @if (Auth::user()->id_role==10)
        <nav class="flou">
            <ul>
                <li class="fntr actif"><a href="#"><i class="fi fi-rr-home"></i><span>Inscription</span></a></li>
                <li class="fntr"><a href="{{route('paiement_create')}}"><i class="fi fi-rr-user"></i><span >inscription</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-graduation-cap"></i><span>Inscription</span></a></li>

                <li class="fntr"><a href="{{route('logout')}}"><i class="fi fi-rr-sign-out-alt"></i><span>inscription</span></a></li>
            </ul>
        </nav>
    @endif

@endif

