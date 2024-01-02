@extends('layout.app')

@section('content')
    <div class="elements flou" id="app">
        @include('layout.header')
        {{--  <div class="dashboard">
            <div class="card">
                <div class="card-icon">👤</div>
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs</h5>
                    <p class="card-text">Nombre d'utilisateurs enregistrés</p>
                </div>
            </div>
        
            <div class="card">
                <div class="card-icon">📊</div>
                <div class="card-body">
                    <h5 class="card-title">Statistiques</h5>
                    <p class="card-text">Visualisez les statistiques importantes</p>
                </div>
            </div>
        
            <div class="card">
                <div class="card-icon">💰</div>
                <div class="card-body">
                    <h5 class="card-title">Finances</h5>
                    <p class="card-text">Informations financières et transactions</p>
                </div>
            </div>
            <div class="card">
                <div class="card-icon">🏥</div>
                <div class="card-body">
                    <h5 class="card-title">Infirmerie</h5>
                    <p class="card-text">Informations</p>
                </div>
            </div>
            <div class="card">
                <div class="card-icon">📚</div>
                <div class="card-body">
                    <h5 class="card-title">Bibliotheque</h5>
                    <p class="card-text">Informations </p>
                </div>
            </div>
            <div class="card">
                <div class="card-icon">🎒</div>
                <div class="card-body">
                    <h5 class="card-title">Materiel</h5>
                    <p class="card-text">Informations</p>
                </div>
            </div>
        </div>   --}}
   
        <div class="liste">
            <div class="item_bloc">

                <h3>Pages</h3>
                <div class="container">
                    <div class="container page">
                        <i class="fi fi-rr-chart-histogram"></i>
                        <div>
                            <span>Taux de réussite</span>
                            <h2>123412</h2>
                        </div>
                    </div>
                    <div class="container page">
                        <i class="fi fi-rr-folder-minus"></i>
                        <div>
                            <span>Unités de formation</span>
                            <h2>123412</h2>
                        </div>
                    </div>
                    <div class="container page">
                        <i class="fi fi-rr-user"></i>
                        <div>
                            <span>Formateurs</span>
                            <h2>123412</h2>
                        </div>
                    </div>
                    <div class="container page">
                        <i class="fi fi-rr-user"></i>
                        <div>
                            <span>Elèves</span>
                            <h2>123412</h2>
                        </div>
                    </div>
                </div>

            </div>

            <br>

            <div class="item_bloc">
                <h3>Graphiques</h3>
                <div class="container">
                    <div class="container graphique">
                        <h4>Finance</h4>
                        <div class="courbe">
                            <!-- lignes -->
                            <div class="ligne">
                                <span class="texte">20</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">10</span>
                                <hr>
                            </div>
                            <div class="diagramme">
                                <!-- barres du diagramme -->
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="container graphique">
                        <h4>Autre chose</h4>
                        <div class="courbe">
                            <!-- lignes -->
                            <div class="ligne">
                                <span class="texte">20</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">10</span>
                                <hr>
                            </div>
                            <div class="diagramme">
                                <!-- barres du diagramme -->
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="container graphique">
                        <h4>Encore autre chose</h4>
                        <div class="courbe">
                            <!-- lignes -->
                            <div class="ligne">
                                <span class="texte">20</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">15</span>
                                <hr>
                            </div>
                            <div class="ligne">
                                <span class="texte">10</span>
                                <hr>
                            </div>
                            <div class="diagramme">
                                <!-- barres du diagramme -->
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                                <div class="barre"><span class="texte nts">mois</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
