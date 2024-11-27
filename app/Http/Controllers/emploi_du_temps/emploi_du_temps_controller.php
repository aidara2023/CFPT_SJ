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
        $query = Emploi_du_temps::with(['cour.Matiere', 'cour.Classe', 'cour.Semestre', 'salle'])
            ->orderBy('created_at', 'desc');

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

            // Parcourt chaque enregistrement pour le transformer en événement  unite_de_formation type_formation type_classe
            foreach ($emploiDuTempss as $emploiDuTemps) {
                $events[] = [
                    'title' => $emploiDuTemps->cour->Matiere->intitule ?? 'Sans titre',
                    'start' => $emploiDuTemps->date_debut . 'T' . $emploiDuTemps->heure_debut,
                    'end' => $emploiDuTemps->date_fin . 'T' . $emploiDuTemps->heure_fin,
                    'professeur' => $emploiDuTemps->cour->Formateur->user->nom ?? 'Aucune professeur',  // Ajouter la description ici
                    'salle' => $emploiDuTemps->salle->intitule ?? 'Aucune salle',  // Ajouter la description ici
                    'classe' => $emploiDuTemps->cour->Classe->type_formation->intitule . " " . $emploiDuTemps->cour->Classe->niveau . " " . $emploiDuTemps->cour->Classe->nom_classe . " " . $emploiDuTemps->cour->Classe->type_classe ?? 'Aucune classe',  // Ajouter la description ici
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


    public function generateSchedule(Request $request)
{
    $request->validate([
        'formRecord.selectedCourses' => 'required|array',
        'formRecord.selectedCourses.*.id_cour' => 'required|integer',
        'formRecord.selectedCourses.*.parameters' => 'required|array',
        'formRecord.selectedCourses.*.parameters.totalHours' => 'required|numeric|min:1',
        'formRecord.selectedCourses.*.parameters.durationPerSession' => 'required|numeric|min:1',
        'formRecord.selectedCourses.*.parameters.offset' => 'required|numeric|min:1',
        'formRecord.selectedCourses.*.parameters.startDate' => 'required|date',
        'formRecord.selectedCourses.*.parameters.courseTimes' => 'required|string|in:morning,evening',
        'formRecord.selectedCourses.*.parameters.numberOfWeeks' => 'required|numeric|min:1',
    ]);

    $data = $request->input('formRecord');
    $allEvents = [];

    foreach ($data['selectedCourses'] as $courseData) {
        $parameters = $courseData['parameters'];

        $course = Cour::with(['Matiere', 'Formateur.user', 'Classe.type_formation'])->find($courseData['id_cour']);
        if (!$course) continue;

        $remainingHours = $parameters['totalHours'];
        $currentDate = Carbon::parse($parameters['startDate']);
        $sessionsPerWeek = floor(6 / $parameters['offset']);
        $sessionsThisWeek = 0;

        $lastEndTime = null; // Dernière heure de fin pour le jour actuel

        while ($remainingHours > 0 && $currentDate->diffInWeeks(Carbon::parse($parameters['startDate'])) < $parameters['numberOfWeeks']) {
            if ($currentDate->isWeekend()) {
                $currentDate->addDay();
                continue;
            }

            if ($sessionsThisWeek >= $sessionsPerWeek) {
                $currentDate->addWeek();
                $sessionsThisWeek = 0;
                $lastEndTime = null; // Réinitialiser l'heure de fin
                continue;
            }

            $timeSlots = $this->getTimeSlots($parameters['courseTimes'], $parameters['durationPerSession'], $currentDate);

            foreach ($timeSlots as $slot) {
                $slotStartTime = Carbon::parse($currentDate->format('Y-m-d') . ' ' . $slot['start']);

                // Ajuster l'heure de début si elle entre en conflit avec le dernier cours
                if ($lastEndTime && $slotStartTime < $lastEndTime) {
                    $slotStartTime = $lastEndTime->copy();
                    $slot['start'] = $slotStartTime->format('H:i');
                    $slot['end'] = $slotStartTime->copy()->addMinutes($parameters['durationPerSession'] * 60)->format('H:i');
                }

                // Vérifier les conflits
                if ($this->checkForConflicts($currentDate->format('Y-m-d'), $slot['start'], $slot['end'])) {
                    continue;
                }

                // Trouver une salle disponible
                $room = $this->findAvailableRoom($currentDate->format('Y-m-d'), $slot['start'], $slot['end']);
                if (!$room) continue;

                // Créer l'événement
                $event = [
                    'title' => "{$course->Matiere->intitule} ({$parameters['durationPerSession']}h)",
                    'id_cour' => $courseData['id_cour'],
                    'start' => $currentDate->format('Y-m-d') . 'T' . $slot['start'],
                    'end' => $currentDate->format('Y-m-d') . 'T' . $slot['end'],
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
                        'duree' => $parameters['durationPerSession'],
                        'heuresRestantes' => max(0, $remainingHours - $parameters['durationPerSession']),
                    ],
                ];

                $allEvents[] = $event;
                $remainingHours -= $parameters['durationPerSession'];
                $sessionsThisWeek++;
                $lastEndTime = Carbon::parse($currentDate->format('Y-m-d') . ' ' . $slot['end']);
                break;
            }

            $currentDate->addDays($parameters['offset']);
        }
    }

    return response()->json([
        'success' => true,
        'events' => $allEvents,
    ]);
}

    
    
    

    
    
   

   /*  private function checkAllAvailabilities($course, $date, $slot)
    {
        $startDateTime = Carbon::parse($date->format('Y-m-d') . ' ' . $slot['start']);
        $endDateTime = Carbon::parse($date->format('Y-m-d') . ' ' . $slot['end']);

        return $this->isFormateurAvailable($course->Formateur->id, $date, $startDateTime, $endDateTime) &&
               $this->isClasseAvailable($course->Classe->id, $date, $startDateTime, $endDateTime);
    } */

    private function getTimeSlots($period, $duration, $date)
{
    $slots = [];
    $durationMinutes = $duration * 60;

    // Plages horaires pour morning et evening
    if ($period === 'morning') {
        $startTime = '08:00';
        $maxEndTime = '16:30';
    } elseif ($period === 'evening') {
        $startTime = '17:00';
        $maxEndTime = '20:00';
    } else {
        return $slots; // Retourne un tableau vide si la période est invalide
    }

    $currentTime = Carbon::parse($startTime);

    while ($currentTime->format('H:i') < $maxEndTime) {
        $endTime = $currentTime->copy()->addMinutes($durationMinutes);

        // Si la fin dépasse la limite, on arrête
        if ($endTime->format('H:i') > $maxEndTime) {
            break;
        }

        $slots[] = [
            'start' => $currentTime->format('H:i:s'),
            'end' => $endTime->format('H:i:s'),
        ];

        // Avancer au prochain créneau
        $currentTime = $endTime;
    }

    return $slots;
}

private function checkForConflicts($date, $startTime, $endTime, $roomId = null)
{
    // Vérifier si un événement existe pour le même créneau horaire
    $query = Emploi_du_temps::where('date_debut', $date)
        ->where(function ($q) use ($startTime, $endTime) {
            $q->where(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('heure_debut', '<', $endTime)
                         ->where('heure_fin', '>', $startTime);
            });
        });

    // Si une salle est spécifiée, vérifier également la disponibilité de la salle
    if ($roomId) {
        $query->where('id_salle', $roomId);
    }

    return $query->exists();
}


    


    private function findAvailableRoom($date, $startTime, $endTime)
    {
        $rooms = Salle::all();  // Récupérer toutes les salles disponibles
    
        foreach ($rooms as $room) {
            // Vérifier les conflits pour chaque salle
            $isAvailable = !$this->checkForConflicts($date, $startTime, $endTime, $room->id);
            if ($isAvailable) {
                // Si la salle est disponible, la retourner
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
            foreach ($events as $event) {
                // Vérification des conflits avant d'enregistrer
                if ($this->checkForConflicts(
                    Carbon::parse($event['start'])->format('Y-m-d'),
                    Carbon::parse($event['start'])->format('H:i:s'),
                    Carbon::parse($event['end'])->format('H:i:s'),
                    $event['id_salle']
                )) {
                    throw new \Exception("Conflit détecté pour le cours {$event['id_cour']} à la salle {$event['id_salle']}.");
                }
    
                // Enregistrement de l'événement
                Emploi_du_temps::create([
                    'id_cour' => $event['id_cour'],
                    'date_debut' => Carbon::parse($event['start'])->format('Y-m-d'),
                    'date_fin' => Carbon::parse($event['end'])->format('Y-m-d'),
                    'heure_debut' => Carbon::parse($event['start'])->format('H:i:s'),
                    'heure_fin' => Carbon::parse($event['end'])->format('H:i:s'),
                    'id_salle' => $event['id_salle'],
                    'id_annee_academique' => $this->getCurrentAcademicYear()->id,
                ]);
            }
    
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Emploi du temps enregistré avec succès.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement : ' . $e->getMessage(),
            ], 500);
        }
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

/* private function isTimeSlotAvailable($course, $date, $startTime, $endTime)
{
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
        $classe->type_classe ?? ''
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
}
