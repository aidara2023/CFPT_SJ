@extends('layout.app')

@section('content')
    <div class="elements flou">
        @include('layout.header')

        <div class="dashboard">
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
        </div>
        
        
        </div>

        
    </div>
@endsection
