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
use Illuminate\Support\Facades\Auth;

class emploi_du_temps_controller extends Controller
{
    public function all() {
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

    public function getcoursfromemploidutemps(Request $request) {
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
                    'classe' => $emploiDuTemps->cour->Classe->type_formation->intitule ." ".$emploiDuTemps->cour->Classe->niveau." ".$emploiDuTemps->cour->Classe->nom_classe." ".$emploiDuTemps->cour->Classe->type_classe?? 'Aucune classe',  // Ajouter la description ici
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
    public function getcoursfromemploidutempsOld() {
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
                 'start'=> $emploiDuTemps->date_debut . 'T'.$emploiDuTemps->heure_debut,
                 'end'=> $emploiDuTemps->date_fin . 'T'.$emploiDuTemps->heure_fin,
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
    

    public function all_paginate(Request $request) {
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

    public function get_last_value() {
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

    public function store(emploi_du_temps_request $request) {
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
}



    public function update(emploi_du_temps_request $request, $id) {
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

    public function delete($id) {
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

    public function show($id) {
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
    $data = $request->all();
    
    // Extract parameters
    $totalHours = $data['totalHours'];
    $durationPerSession = $data['durationPerSession'];
    $offset = $data['offset'];
    $numberOfWeeks = $data['numberOfWeeks'];
    $courseTimes = $data['courseTimes'];
    $selectedCourses = $data['selectedCourses'];
    
    // Determine time slots
    $timeSlots = ($courseTimes == 'morning') 
        ? ['08:00', '09:00', '10:00', '11:00', '13:00']
        : ['14:30', '15:00', '16:00', '16:30'];
    
    $events = [];
    $startDate = Carbon::now();
    $existingSchedules = emploi_du_temps::whereBetween('date_debut', [$startDate->format('Y-m-d'), $startDate->addWeeks($numberOfWeeks)->format('Y-m-d')])
    ->get();
    
    foreach ($selectedCourses as $courseId) {
        $course = Cour::find($courseId);
        for ($week = 0; $week < $numberOfWeeks; $week++) {
            foreach ($timeSlots as $timeSlot) {
                if ($totalHours <= 0) break;
                
                $startTime = Carbon::parse($timeSlot);
                $endTime = $startTime->copy()->addMinutes($durationPerSession * 60);
                $currentDate = $startDate->copy()->addWeeks($week)->format('Y-m-d');
                
                // Check room availability
               // $availableRoom = $this->findAvailableRoom($currentDate, $startTime, $endTime);
                $availableRoom = $this->findAvailableRoom($currentDate, $startTime, $endTime, $existingSchedules);

                
                if ($availableRoom) {
                    // Generate event for each selected course
                    $events[] = [
                        'title' => $course->Matiere->intitule,
                        'id_cour' => $course->id,
                        'start' => $currentDate . 'T' . $startTime->format('H:i:s'),
                        'end' => $currentDate . 'T' . $endTime->format('H:i:s'),
                      
                        'professeur' => $course->Formateur->user->nom ?? 'Aucune professeur',
'salle' => $availableRoom->intitule ?? 'Aucune salle', 
'id_salle' => $availableRoom->id, 
 'classe' => $course->Classe->type_formation->intitule ." ".$course->Classe->niveau." ".$course->Classe->nom_classe." ".$course->Classe->type_classe?? 'Aucune classe',
                    ];

                    $totalHours -= $durationPerSession;

                    // Apply offset for next session
                    $startDate->addDays($offset);
                } else {
                    // If no room is available, you might want to handle it
                    // For example, you can skip the session or log a warning
                }
            }
        }
    }
    
    return response()->json(['events' => $events]);
}


private function findAvailableRoom($date, $startTime, $endTime, $existingSchedules)
{
    $rooms = Salle::all(); // Assuming you have a Salle model for rooms
    
    foreach ($rooms as $room) {
        $isAvailable = true;
        foreach ($existingSchedules as $schedule) {
            if ($schedule->id_salle == $room->id &&
                $schedule->date_debut == $date &&
                !($endTime <= Carbon::parse($schedule->heure_debut) || $startTime >= Carbon::parse($schedule->heure_fin))) {
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
        $events = $request->events;
        $currentYear = Carbon::now()->year;

// Construct the academic year string, e.g., "2023 - 2024"
$academicYearString = ($currentYear - 1) . ' - ' . $currentYear;
$academicYear = Annee_academique::where('intitule', $academicYearString)->first();

        
        foreach ($events as $event) {
            emploi_du_temps::create([
                'id_cour' => $event['id_cour'], // Assuming you send courseId with the event
                'id_annee_academique' => $academicYear->id, // Assuming you send yearId with the event
                'date_debut' => Carbon::parse($event['start'])->toDateString(),
                'date_fin' => Carbon::parse($event['start'])->toDateString(),
                'heure_debut' => Carbon::parse($event['start'])->toTimeString(),
                'heure_fin' => Carbon::parse($event['end'])->toTimeString(),
                'id_salle' => $event['id_salle'], // Assuming you send roomId with the event
            ]);
        }
        
        return response()->json(['success' => true]);
    }

    public function afficherEmploiDuTemps()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user(); 

        // Trouver le formateur correspondant à cet utilisateur
        $formateur = Formateur::where('id_user', $user->id)->first();

        if (!$formateur) {
            return response()->json(['message' => 'Formateur non trouvé'], 404);
        }

        // Récupérer les cours du formateur
        $cours = Cour::where('id_formateur', $formateur->id)->get();

        // Récupérer l'emploi du temps des cours du formateur
        $emploiDuTemps = Emploi_du_temps::whereIn('id_cours', $cours->pluck('id'))->get();

        // Retourner la vue avec l'emploi du temps
        return view('emploi_du_temps', compact('emploiDuTemps'));
    }
}
