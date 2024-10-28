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
        // Validation des données reçues via formRecord
        $request->validate([
            'formRecord.totalHours' => 'required|numeric|min:0',
            'formRecord.durationPerSession' => 'required|numeric|min:0',
            'formRecord.offset' => 'required|numeric|min:0',
            'formRecord.courseTimes' => 'required|string|in:morning,afternoon',
            'formRecord.selectedCourses' => 'required|array',
            'formRecord.date_debut' => 'required|date',
        ]);
    
        // Récupération des données du formRecord
        $data = $request->input('formRecord');
        Log::info('Received formRecord data:', $data);
    
        // Définition des variables en utilisant formRecord
        $totalHours = $data['totalHours'];
        $durationPerSession = $data['durationPerSession'];
        $offset = $data['offset'];
        $courseTimes = $data['courseTimes'];
        $selectedCourses = $data['selectedCourses'];
        $startDate = Carbon::parse($data['date_debut']);
    
        // Définition des créneaux horaires
        $timeSlots = ($courseTimes == 'morning')
            ? ['08:00', '09:00', '10:00', '11:00', '13:00']
            : ['14:30', '15:00', '16:00', '16:30'];
    
        // Calcul du nombre total de sessions et de jours requis
        $totalSessions = ceil($totalHours / $durationPerSession);
        $daysRequired = ceil($totalSessions * ($durationPerSession / 60));
        $endDate = $startDate->copy()->addDays($daysRequired + ($totalSessions - 1) * $offset);
    
        // Initialisation des événements et récupération des emplois du temps existants
        $events = [];
        $existingSchedules = emploi_du_temps::whereBetween('date_debut', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->get();
    
        // Boucle pour chaque cours sélectionné
        foreach ($selectedCourses as $courseId) {
            $course = Cour::find($courseId);
            if (!$course) {
                Log::warning('Course not found for ID: ' . $courseId);
                continue;
            }
    
            // Boucle pour chaque semaine et chaque créneau horaire
            for ($week = 0; $week < $totalSessions; $week++) {
                foreach ($timeSlots as $timeSlot) {
                    if ($totalHours <= 0) break;
    
                    // Calcul de l'heure de début et de fin pour le créneau actuel
                    $startTime = Carbon::parse($timeSlot);
                    $endTime = $startTime->copy()->addMinutes($durationPerSession * 60);
                    $currentDate = $startDate->copy()->addDays($week * ($durationPerSession / 60 + $offset))->format('Y-m-d');
    
                    // Vérification des conflits pour la salle, la date, l'heure, et la classe
                    $existingEvent = emploi_du_temps::where('date_debut', $currentDate)
                        ->where('heure_debut', $startTime->format('H:i:s'))
                        ->where('heure_fin', $endTime->format('H:i:s'))
                        ->where('id_salle', $availableRoom->id ?? null)
                        ->whereHas('cour', function ($query) use ($course) {
                            $query->where('id_classe', $course->id_classe);
                        })
                        ->first();
    
                    if ($existingEvent) {
                        return response()->json([
                            'message' => 'Conflit détecté : Un cours est déjà enregistré à la même heure et à la même date dans la même salle pour la même classe.',
                        ], 422);
                    }
    
                    // Trouver une salle disponible pour ce créneau
                    $availableRoom = $this->findAvailableRoom($currentDate, $startTime, $endTime, $existingSchedules);
    
                    if ($availableRoom) {
                        // Ajout de l'événement au tableau des événements
                        $events[] = [
                            'title' => $course->Matiere->intitule,
                            'id_cour' => $course->id,
                            'start' => $currentDate . 'T' . $startTime->format('H:i:s'),
                            'end' => $currentDate . 'T' . $endTime->format('H:i:s'),
                            'professeur' => $course->Formateur->user->nom ?? 'Aucun professeur',
                            'salle' => $availableRoom->intitule ?? 'Aucune salle',
                            'id_salle' => $availableRoom->id,
                            'classe' => $course->Classe->type_formation->intitule . " " . $course->Classe->niveau . " " . $course->Classe->nom_classe . " " . $course->Classe->type_classe ?? 'Aucune classe',
                        ];
    
                        // Mise à jour des heures totales et de la date de début pour le prochain événement
                        $totalHours -= $durationPerSession;
                        $startDate->addDays($offset);
                    } else {
                        Log::warning('No available room for date: ' . $currentDate . ' Time: ' . $startTime->format('H:i:s'));
                    }
                }
            }
        }
    
        // Retour des événements générés avec la date de fin
        return response()->json(['events' => $events, 'endDate' => $endDate->format('Y-m-d'), 'success' => true]);
    }
    
    


    private function findAvailableRoom($date, $startTime, $endTime, $existingSchedules)
    {
        $rooms = Salle::all(); // Assuming you have a Salle model for rooms

        foreach ($rooms as $room) {
            $isAvailable = true;
            foreach ($existingSchedules as $schedule) {
                if (
                    $schedule->id_salle == $room->id &&
                    $schedule->date_debut == $date &&
                    !($endTime <= Carbon::parse($schedule->heure_debut) || $startTime >= Carbon::parse($schedule->heure_fin))
                ) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {
                return $room;
            }
        }

        return null; // No available room found
    }



    public function saveSchedule(Request $request)
{
    Log::info('Données reçues dans saveSchedule:', $request->all());

    // Validation des données
    $validatedData = $request->validate([
        'formRecords' => 'required|array',
        'formRecords.*.totalHours' => 'required|integer',
        'formRecords.*.durationPerSession' => 'required|integer',
        'formRecords.*.date_debut' => 'required|date',
        'formRecords.*.offset' => 'required|integer',
        'formRecords.*.numberOfWeeks' => 'required|integer',
        'formRecords.*.id_cour' => 'required|integer', // Assurez-vous que cette ligne est correcte
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
}
    


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
