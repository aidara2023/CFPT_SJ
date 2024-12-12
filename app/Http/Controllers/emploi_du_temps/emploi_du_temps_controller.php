<?php

namespace App\Http\Controllers\emploi_du_temps;

use App\Events\ModelCreated;
use App\Events\ModelDeleted;
use App\Events\ModelUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\emploi_du_temps\emploi_du_temps_request;
use App\Http\Requests\EmploiDuTempsRequest;
use App\Models\Annee_academique;
use App\Models\Cour;
use App\Models\emploi_du_temps;
use Illuminate\Http\Request;
use App\Models\EmploiDuTemps;
use App\Models\Formateur;
use App\Models\Salle;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
//use Barryvdh\DomPDF\Facade as PDF; // Assurez-vous d'importer Dompdf
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\Facade as PDF; // Assurez-vous d'importer DomPDF
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class emploi_du_temps_controller extends Controller
{
    public function all()
    {
        $emploiDuTemps = Emploi_du_temps::with('cour', 'anne_academique')->orderBy('created_at', 'desc')->get();
        if ($emploiDuTemps != null) {
            return response()->json([
                'statut' => 200,
                'emploi_du_temps' => $emploiDuTemps,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function getcoursfromemploidutemps(Request $request)
    {
        // Initialise la requête pour inclure les relations nécessaires
        $query = Emploi_du_temps::with([
            'cour.Matiere', 
            'cour.Classe.unite_de_formation.departement', // Ajout des relations pour l'unité de formation et le département
            'cour.Semestre', 
            'salle'
        ])->orderBy('created_at', 'desc');
    
        // Filtrage par année académique
        if ($request->has('annee_academique') && !empty($request->annee_academique)) {
            $query->where('id_annee_academique', $request->annee_academique);
        }
    
        // Filtrage par classe
        if ($request->has('id_classe') && !empty($request->id_classe)) {
            $query->whereHas('cour', function ($q) use ($request) {
                $q->where('id_classe', $request->id_classe);
            });
        }
    
        // Filtrage par semestre
        if ($request->has('id_semestre') && !empty($request->id_semestre)) {
            $query->whereHas('cour', function ($q) use ($request) {
                $q->where('id_semestre', $request->id_semestre);
            });
        }
    
        // Exécute la requête
        $emploiDuTempss = $query->get();
    
        // Vérifie si des enregistrements ont été trouvés
        if ($emploiDuTempss->isNotEmpty()) {
            // Initialise un tableau pour stocker les événements
            $events = [];
    
            // Parcourt chaque enregistrement pour le transformer en événement
            foreach ($emploiDuTempss as $emploiDuTemps) {
                $events[] = [
                    'title' => $emploiDuTemps->cour->Matiere->intitule ?? 'Sans titre',
                    'start' => $emploiDuTemps->date_debut . 'T' . $emploiDuTemps->heure_debut,
                    'end' => $emploiDuTemps->date_fin . 'T' . $emploiDuTemps->heure_fin,
                    'professeur' => $emploiDuTemps->cour->Formateur->user->nom ?? 'Aucune professeur',
                    'genre' => $emploiDuTemps->cour->Formateur->user->genre ?? 'pas de genre' ,// 'M' pour masculin, 'F' pour féminin, 'U' pour inconnu
                    'salle' => $emploiDuTemps->salle->intitule ?? 'Aucune salle',
                    'unite_de_formation' => $emploiDuTemps->cour->Classe->unite_de_formation->nom_unite_formation ?? 'Aucune unité de formation',
                    'departement' => $emploiDuTemps->cour->Classe->unite_de_formation->departement->nom_departement ?? 'Aucun département',
                    'classe' => $emploiDuTemps->cour->Classe->type_formation->intitule . " " . $emploiDuTemps->cour->Classe->niveau . " " . $emploiDuTemps->cour->Classe->nom_classe . " " . $emploiDuTemps->cour->Classe->type_classe ?? 'Aucune classe',
                    'semestre' => $emploiDuTemps->cour->Semestre->intitule ?? 'Non défini',
                ];
            }
    
            // Retourne le tableau d'événements en JSON
            return response()->json($events);
        } else {
            // Retourne une réponse JSON avec un message d'erreur si aucun enregistrement n'a été trouvé
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }



    /*
    public function getcoursfromemploidutemps() {
        $emploiDuTempss = Cour::with('Matiere')->orderBy('created_at', 'desc')->get();
        if ($emploiDuTempss != null) {
            foreach($emploiDuTempss as $emploiDuTemps){
                return response()->json([

                     'title' => $emploiDuTemps->Matiere->intitule,
                     'start' => '2024-07-13T11:30:00',
                 ]);
            }

        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    } */
    public function getcoursfromemploidutempsOld()
    {
        // Récupère tous les cours avec leurs matières, triés par date de création.
        $emploiDuTempss = Emploi_du_temps::with('cour.Matiere')->orderBy('created_at', 'desc')->get();

        // Vérifie si des enregistrements ont été trouvés.
        if ($emploiDuTempss->isNotEmpty()) {
            // Initialise un tableau pour stocker les événements.
            $events = [];

            // Parcourt chaque enregistrement pour le transformer en événement.
            foreach ($emploiDuTempss as $emploiDuTemps) {
                $events[] = [
                    'title' => $emploiDuTemps->cour->Matiere->intitule,
                    /*  'start' => '2024-07-13T11:30:00',  */
                    'start' => $emploiDuTemps->date_debut . 'T' . $emploiDuTemps->heure_debut,
                    'end' => $emploiDuTemps->date_fin . 'T' . $emploiDuTemps->heure_fin,
                    // Remplacez `start_date` par le nom réel de votre champ
                    /* 'end' => $emploiDuTemps->date_cour->format('Y-m-d\TH:i:s'),  */    // Remplacez `end_date` par le nom réel de votre champ si vous avez un champ de fin
                    // Ajoutez d'autres champs nécessaires ici
                ];
            }

            // Retourne le tableau d'événements en JSON.
            return response()->json($events);
        } else {
            // Retourne une réponse JSON avec un message d'erreur si aucun enregistrement n'a été trouvé.
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }


    public function all_paginate(Request $request)
    {
        $perPage = $request->has('per_page') ? $request->per_page : 15;

        $emploiDuTemps = Emploi_du_temps::with('classe', 'formateur.user', 'matiere', 'salle', 'semestre')->orderBy('created_at', 'desc')->paginate($perPage);
        if ($emploiDuTemps != null) {
            return response()->json([
                'statut' => 200,
                'emploi_du_temps' => $emploiDuTemps,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function get_last_value()
    {
        $emploiDuTemps = Emploi_du_temps::with('classe', 'formateur.user', 'matiere', 'salle', 'semestre')->orderBy('created_at', 'desc')->take(5)->get();
        if ($emploiDuTemps != null) {
            return response()->json([
                'statut' => 200,
                'emploi_du_temps' => $emploiDuTemps,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    public function store(emploi_du_temps_request $request)
    {
        $data = $request->validated();

        $verification = Emploi_du_temps::where([
            ['heure_debut', '=', $request['heure_debut']],
            ['heure_fin', '=', $request['heure_fin']],
            ['date_debut', '=', $request['date_debut']],
            ['date_fin', '=', $request['date_fin']],
            ['id_cour', '=', $request['id_cour']],
            ['id_salle', '=', $request['id_salle']],
            ['id_annee_academique', '=', $request['id_annee_academique']]
        ])->get();

        if ($verification->count() != 0) {
            return response()->json([
                'statut' => 404,
                'message' => 'Cet emploi du temps existe déjà',
            ], 404);
        } else {
            $emploiDuTemps = Emploi_du_temps::create($data);
            if ($emploiDuTemps != null) {
                event(new ModelCreated($emploiDuTemps));
                return response()->json([
                    'statut' => 200,
                    'emploi_du_temps' => $emploiDuTemps,
                ], 200);
            } else {
                return response()->json([
                    'statut' => 500,
                    'message' => 'L\'enregistrement n\'a pas été effectué',
                ], 500);
            }
        }
    }
    /*  public function store_planification(Request $request){
       // $data = $request->validated();
        $planifications = json_decode($request->input('emploiplanifiers'), true);

        foreach ($planifications as $planification) {

            $planif = [
                'id_cour' => $planification['id_cour'],
                'id_annee_academique' => $planification['id_annee_academique'],
                'date_debut' => $planification['date_debut'],
                'date_fin' => $planification['date_fin'],
                'heure_debut' => $planification['heure_debut'],
                'heure_fin' => $planification['heure_fin'],
                'id_salle' => $planification['id_salle'],
            ];

            $emploiplanifier = Emploi_du_temps::create($planif);
            event(new ModelCreated($emploiplanifier));
        }

        if(isset($emploiplanifier)){
            return response()->json([
                'statut'=>200,
                'role'=>$emploiplanifier
            ],200);
        } else {
            return response()->json([
                'statut'=>500,
                'message'=>'L\'enregistrement n\'a pas été effectué',
            ],500);
        }
    } */
    /*   public function store_planification(Request $request)
{
    $planifications = json_decode($request->input('emploiplanifiers'), true);

    foreach ($planifications as $planification) {
        // Check if repetition is set, otherwise default to 'aucune'
        $repetition = isset($planification['repetition']) ? $planification['repetition'] : 'aucune';
        $repeatedPlanifications = $this->generateRepetitions($planification, $repetition);

        foreach ($repeatedPlanifications as $planif) {
            $emploiplanifier = Emploi_du_temps::create($planif);
            event(new ModelCreated($emploiplanifier));
        }
    }

    if (isset($emploiplanifier)) {
        return response()->json([
            'statut' => 200,
            'role' => $emploiplanifier
        ], 200);
    } else {
        return response()->json([
            'statut' => 500,
            'message' => 'L\'enregistrement n\'a pas été effectué',
        ], 500);
    }
}

private function generateRepetitions($planification, $repetition)
{
    $repeatedPlanifications = [];
    $intervalDays = 0;
    $repeatCount = 1; // Default to 1 to handle 'aucune' case

    switch ($repetition) {
        case 'semaine':
            $intervalDays = 7; // Repeat weekly
            $repeatCount = 4; // Repeat for 4 weeks
            break;
        case 'mois':
            $intervalDays = 30; // Repeat monthly
            $repeatCount = 2; // Repeat for 2 months
            break;
    }

    $currentStartDate = new \DateTime($planification['date_debut']);
    $currentEndDate = new \DateTime($planification['date_fin']);

    for ($i = 0; $i < $repeatCount; $i++) {
        $newPlanification = [
            'id_cour' => $planification['id_cour'],
            'id_annee_academique' => $planification['id_annee_academique'],
            'date_debut' => $currentStartDate->format('Y-m-d'),
            'date_fin' => $currentEndDate->format('Y-m-d'),
            'heure_debut' => $planification['heure_debut'],
            'heure_fin' => $planification['heure_fin'],
            'id_salle' => $planification['id_salle'],
        ];
        $repeatedPlanifications[] = $newPlanification;

        $currentStartDate->modify("+$intervalDays days");
        $currentEndDate->modify("+$intervalDays days");
    }

    return $repeatedPlanifications;
} */
    public function store_planification(Request $request)
    {
        $planifications = json_decode($request->input('emploiplanifiers'), true);

        foreach ($planifications as $planification) {
            // Check if repetition is set, otherwise default to 'aucune'
            $repetition = isset($planification['repetition']) ? $planification['repetition'] : 'aucune';
            $repeatedPlanifications = $this->generateRepetitions($planification, $repetition);

            foreach ($repeatedPlanifications as $planif) {
                // Check room availability
                if ($this->isRoomAvailable($planif['id_salle'], $planif['date_debut'], $planif['heure_debut'], $planif['heure_fin'])) {
                    $emploiplanifier = Emploi_du_temps::create($planif);
                    event(new ModelCreated($emploiplanifier));
                } else {
                    return response()->json([
                        'statut' => 409, // Conflict status code
                        'message' => 'La salle ' . $planif['id_salle'] . ' est déjà occupée pour la période sélectionnée.',
                    ], 409);
                }
            }
        }

        if (isset($emploiplanifier)) {
            return response()->json([
                'statut' => 200,
                'role' => $emploiplanifier
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'enregistrement n\'a pas été effectué',
            ], 500);
        }
    }

    private function isRoomAvailable($roomId, $date, $startTime, $endTime)
    {
        $conflict = Emploi_du_temps::where('id_salle', $roomId)
            ->where('date_debut', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('heure_debut', [$startTime, $endTime])
                    ->orWhereBetween('heure_fin', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('heure_debut', '<=', $startTime)
                            ->where('heure_fin', '>=', $endTime);
                    });
            })
            ->exists();

        return !$conflict;
    }

    private function generateRepetitions($planification, $repetition)
    {
        $repeatedPlanifications = [];
        $intervalDays = 0;
        $repeatCount = 1; // Default to 1 to handle 'aucune' case

        switch ($repetition) {
            case 'semaine':
                $intervalDays = 7; // Repeat weekly
                $repeatCount = 4; // Repeat for 4 weeks
                break;
            case 'mois':
                $intervalDays = 30; // Repeat monthly
                $repeatCount = 2; // Repeat for 2 months
                break;
        }

        // Utiliser la date actuelle comme point de départ
        $currentStartDate = new \DateTime();
        $currentEndDate = (clone $currentStartDate)->add(new \DateInterval('P1D')); // Ajoute 1 jour à la date de début pour obtenir la date de fin initiale

        for ($i = 0; $i < $repeatCount; $i++) {
            $newPlanification = [
                'id_cour' => $planification['id_cour'],
                'id_annee_academique' => $planification['id_annee_academique'],
                'date_debut' => $currentStartDate->format('Y-m-d'),
                'date_fin' => $currentEndDate->format('Y-m-d'),
                'heure_debut' => $planification['heure_debut'],
                'heure_fin' => $planification['heure_fin'],
                'id_salle' => $planification['id_salle'],
            ];
            $repeatedPlanifications[] = $newPlanification;

            $currentStartDate->modify("+$intervalDays days");
            $currentEndDate->modify("+$intervalDays days");
        }

        return $repeatedPlanifications;
    }


    public function update(emploi_du_temps_request $request, $id)
    {
        $emploiDuTemps = Emploi_du_temps::find($id);
        if ($emploiDuTemps != null) {
            $request->validated();
            $emploiDuTemps->date_debut = $request['date_debut'];
            $emploiDuTemps->date_fin = $request['date_fin'];
            $emploiDuTemps->id_cour = $request['id_cour'];
            $emploiDuTemps->id_annee_academique = $request['id_annee_academique'];

            $emploiDuTemps->save();
            event(new ModelUpdated($emploiDuTemps));
            return response()->json([
                'statut' => 200,
                'emploi_du_temps' => $emploiDuTemps,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'La mise à jour n\'a pas été effectuée',
            ], 500);
        }
    }

    public function delete($id)
    {
        $emploiDuTemps = emploi_du_temps::find($id);
        if ($emploiDuTemps != null) {
            $emploiDuTemps->delete();
            event(new ModelDeleted($emploiDuTemps));
            return response()->json([
                'statut' => 200,
                'message' => 'L\'emploi du temps a été supprimé avec succès',
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'emploi du temps n\'a pas été supprimé',
            ], 500);
        }
    }

    public function show($id)
    {
        $emploiDuTemps = emploi_du_temps::with('classe', 'formateur.user', 'matiere', 'salle', 'semestre')->find($id);

        if ($emploiDuTemps != null) {
            return response()->json([
                'statut' => 200,
                'emploi_du_temps' => $emploiDuTemps,
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'L\'emploi du temps n\'a pas été trouvé',
            ], 500);
        }
    }

    
    public function hasEmploiDuTemps($idClasse)
    {
        // Vérifie si un emploi du temps existe pour cette classe en passant par la table `cour`
        $hasEmploi = emploi_du_temps::whereHas('cour', function ($query) use ($idClasse) {
            $query->where('id_classe', $idClasse);
        })->exists();
    
        return response()->json(['hasEmploiDuTemps' => $hasEmploi]);
    }
    
    


    public function generateSchedule(Request $request)
    {
        $data = $request->input('formRecord');
        $allEvents = [];
        $dailySchedule = [];
        $conflicts = [];
    
        foreach ($data['selectedCourses'] as $courseData) {
            $parameters = $courseData['parameters'];
            $course = Cour::with(['Matiere', 'Formateur.user', 'Classe.type_formation'])->find($courseData['id_cour']);
            if (!$course) continue;
    
            // Déterminer la période en fonction du type de classe
            $classeType = $course->Classe->type_classe ?? '';
            
            if (str_contains(strtoupper($classeType), 'CS')) {
                $parameters['courseTimes'] = 'evening';
            } else if (str_contains(strtoupper($classeType), 'FPJ') || 
                      str_contains(strtoupper($classeType), 'CJ')) {
                $parameters['courseTimes'] = 'morning';
            } else {
                Log::warning("Type de classe non reconnu : $classeType");
                continue;
            }
    
            $remainingHours = $parameters['totalHours'];
            $currentDate = Carbon::parse($parameters['startDate']);
            $numberOfSessions = ceil($remainingHours / $parameters['durationPerSession']);
            $sessionsCreated = 0;
    
            while ($sessionsCreated < $numberOfSessions && 
                   $currentDate->lt($currentDate->copy()->addWeeks($parameters['numberOfWeeks']))) {
                
                if ($currentDate->isWeekend()) {
                    $currentDate->next(Carbon::MONDAY);
                    continue;
                }
    
                $dateKey = $currentDate->format('Y-m-d');
    
                if (!isset($dailySchedule[$dateKey])) {
                    $dailySchedule[$dateKey] = [];
                }
    
                if (!$this->isCourseScheduledForDay($courseData['id_cour'], $dailySchedule[$dateKey])) {
                    $timeSlot = $this->getAvailableTimeSlot(
                        $parameters['durationPerSession'],
                        $dailySchedule[$dateKey],
                        $classeType
                    );
    
                    if ($timeSlot) {
                        $room = $this->findAvailableRoom($dateKey, $timeSlot['start'], $timeSlot['end']);
                        
                        if ($room) {
                            // Vérifier les conflits
                            $conflictCheck = $this->checkConflicts($dateKey, $timeSlot, $room, $course);
                            
                            if ($conflictCheck['hasConflict']) {
                                $conflicts[] = $conflictCheck['message'];
                                $currentDate->addDay();
                                continue;
                            }
                            // Créer l'événement si pas de conflit
                            $event = [
                                'title' => "{$course->Matiere->intitule} ({$parameters['durationPerSession']}h)",
                                'id_cour' => $courseData['id_cour'],
                                'start' => $dateKey . 'T' . $timeSlot['start'],
                                'end' => $dateKey . 'T' . $timeSlot['end'],
                                'professeur' => $course->Formateur->user->nom ?? 'Non assigné',
                                'salle' => $room->intitule,
                                'id_salle' => $room->id,
                                'classe' => $this->formatClassName($course->Classe),
                                'backgroundColor' => $this->generateCourseColor($course->id),
                                'extendedProps' => [
                                    'matiere' => $course->Matiere->intitule,
                                    'professeur' => $course->Formateur->user->nom ?? 'Non assigné',
                                    'salle' => $room->intitule,
                                    'classe' => $this->formatClassName($course->Classe),
                                    'typeClasse' => $classeType,
                                    'periode' => $parameters['courseTimes'],
                                    'duree' => $parameters['durationPerSession'],
                                    'heuresRestantes' => max(0, $remainingHours - $parameters['durationPerSession']),
                                ],
                            ];
    
                            $allEvents[] = $event;
                            $dailySchedule[$dateKey][] = [
                                'id_cour' => $courseData['id_cour'],
                                'start' => $timeSlot['start'],
                                'end' => $timeSlot['end']
                            ];
    
                            $remainingHours -= $parameters['durationPerSession'];
                            $sessionsCreated++;
    
                            $nextDate = $currentDate->copy()->addDays($parameters['offset'] + 1);
                            if ($nextDate->isWeekend()) {
                                $nextDate->next(Carbon::MONDAY);
                            }
                            $currentDate = $nextDate;
                        } else {
                            $currentDate->addDay();
                        }
                    } else {
                        $currentDate->addDay();
                    }
                } else {
                    $currentDate->addDay();
                }
            }
        }
    
        // Retourner la réponse avec les conflits et un message approprié
        return response()->json([
            'success' => count($conflicts) === 0,
            'events' => $allEvents,
            'conflicts' => $conflicts,
            'message' => count($conflicts) > 0 
                ? "Des conflits ont été détectés. Veuillez vérifier les messages." 
                : "Planification réussie."
        ]);
    }
   
    
   
    private function getTimeSlots($period, $duration, $date)
    {
        $slots = [];
        $durationMinutes = $duration * 60;
    
        // Ajuster les créneaux en fonction de la durée du cours
        if ($duration <= 2) {
            // Pour les cours de 2h oumoins
            if ($period === 'morning') {
                $startTimes = ['08:00'];
                $maxEndTime = '17:00';
            } elseif ($period === 'evening') {
                $startTimes = ['17:00'];
                $maxEndTime = '20:00';
            } else {
                $startTimes = ['08:00'];
                $maxEndTime = '20:00';
            }
        } else {
            // Pour les cours de 3h ou plus
            if ($period === 'morning') {
                $startTimes = ['08:00', '11:00'];
                $maxEndTime = '17:00';
            } elseif ($period === 'evening') {
                $startTimes = ['17:00'];
                $maxEndTime = '20:00';
            } else {
                $startTimes = ['08:00', '11:00', '14:00', '17:00'];
                $maxEndTime = '20:00';
            }
        }
    
        foreach ($startTimes as $startTime) {
            $currentTime = Carbon::parse($startTime);
            $endTime = $currentTime->copy()->addMinutes($durationMinutes);
    
            // Vérifier si le cours ne dépasse pas la limite de temps
            if ($endTime->format('H:i') <= $maxEndTime) {
                $slots[] = [
                    'start' => $currentTime->format('H:i:s'),
                    'end' => $endTime->format('H:i:s'),
                ];
            }
        }
    
        // Mélanger les créneaux de manière aléatoire pour varier les horaires
        shuffle($slots);
    
        return $slots;
    }

    private function checkConflicts($dateKey, $timeSlot, $room)
    {
        try {
            if (!is_object($room)) {
                Log::error("Invalid room object received in checkConflicts");
                return ['hasConflict' => true, 'message' => "Erreur: Salle invalide"];
            }
    
            // Récupérer les événements existants pour cette date et salle
            $existingEvents = DB::table('emploi_du_temps')
                ->where('date_debut', $dateKey)
                ->where('id_salle', $room->id)
                ->get();
    
            foreach ($existingEvents as $event) {
                $eventStart = Carbon::parse($event->heure_debut);
                $eventEnd = Carbon::parse($event->heure_fin);
                $newStart = Carbon::parse($timeSlot['start']);
                $newEnd = Carbon::parse($timeSlot['end']);
    
                // Vérifier le chevauchement des horaires
                if (
                    ($newStart < $eventEnd && $newEnd > $eventStart) // Nouveau cours chevauche l'existant
                ) {
                    $conflictCourse = Cour::with(['Matiere', 'Formateur.user', 'Classe'])
                        ->find($event->id_cour);
    
                    return [
                        'hasConflict' => true,
                        'message' => "Conflit détecté : Un cours de {$conflictCourse->Matiere->intitule} " .
                                    "est déjà programmé dans la salle {$room->intitule} " .
                                    "le {$dateKey} de {$eventStart->format('H:i')} à {$eventEnd->format('H:i')} " .
                                    "pour la classe {$conflictCourse->Classe->nom_classe}."
                    ];
                }
            }
    
            return ['hasConflict' => false];
        } catch (\Exception $e) {
            Log::error("Erreur dans checkConflicts: " . $e->getMessage());
            return [
                'hasConflict' => true,
                'message' => "Erreur lors de la vérification des conflits: " . $e->getMessage()
            ];
        }
    }
    private function findAvailableRoom($dateKey, $startTime, $endTime)
    {
        $rooms = Salle::all();  // Récupérer toutes les salles disponibles
    
        foreach ($rooms as $room) {
            // Créer un timeSlot au format attendu par checkConflicts
            $timeSlot = [
                'start' => $startTime,
                'end' => $endTime
            ];
    
            // Vérifier les conflits pour chaque salle
            $conflictCheck = $this->checkConflicts($dateKey, $timeSlot, $room, null);
            
            if (!$conflictCheck['hasConflict']) {
                return $room;
            }
        }
    
        // Si aucune salle n'est disponible, retourner null
        return null;
    }
    
    
    public function saveSchedule(Request $request)
    {
        $events = $request->input('events');
    
        if (empty($events)) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun événement à enregistrer.',
            ], 400);
        }
    
        DB::beginTransaction();
    
        try {
            // Trier les événements par date et heure de début
            usort($events, function($a, $b) {
                $dateTimeA = Carbon::parse($a['start']);
                $dateTimeB = Carbon::parse($b['start']);
                return $dateTimeA->timestamp - $dateTimeB->timestamp;
            });
    
            $lastEndTime = null;
            $lastDate = null;
    
            foreach ($events as $event) {
                $startDateTime = Carbon::parse($event['start']);
                $endDateTime = Carbon::parse($event['end']);
                $currentDate = $startDateTime->format('Y-m-d');
    
                // Si c'est un nouveau jour, réinitialiser lastEndTime
                if ($currentDate !== $lastDate) {
                    $lastEndTime = null;
                    $lastDate = $currentDate;
                }
    
                // Vérifier les conflits réels (autres cours dans la même salle au même moment)
                $conflicts = Emploi_du_temps::where('date_debut', $currentDate)
                    ->where('id_salle', $event['id_salle'])
                    ->where(function ($query) use ($startDateTime, $endDateTime) {
                        $query->where(function ($q) use ($startDateTime, $endDateTime) {
                            $q->where('heure_debut', '<', $endDateTime->format('H:i:s'))
                              ->where('heure_fin', '>', $startDateTime->format('H:i:s'));
                        });
                    })
                    ->get();
    
                // Log des conflits trouvés
                Log::info('Conflits trouvés:', ['conflicts' => $conflicts]);
    
                // Si des conflits sont trouvés, ajuster l'heure de début
                if ($conflicts->isNotEmpty()) {
                    foreach ($conflicts as $conflict) {
                        $conflictEnd = Carbon::parse($currentDate . ' ' . $conflict->heure_fin);
                        if ($conflictEnd->gt($startDateTime)) {
                            // Ajuster l'heure de début à la fin du conflit
                            $startDateTime = $conflictEnd->copy();
                            $duration = $endDateTime->diffInMinutes($startDateTime);
                            $endDateTime = $startDateTime->copy()->addMinutes($duration);
                        }
                    }
                }
    
                // Log des heures ajustées
                Log::info('Heures ajustées:', [
                    'start' => $startDateTime->format('H:i:s'),
                    'end' => $endDateTime->format('H:i:s')
                ]);
    
                // Créer l'événement avec les heures ajustées
                Emploi_du_temps::create([
                    'id_cour' => $event['id_cour'],
                    'date_debut' => $currentDate,
                    'date_fin' => $currentDate,
                    'heure_debut' => $startDateTime->format('H:i:s'),
                    'heure_fin' => $endDateTime->format('H:i:s'),
                    'id_salle' => $event['id_salle'],
                    'id_annee_academique' => $this->getCurrentAcademicYear()->id,
                ]);
    
                // Mettre à jour lastEndTime pour le prochain cours
                $lastEndTime = $endDateTime;
            }
    
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Emploi du temps enregistré avec succès.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'enregistrement de l\'emploi du temps: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement : ' . $e->getMessage(),
            ], 500);
        }
    }

    private function isCourseScheduledForDay($courseId, $daySchedule)
    {
        foreach ($daySchedule as $event) {
            if ($event['id_cour'] === $courseId) {
                return true;
            }
        }
        return false;
    }





  /*   private function generateEventForSlot($courseId, $date, $period, $slotIndex)
    {
        $course = Cour::with(['Matiere', 'Formateur.user', 'Classe.type_formation'])->find($courseId);
        if (!$course) {
            throw new \Exception("Cours non trouvé: $courseId");
        }

        // Obtenir le créneau horaire basé sur l'index
        $timeSlot = $this->getTimeSlotForIndex($slotIndex % 3, $period);  // modulo 3 pour les 3 créneaux par jour
        if (!$timeSlot) {
            return null;
        }

        // Trouver une salle disponible
        $room = $this->findAvailableRoom(
            $date->format('Y-m-d'),
            $timeSlot['start'],
            $timeSlot['end']
        );

        if (!$room) {
            return null;
        }

        return [
            'title' => $course->Matiere->intitule,
            'id_cour' => $course->id,
            'start' => $date->format('Y-m-d') . 'T' . $timeSlot['start'],
            'end' => $date->format('Y-m-d') . 'T' . $timeSlot['end'],
            'professeur' => $course->Formateur->user->nom ?? 'Non assigné',
            'salle' => $room->intitule,
            'id_salle' => $room->id,
            'classe' => $this->formatClassName($course->Classe),
            'backgroundColor' => $this->generateCourseColor($course->id),
            'extendedProps' => [
                'matiere' => $course->Matiere->intitule,
                'professeur' => $course->Formateur->user->nom ?? 'Non assigné',
                'salle' => $room->intitule,
                'classe' => $this->formatClassName($course->Classe)
            ]
        ];
    } */

  /*   private function getTimeSlotForIndex($index, $period)
    {
        if ($period === 'morning') {
            $slots = [
                ['start' => '08:00:00', 'end' => '10:00:00'],
                ['start' => '10:00:00', 'end' => '12:00:00'],
                ['start' => '14:00:00', 'end' => '16:00:00']
            ];
        } else {
            $slots = [
                ['start' => '17:00:00', 'end' => '18:30:00'],
                ['start' => '18:30:00', 'end' => '20:00:00']
            ];
        }

        return $slots[$index] ?? null;
    } */

   /*  private function findAvailableRoom($date, $startTime, $endTime)
    {
        $rooms = Salle::all();

        foreach ($rooms as $room) {
            $isAvailable = !Emploi_du_temps::where('id_salle', $room->id)
                ->where('date_debut', $date)
                ->where(function($query) use ($startTime, $endTime) {
                    $query->where(function($q) use ($startTime, $endTime) {
                        $q->where('heure_debut', '<', $endTime)
                          ->where('heure_fin', '>', $startTime);
                    });
                })->exists();

            if ($isAvailable) {
                return $room;
            }
        }

        return null;
    } */


private function isFormateurAvailable($formateurId, $date, $startTime, $endTime)
{
    return !Emploi_du_temps::whereHas('cour', function($query) use ($formateurId) {
        $query->where('id_formateur', $formateurId);
    })
    ->where('date_debut', $date->format('Y-m-d'))
    ->where(function($query) use ($startTime, $endTime) {
        $query->where(function($q) use ($startTime, $endTime) {
            $q->where('heure_debut', '<', $endTime->format('H:i:s'))
              ->where('heure_fin', '>', $startTime->format('H:i:s'));
        });
    })->exists();
}

private function isClasseAvailable($classeId, $date, $startTime, $endTime)
{
    return !Emploi_du_temps::whereHas('cour', function($query) use ($classeId) {
        $query->where('id_classe', $classeId);
    })
    ->where('date_debut', $date->format('Y-m-d'))
    ->where(function($query) use ($startTime, $endTime) {
        $query->where(function($q) use ($startTime, $endTime) {
            $q->where('heure_debut', '<', $endTime->format('H:i:s'))
              ->where('heure_fin', '>', $startTime->format('H:i:s'));
        });
    })->exists();
}
private function getAvailableTimeSlot($duration, $daySchedule, $classeType)
{
    $durationMinutes = $duration * 60;
    
    // Définir les horaires selon le type de classe
    if (str_contains(strtoupper($classeType), 'CS')) {
        // Cours du soir uniquement pour CS
        $startTime = '17:00';
        $endTime = '20:00';
        $pauseStart = null;
        $pauseEnd = null;
    } else if (str_contains(strtoupper($classeType), 'FPJ') || 
               str_contains(strtoupper($classeType), 'CJ')) {
        // Cours du matin uniquement pour FPJ et CJ
        $startTime = '08:00';
        $endTime = '17:00';
        $pauseStart = '13:00';
        $pauseEnd = '14:00';
    } else {
        Log::warning("Type de classe non reconnu : $classeType");
        return null;
    }

    // Convertir en Carbon
    $currentTime = Carbon::parse($startTime);
    $periodEnd = Carbon::parse($endTime);

    // Si aucun événement n'existe encore
    if (empty($daySchedule)) {
        $potentialEnd = $currentTime->copy()->addMinutes($durationMinutes);
        if ($potentialEnd->format('H:i') <= $endTime) {
            return [
                'start' => $currentTime->format('H:i:s'),
                'end' => $potentialEnd->format('H:i:s')
            ];
        }
        return null;
    }

    // Trier les événements existants chronologiquement
    $sortedEvents = collect($daySchedule)->sortBy('start')->values()->all();
    $lastEvent = end($sortedEvents);
    $lastEventEnd = Carbon::parse($lastEvent['end']);

    // Pour les cours du matin (FPJ et CJ)
    if (str_contains(strtoupper($classeType), 'FPJ') || 
        str_contains(strtoupper($classeType), 'CJ')) {
        
        // Si le dernier cours se termine avant la pause déjeuner
        if ($lastEventEnd->format('H:i') <= $pauseStart) {
            $potentialStart = $lastEventEnd;
            $potentialEnd = $potentialStart->copy()->addMinutes($durationMinutes);

            if ($potentialEnd->format('H:i') <= $pauseStart) {
                return [
                    'start' => $potentialStart->format('H:i:s'),
                    'end' => $potentialEnd->format('H:i:s')
                ];
            }
        }
        
        // Si le dernier cours se termine après la pause déjeuner
        if ($lastEventEnd->format('H:i') >= $pauseEnd) {
            $potentialStart = $lastEventEnd;
            $potentialEnd = $potentialStart->copy()->addMinutes($durationMinutes);

            if ($potentialEnd->format('H:i') <= $endTime) {
                return [
                    'start' => $potentialStart->format('H:i:s'),
                    'end' => $potentialEnd->format('H:i:s')
                ];
            }
        }

        // Si le dernier cours se termine avant la pause et qu'il reste de la place après la pause
        if ($lastEventEnd->format('H:i') <= $pauseStart) {
            $potentialStart = Carbon::parse($pauseEnd);
            $potentialEnd = $potentialStart->copy()->addMinutes($durationMinutes);

            if ($potentialEnd->format('H:i') <= $endTime) {
                return [
                    'start' => $potentialStart->format('H:i:s'),
                    'end' => $potentialEnd->format('H:i:s')
                ];
            }
        }
    } 
    // Pour les cours du soir (CS)
    else {
        $potentialStart = $lastEventEnd;
        $potentialEnd = $potentialStart->copy()->addMinutes($durationMinutes);

        if ($potentialEnd->format('H:i') <= $endTime) {
            return [
                'start' => $potentialStart->format('H:i:s'),
                'end' => $potentialEnd->format('H:i:s')
            ];
        }
    }

    return null;
}

/* private function getBaseTimeSlots($period)
{
    if ($period === 'morning') {
        // Période du jour : 8h à 16h30
        return [
            '08:00:00',
            '10:00:00',
            '12:00:00',
            '14:00:00',
            '16:00:00'
        ];
    } else {
        // Période du soir : 17h à 20h
        return [
            '17:00:00',
            '18:30:00',
            '20:00:00'
        ];
    }
} */

/* private function isTimeSlotAvailable($date, $startTime, $endTime, $existingSlots)
{
    $start = Carbon::parse($startTime);
    $end = Carbon::parse($endTime);

    foreach ($existingSlots as $slot) {
        $slotStart = Carbon::parse($slot['start']);
        $slotEnd = Carbon::parse($slot['end']);

        // Vérifier s'il y a chevauchement
        if (
            ($start->between($slotStart, $slotEnd)) ||
            ($end->between($slotStart, $slotEnd)) ||
            ($slotStart->between($start, $end)) ||
            ($slotEnd->between($start, $end))
        ) {
            return false;
        }

        // Vérifier s'il y a assez de pause entre les cours (30 minutes minimum)
        if (
            $start->diffInMinutes($slotEnd) < 30 &&
            $start->gt($slotEnd)
        ) {
            return false;
        }

        if (
            $slotStart->diffInMinutes($end) < 30 &&
            $slotStart->gt($end)
        ) {
            return false;
        }
    }

    return true;
} */


/* private function findAvailableRoom($date, $startTime, $endTime)
{
    $rooms = Salle::all();

    foreach ($rooms as $room) {
        $roomConflict = Emploi_du_temps::where('id_salle', $room->id)
            ->where('date_debut', $date)
            ->where(function($query) use ($startTime, $endTime) {
                $query->where(function($q) use ($startTime, $endTime) {
                    $q->where('heure_debut', '<', $endTime)
                      ->where('heure_fin', '>', $startTime);
                });
            })->exists();

        if (!$roomConflict) {
            return $room;
        }
    }

    return null;
} */

/* private function isSlotInPeriod($slotTime, $period)
{
    $hour = (int)$slotTime->format('H');

    if ($period === 'morning') {
        // Vérifier si l'heure est entre 8h et 16h30
        return $hour >= 8 && $hour <= 16;
    } else {
        // Vérifier si l'heure est entre 17h et 20h
        return $hour >= 17 && $hour <= 20;
    }
}
 */
/* private function findAvailableSlotsForDay($date, $durationPerSession, $course, $period)
{
    $availableSlots = [];
    $baseTimeSlots = $this->getBaseTimeSlots($period);

    foreach ($baseTimeSlots as $baseSlot) {
        $startTime = Carbon::parse($date->format('Y-m-d') . ' ' . $baseSlot);
        $endTime = $startTime->copy()->addMinutes($durationPerSession);

        // Vérifier si l'heure de fin ne dépasse pas la limite de la période
        if ($period === 'morning' && $endTime->format('H') > 16) {
            continue;
        }
        if ($period === 'afternoon' && $endTime->format('H') > 20) {
            continue;
        }

        if ($this->isSlotAvailable($date, $startTime, $endTime, $course)) {
            $room = $this->findAvailableRoom($date->format('Y-m-d'), $startTime->format('H:i:s'), $endTime->format('H:i:s'));

            if ($room) {
                $availableSlots[] = [
                    'start' => $date->format('Y-m-d') . 'T' . $startTime->format('H:i:s'),
                    'end' => $date->format('Y-m-d') . 'T' . $endTime->format('H:i:s'),
                    'salle' => $room
                ];
            }
        }
    }

    return $availableSlots;
} */

/* private function isSlotAvailable($date, $startTime, $endTime, $course)
{
    // Vérifier les contraintes de période
    $period = $startTime->format('H') < 17 ? 'morning' : 'afternoon';
    if (!$this->isSlotInPeriod($startTime, $period)) {
        return false;
    }

    // Vérifier la disponibilité du formateur
    $formateurConflict = Emploi_du_temps::whereHas('cour', function($query) use ($course) {
        $query->where('id_formateur', $course->Formateur->id);
    })
    ->where('date_debut', $date->format('Y-m-d'))
    ->where(function($query) use ($startTime, $endTime) {
        $query->where(function($q) use ($startTime, $endTime) {
            $q->where('heure_debut', '<', $endTime->format('H:i:s'))
              ->where('heure_fin', '>', $startTime->format('H:i:s'));
        });
    })->exists();

    if ($formateurConflict) {
        return false;
    }

    // Vérifier la disponibilité de la classe
    $classeConflict = Emploi_du_temps::whereHas('cour', function($query) use ($course) {
        $query->where('id_classe', $course->Classe->id);
    })
    ->where('date_debut', $date->format('Y-m-d'))
    ->where(function($query) use ($startTime, $endTime) {
        $query->where(function($q) use ($startTime, $endTime) {
            $q->where('heure_debut', '<', $endTime->format('H:i:s'))
              ->where('heure_fin', '>', $startTime->format('H:i:s'));
        });
    })->exists();

    return !$classeConflict;
} */

/* public function saveSchedule(Request $request)
{
    Log::info('Données reçues dans saveSchedule:', $request->all());

    $events = $request->input('events', []);
    $formRecords = $request->input('formRecords', []);

    try {
        DB::beginTransaction();

        $savedEvents = [];
        foreach ($events as $event) {
            // Trouver le prochain créneau disponible
            $availableSlot = $this->findNextAvailableSlot($event);

            if (!$availableSlot) {
                throw new \Exception("Impossible de trouver un créneau disponible");
            }

            $emploiDuTemps = Emploi_du_temps::create([
                'id_cour' => $event['id_cour'],
                'id_salle' => $availableSlot['salle']->id,
                'id_annee_academique' => $this->getCurrentAcademicYear()->id,
                'date_debut' => $availableSlot['date'],
                'date_fin' => $availableSlot['date'],
                'heure_debut' => $availableSlot['heure_debut'],
                'heure_fin' => $availableSlot['heure_fin']
            ]);

            event(new ModelCreated($emploiDuTemps));
            $savedEvents[] = $emploiDuTemps;
        }

        DB::commit();
        return response()->json([
            'success' => true,
            'savedEvents' => count($savedEvents),
            'message' => 'Emploi du temps enregistré avec succès'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Erreur lors de la sauvegarde:', ['error' => $e->getMessage()]);

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 422);
    }
}
 */
/* private function findNextAvailableSlot($event)
{
    $startDateTime = Carbon::parse($event['start']);
    $duration = Carbon::parse($event['end'])->diffInMinutes($startDateTime);
    $course = Cour::with(['Formateur', 'Classe'])->find($event['id_cour']);

    // Déterminer la période (morning/afternoon)
    $period = $startDateTime->format('H') < 17 ? 'morning' : 'afternoon';

    // Obtenir tous les créneaux possibles pour cette période
    $timeSlots = $this->getBaseTimeSlots($period);

    // Commencer à chercher à partir de la date donnée
    $currentDate = $startDateTime->copy();
    $maxAttempts = 10; // Limite de jours à vérifier
    $attemptCount = 0;

    while ($attemptCount < $maxAttempts) {
        foreach ($timeSlots as $timeSlot) {
            $slotStart = Carbon::parse($currentDate->format('Y-m-d') . ' ' . $timeSlot);
            $slotEnd = $slotStart->copy()->addMinutes($duration);

            // Vérifier si ce créneau respecte la période
            if (!$this->isSlotInPeriod($slotStart, $period)) {
                continue;
            }

            // Vérifier la disponibilité de la salle
            $availableRoom = $this->findAvailableRoomForSlot(
                $currentDate->format('Y-m-d'),
                $slotStart->format('H:i:s'),
                $slotEnd->format('H:i:s')
            );

            if (!$availableRoom) {
                continue;
            }

            // Vérifier la disponibilité du formateur
            if (!$this->isFormateurAvailable($course->Formateur->id, $currentDate, $slotStart, $slotEnd)) {
                continue;
            }

            // Vérifier la disponibilité de la classe
            if (!$this->isClasseAvailable($course->Classe->id, $currentDate, $slotStart, $slotEnd)) {
                continue;
            }

            // Si on arrive ici, on a trouvé un créneau disponible
            return [
                'date' => $currentDate->format('Y-m-d'),
                'heure_debut' => $slotStart->format('H:i:s'),
                'heure_fin' => $slotEnd->format('H:i:s'),
                'salle' => $availableRoom
            ];
        }

        // Passer au jour suivant
        $currentDate->addDay();
        $attemptCount++;
    }

    return null;
} */

/*  private function findAvailableRoomForSlot($date, $startTime, $endTime)
{
    $rooms = Salle::all();

    foreach ($rooms as $room) {
        if (!$this->isRoomBooked($room->id, $date, $startTime, $endTime)) {
            return $room;
        }
    }

    return null;
}
 */
/* private function isRoomBooked($roomId, $date, $startTime, $endTime)
{
    return Emploi_du_temps::where('id_salle', $roomId)
        ->where('date_debut', $date)
        ->where(function($query) use ($startTime, $endTime) {
            $query->where(function($q) use ($startTime, $endTime) {
                $q->where('heure_debut', '<', $endTime)
                  ->where('heure_fin', '>', $startTime);
            });
        })->exists();
} */

/* private function isFormateurAvailable($formateurId, $date, $startTime, $endTime)
{
    return !Emploi_du_temps::whereHas('cour', function($query) use ($formateurId) {
        $query->where('id_formateur', $formateurId);
    })
    ->where('date_debut', $date->format('Y-m-d'))
    ->where(function($query) use ($startTime, $endTime) {
        $query->where(function($q) use ($startTime, $endTime) {
            $q->where('heure_debut', '<', $endTime->format('H:i:s'))
              ->where('heure_fin', '>', $startTime->format('H:i:s'));
        });
    })->exists();
}

private function isClasseAvailable($classeId, $date, $startTime, $endTime)
{
    return !Emploi_du_temps::whereHas('cour', function($query) use ($classeId) {
        $query->where('id_classe', $classeId);
    })
    ->where('date_debut', $date->format('Y-m-d'))
    ->where(function($query) use ($startTime, $endTime) {
        $query->where(function($q) use ($startTime, $endTime) {
            $q->where('heure_debut', '<', $endTime->format('H:i:s'))
              ->where('heure_fin', '>', $startTime->format('H:i:s'));
        });
    })->exists();
} */
/* private function checkAllConflicts($event)
{
    $conflicts = [];
    $startDateTime = Carbon::parse($event['start']);
    $endDateTime = Carbon::parse($event['end']);
    $date = $startDateTime->toDateString();
    $startTime = $startDateTime->format('H:i:s');
    $endTime = $endDateTime->format('H:i:s');

    // Récupérer le cours avec ses relations
    $course = Cour::with(['Formateur', 'Classe'])->find($event['id_cour']);
    if (!$course) {
        throw new \Exception("Cours non trouvé");
    }

    // 1. Vérifier les conflits de salle
    $salleConflict = Emploi_du_temps::where('id_salle', $event['id_salle'])
        ->where('date_debut', $date)
        ->where(function($q) use ($startTime, $endTime) {
            $q->where(function($query) use ($startTime, $endTime) {
                $query->where('heure_debut', '<', $endTime)
                      ->where('heure_fin', '>', $startTime);
            });
        })->exists();

    if ($salleConflict) {
        $conflicts[] = "La salle est déjà occupée à cet horaire";
    }

    // 2. Vérifier les conflits du formateur
    $formateurConflict = Emploi_du_temps::whereHas('cour', function($q) use ($course) {
        $q->where('id_formateur', $course->Formateur->id);
    })
    ->where('date_debut', $date)
    ->where(function($q) use ($startTime, $endTime) {
        $q->where(function($query) use ($startTime, $endTime) {
            $query->where('heure_debut', '<', $endTime)
                  ->where('heure_fin', '>', $startTime);
        });
    })->exists();

    if ($formateurConflict) {
        $conflicts[] = "Le formateur a déjà un cours à cet horaire";
    }

    // 3. Vérifier les conflits de la classe
    $classeConflict = Emploi_du_temps::whereHas('cour', function($q) use ($course) {
        $q->where('id_classe', $course->Classe->id);
    })
    ->where('date_debut', $date)
    ->where(function($q) use ($startTime, $endTime) {
        $q->where(function($query) use ($startTime, $endTime) {
            $query->where('heure_debut', '<', $endTime)
                  ->where('heure_fin', '>', $startTime);
        });
    })->exists();

    if ($classeConflict) {
        $conflicts[] = "La classe a déjà un cours à cet horaire";
    }

    return $conflicts;
} */


private function getCurrentAcademicYear()
{
    $currentYear = Carbon::now()->year;
    $academicYearString = ($currentYear - 1) . ' - ' . $currentYear;
    return Annee_academique::where('intitule', $academicYearString)->firstOrFail();
}

/* private function checkScheduleConflicts($event)
{
    return Emploi_du_temps::where(function($query) use ($event) {
        $query->where('id_salle', $event['id_salle'])
              ->where('date_debut', Carbon::parse($event['start'])->toDateString())
              ->where(function($q) use ($event) {
                  $startTime = Carbon::parse($event['start'])->format('H:i:s');
                  $endTime = Carbon::parse($event['end'])->format('H:i:s');
                  $q->whereBetween('heure_debut', [$startTime, $endTime])
                    ->orWhereBetween('heure_fin', [$startTime, $endTime]);
              });
    })->exists();
} */

private function formatClassName($classe)
{
    return implode(" ", [
        $classe->type_formation->intitule ?? '',
        $classe->niveau ?? '',
        $classe->nom_classe ?? '',
        $classe->type_classe ?? '',
        $classe->id_unite_de_formation ?? '',
    ]);
}

private function generateCourseColor($courseId)
{
    $colors = [
        '#3788d8', '#ff9f89', '#71c7ec', '#ffd700',
        '#98fb98', '#dda0dd', '#40e0d0', '#ff6b6b'
    ];
    return $colors[$courseId % count($colors)];
}




/* private function findAvailableRoom($date, $startTime, $endTime)
{
    $rooms = Salle::all();

    foreach ($rooms as $room) {
        if ($this->isRoomAvailableForTime($room->id, $date, $startTime, $endTime)) {
            return $room;
        }
    }

    return null;
} */

/* private function isRoomAvailableForTime($roomId, $date, $startTime, $endTime)
{
    $existingBooking = Emploi_du_temps::where('id_salle', $roomId)
        ->where('date_debut', $date)
        ->where(function($query) use ($startTime, $endTime) {
            $query->where(function($q) use ($startTime, $endTime) {
                $q->where('heure_debut', '<=', $startTime)
                  ->where('heure_fin', '>', $startTime);
            })->orWhere(function($q) use ($startTime, $endTime) {
                $q->where('heure_debut', '<', $endTime)
                  ->where('heure_fin', '>=', $endTime);
            })->orWhere(function($q) use ($startTime, $endTime) {
                $q->where('heure_debut', '>=', $startTime)
                  ->where('heure_fin', '<=', $endTime);
            });
        })->exists();

    return !$existingBooking;
} */



/* private function isTeacherAvailable($formateurId, $date, $startTime, $endTime)
{
    return !Emploi_du_temps::whereHas('cour', function($query) use ($formateurId) {
        $query->where('id_formateur', $formateurId);
    })
    ->where('date_debut', $date)
    ->where(function($query) use ($startTime, $endTime) {
        $query->where(function($q) use ($startTime, $endTime) {
            $q->where('heure_debut', '<=', $startTime)
              ->where('heure_fin', '>', $startTime);
        })->orWhere(function($q) use ($startTime, $endTime) {
            $q->where('heure_debut', '<', $endTime)
              ->where('heure_fin', '>=', $endTime);
        })->orWhere(function($q) use ($startTime, $endTime) {
            $q->where('heure_debut', '>=', $startTime)
              ->where('heure_fin', '<=', $endTime);
        });
    })->exists();
} */



   /*  public function saveSchedule(Request $request)
{
    Log::info('Données reçues dans saveSchedule:', $request->all());


    $validatedData = $request->validate([
        'formRecords' => 'required|array',
        'formRecords.*.totalHours' => 'required|integer',
        'formRecords.*.durationPerSession' => 'required|integer',
        'formRecords.*.date_debut' => 'required|date',
        'formRecords.*.offset' => 'required|integer',
        'formRecords.*.numberOfWeeks' => 'required|integer',
        'formRecords.*.id_cour' => 'required|integer',
    ]);

    $formRecords = $validatedData['formRecords'];
    $savedEvents = 0;
    $invalidEvents = [];

    DB::transaction(function () use ($formRecords, &$savedEvents, &$invalidEvents) {
        $currentYear = Carbon::now()->year;
        $academicYearString = ($currentYear - 1) . ' - ' . $currentYear;
        $academicYear = Annee_academique::where('intitule', $academicYearString)->first();

        foreach ($formRecords as $record) {
            try {
                $dateDebut = Carbon::parse($record['date_debut']);
                $dateFin = $dateDebut->copy()->addWeeks($record['numberOfWeeks']);
                $heureDebut = $dateDebut->toTimeString();
                $heureFin = $dateDebut->copy()->addHours($record['durationPerSession'])->toTimeString();

                emploi_du_temps::create([
                    'id_cour' => $record['id_cour'],
                    'id_annee_academique' => $academicYear->id,
                    'date_debut' => $dateDebut->toDateString(),
                    'date_fin' => $dateFin->toDateString(),
                    'heure_debut' => $heureDebut,
                    'heure_fin' => $heureFin,
                ]);
                $savedEvents++;
            } catch (\Exception $e) {
                Log::error('Erreur lors de la création de l\'emploi du temps:', ['error' => $e->getMessage(), 'record' => $record]);
                $invalidEvents[] = $record;
            }
        }
    });

    Log::info('Nombre d\'événements sauvegardés: ' . $savedEvents);
    return response()->json([
        'success' => true,
        'savedEvents' => $savedEvents,
        'invalidEvents' => $invalidEvents
    ]);
} */



    public function getEmploiDuTempsForConnectedFormateur(Request $request)

    {
        // Retrieve the ID of the connected formateur. Adjust this as needed.
        $formateurId = auth()->user()->formateur->id; // Adjust based on your actual setup

        // Initialize the query to include the necessary relationships and filter by formateur ID
        $query = Emploi_du_temps::with(['cour.Matiere'])
            ->whereHas('cour', function ($query) use ($formateurId) {
                $query->where('id_formateur', $formateurId); // Adjust field name if necessary
            })
            ->orderBy('created_at', 'desc');

        // Execute the query
        $emploiDuTempss = $query->get();

        // Check if records were found
        if ($emploiDuTempss->isNotEmpty()) {
            // Initialize an array to store events
            $events = [];

            // Loop through each record and transform it into an event
            foreach ($emploiDuTempss as $emploiDuTemps) {
                // Check if all necessary data exists
                $title = $emploiDuTemps->cour->Matiere->intitule ?? 'Sans titre';
                $start = $emploiDuTemps->date_debut . 'T' . $emploiDuTemps->heure_debut;
                $end = $emploiDuTemps->date_fin . 'T' . $emploiDuTemps->heure_fin;

                // Ensure start and end are in valid ISO 8601 format
                if (!DateTime::createFromFormat('Y-m-d\TH:i:s', $start) || !DateTime::createFromFormat('Y-m-d\TH:i:s', $end)) {
                    return response()->json([
                        'statut' => 500,
                        'message' => 'Invalid date or time format',
                    ], 500);
                }

                $events[] = [
                    'title' => $title,
                    'start' => $start,
                    'end' => $end,
                    // Add other necessary fields here
                ];
            }

            // Return the events array as JSON
            return response()->json($events);
        } else {
            // Return a JSON response with an error message if no records were found
            return response()->json([
                'statut' => 500,
                'message' => 'Aucun enregistrement n\'a été trouvé',
            ], 500);
        }
    }

    //Pour créer les impressions 
   

    
}
