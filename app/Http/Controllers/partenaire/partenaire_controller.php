<?php

namespace App\Http\Controllers\partenaire;

use App\Events\ModelCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\partenaire\partenaire_request;
use App\Models\Paiement;
use App\Models\Partenaire;
use Illuminate\Http\Request;

class partenaire_controller extends Controller
{
       public function index()
        {
            $partenaires = Partenaire::with('direction', 'user')->orderBy('created_at', 'desc')->get();
            if ($partenaires->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'partenaire' => $partenaires
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Aucune donnée trouvée',
                ], 500);
            }
        }

        public function get_last()
        {
            $paiement = Paiement::with('eleve.user', 'eleve.inscription.classe', 'eleve.inscription.classe.type_formation' , 'concerner.mois', 'concerner.annee_academique')->take(6)->orderBy('created_at', 'desc')->get();
            if ($paiement != null) {
                return response()->json([
                    'statut' => 200,
                    'paiement' => $paiement
                ], 200);
            } else {
                return response()->json([
                    'statut' => 500,
                    'message' => 'Aucune donnée trouvée'
                ], 500);
            }
        }
    
        public function store(partenaire_request $request)
        {
            $data = $request->validated();
            $verification =Partenaire::where('nom_partenaire', $request['nom_partenaire'])->get();

            if($verification->count()!=0){
                return response()->json([ 
                    'statut'=>404,
                    'message'=>'Ce partenaire existe déja',
                ],404 );
            }else{
                $partenaire = Partenaire::create($data);
                if($partenaire!=null){
                    event(new ModelCreated($partenaire));
                    return response()->json([
                        'statut'=>200,
                        'partenaire'=>$partenaire
                    ],200)  ;
                }else{
                    return response()->json([ 
                        'statut'=>500,
                        'message'=>'L\'enregistrement n\'a pas été ajouté',
                    ],500 );
                }
            }
          
        }

        public function all_paginate(Request $request){

            $perPage = $request->has('per_page') ? $request->per_page : 15;
            $partenaire = Partenaire::with('direction', 'user')->orderBy('created_at', 'desc')->paginate($perPage);
            if($partenaire != null){
                return response()->json([
                    'statut' => 200,
                    'partenaire' => $partenaire
                ],200);
            } else {
                return response()->json([
                    'statut' => 500,
                    'message' => 'Aucun enregistrement n\'a été trouvé'
                ],500);
            }
        }

        public function get_five_laste(){
            $partenaire = Partenaire::with('direction', 'user')->orderBy('created_at', 'desc')->take(5)->get();
            if($partenaire != null){
                return response()->json([
                    'statut' => 200,
                    'partenaire' => $partenaire
                ],200);
            } else {
                return response()->json([
                    'statut' => 500,
                    'message' => 'Aucun enregistrement n\'a été trouvé'
                ],500);
            }
        }
    
        public function update(partenaire_request $request, $id)
        {
            $partenaire = Partenaire::find($id);
            if ($partenaire) {
                $data = $request->validated();
    
                    $partenaire->nom_partenaire = $data->nom_partenaire;
                    $partenaire->description = $data->description;
                    $partenaire->contact= $data->contact;
                    $partenaire->adresse= $data->adresse;
                    $partenaire->email= $data->email;
                    $partenaire->boite_postale= $data->boite_postale;
                    $partenaire->date_debut= $data->date_debut;
                    $partenaire->date_fin= $data->date_fin;
                    $partenaire->id_direction= $data->id_direction;
                    $partenaire->type= $data->type;
                    $partenaire->exoneration= $data->exoneration;
                    $partenaire->id_user= $data->id_user;
              

                    $partenaire->save();
              
    
                return response()->json([
                    'status' => 200,
                    'partenaire' => $partenaire
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'La mise à jour n\'a pas été effectuée',
                ], 500);
            }
        }
    
        public function delete($id)
        {
            $partenaire = Partenaire::find($id);
            if ($partenaire) {
                $partenaire->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Partenaire supprimé avec succès',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Le partenaire n\'a pas été supprimé',
                ], 500);
            }
        }
    
        public function show($id)
        {
            $partenaire = Partenaire::find($id);
            if ($partenaire) {
                return response()->json([
                    'status' => 200,
                    'partenaire' => $partenaire
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Le partenaire n\'existe pas',
                ], 500);
            }
        }
    }
    