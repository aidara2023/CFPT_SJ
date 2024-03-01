<?php

namespace App\Listeners;

use App\Models\Audit;
use App\Models\Auteur;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LogModelActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
        $userId = Auth::id();
        // Crée un nouvel audit pour enregistrer l'activité
        Audit::create([
            'model' => get_class($event->model), // Nom de la classe du modèle
            'id_user' =>  $userId, // Nom de la classe du modèle
            'model_id' => $event->model->id, // ID du modèle
            'action' => $event->action, // Action effectuée (created, updated, deleted)
            'details' => ucfirst($event->action) . ' ' . class_basename($event->model), // Détails de l'action
        ]);
    }
}
