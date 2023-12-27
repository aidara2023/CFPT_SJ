@if (Auth::user())
    @if (Auth::user()->id_role==3)
    <nav class="flou ">
        <ul >
            <li class="fntr">
                <a href="{{route('admin_index')}}">
                    <div>
                        <i class="fi fi-rr-home"></i>
                        <span>Accueil</span>
                    </div>
                </a>
            </li>
        
            <li class="fntr"><a href="{{route('utilisateur_index')}}">
                <div>
                    <i class="fi fi-rr-user"></i>
                    <span >Utilisateurs</span>
                </div>
            </a></li>

             <li class="fntr"><a href="{{route('direction_accueil')}}">
                <div>
                    <i class="fi fi-rr-user"></i>
                    <span >Direction</span>
                </div>
            </a></li>

            <li class="fntr menu">
            <a href="#">
                <div>
                    <i class="fi fi-rr-graduation-cap"></i>
                    <span>Pédagogique</span>
                </div>
            </a>
            <ul class="deroulante">
                <li class="fntr" ><a href="{{route('departement_index')}}">
                    <i class="fi fi-rr-home"></i>
                    <span>Departement</span>
                    </a>
                </li>
                <li class="fntr" ><a href="{{route('classe_index')}}">
                    <i class="fi fi-rr-home"></i>
                    <span>Classe</span>
                    </a>
                </li>
                <li class="fntr" ><a href="{{route('unite_de_formation_index')}}">
                    <i class="fi fi-rr-home"></i>
                    <span>Filière</span>
                    </a>
                </li>
                <li class="fntr" ><a href="{{route('type_formation_index')}}">
                    <i class="fi fi-rr-home"></i>
                    <span>Type Formation</span>
                    </a>
                </li>
                
            </ul>
        </li>

          
            <li class="fntr"><a href="{{route('service_accueil')}}">
                <div>
                    <i class="fi fi-rr-money-bill-wave"></i>
                    <span>Service</span>
                </div>
            </a></li>
            
            <li class="fntr"><a href="{{route('inscription_accueil')}}">
                <div>
                    <i class="fi fi-rr-money-bill-wave"></i>
                    <span>Inscription</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-money-bill-wave"></i>
                    <span>Paiements</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-book-bookmark"></i>
                    <span>Bibliothèque</span>
                </div>
            </a></li>

            <li class="fntr"><a href="{{route('salle_accueil')}}">
                <div>
                    <i class="fi fi-rr-bank"></i>
                    <span>Salle</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rs-pharmacy"></i>
                    <span>Infirmerie</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-building"></i>
                    <span>Partenariats</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-tool-box"></i>
                    <span>Matériel</span>
                </div>
            </a></li>

            <li class="fntr"><a href="#">
                <div>
                    <i class="fi fi-rr-folder-minus"></i>
                    <span>Archives</span>
                </div>
            </a></li>

            <li class="fntr"><a href="{{route('logout')}}">
                <div>
                    <i class="fi fi-rr-sign-out-alt"></i>
                    <span>Me déconnecter</span>
                </div>
            </a></li>

        </ul>
     </nav>
    @endif
    @if (Auth::user()->id_role==4)

    <nav class="flou ">
        <ul >
            <li class="fntr"><a href="{{route('caissier_accueil')}}">
                <div>
                    <i class="fi fi-rr-home"></i>
                    <span>Accueil</span>
                </div>
            </a>
     
        </li>
         <li class="fntr"><a href="{{route('validation_inscription')}}">
                <div>
                    <i class="fi fi-rr-user"></i>
                    <span >Valider Inscription</span>
                </div>
            </a></li>

        
            <li class="fntr"><a href="{{route('paiement_create')}}">
                <div>
                    <i class="fi fi-rr-user"></i>
                    <span >Paiment</span>
                </div>
            </a></li>

            <li class="fntr"><a href="{{route('recouvrement_index')}}">
                <div>
                    <i class="fi fi-rr-money-bill-wave"></i>
                    <span>Recouvrement</span>
                </div>
            </a></li>


            <li class="fntr"><a href="{{route('logout')}}">
                <div>
                    <i class="fi fi-rr-sign-out-alt"></i>
                    <span>Me déconnecter</span>
                </div>
            </a></li>

        </ul>
     </nav>
     @endif

     @if (Auth::user()->id_role==7)
     <nav class="flou ">
         <ul >
             <li class="fntr"><a href="{{route('bibliothecaire_accueil')}}">
                 <div>
                     <i class="fi fi-rr-home"></i>
                     <span>Accueil</span>
                 </div>
             </a>
      
         </li>

         
             <li class="fntr"><a href="{{route('livre_create')}}">
                 <div>
                     <i class="fi fi-rr-user"></i>
                     <span ></span>

            <li class="fntr"><a href="{{route('rayon_create')}}">
                    <div>
                        <i class="fi fi-rr-user"></i>
                        <span >Rayon</span>
                    </div>
             </a></li>
            
             <li class="fntr"><a href="{{route('categorie_create')}}">
                 <div>
                     <i class="fi fi-rr-user"></i>
                     <span >Catégorie</span>

                 </div>
             </a></li>
 
             <li class="fntr"><a href="{{route('auteur_create')}}">
                 <div>
                     <i class="fi fi-rr-user"></i>
                     <span >Auteur</span>
                 </div>
             </a></li>

             <li class="fntr"><a href="{{route('editeur_create')}}">
                 <div>
                     <i class="fi fi-rr-user"></i>
                     <span >Editeur</span>
                 </div>
             </a></li>

             <li class="fntr"><a href="{{route('edition_create')}}">
                 <div>
                     <i class="fi fi-rr-user"></i>
                     <span >Edition</span>
                 </div>
             </a></li>

             <li class="fntr"><a href="{{route('livre_create')}}">
                 <div>
                     <i class="fi fi-rr-user"></i>
                     <span >Livre</span>
                 </div>
             </a></li>

             <li class="fntr"><a href="{{route('exemplaire_create')}}">
                 <div>
                     <i class="fi fi-rr-user"></i>
                     <span >Exemplaire</span>
                 </div>
             </a></li>

             <li class="fntr"><a href="{{route('emprunter_livre_create')}}">
                 <div>
                     <i class="fi fi-rr-user"></i>
                     <span >Livre Emprunter</span>
                 </div>
             </a></li>
 
 
             <li class="fntr"><a href="{{route('logout')}}">
                 <div>
                     <i class="fi fi-rr-sign-out-alt"></i>
                     <span>Me déconnecter</span>
                 </div>
             </a></li>
 
         </ul>
      </nav>
      @endif

     @if(Auth::user()->id_role==12)
        <nav class="flou">
            <ul>
                <li class="fntr actif"><a href="#"><i class="fi fi-rr-home"></i><span>Accueil</span></a></li>
                <li class="fntr"><a href="{{route('inscription_accueil')}}"><i class="fi fi-rr-user"></i><span >Inscription</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-graduation-cap"></i><span>Bulletin</span></a></li>
                <li class="fntr"><a href="#"><i class="fi fi-rr-graduation-cap"></i><span>Attestation</span></a></li>
                <li class="fntr"><a href="{{route('logout')}}"><i class="fi fi-rr-sign-out-alt"></i><span>Me déconnecter</span></a></li>
            </ul>
        </nav>
    @endif

     @if(Auth::user()->id_role==5)
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

