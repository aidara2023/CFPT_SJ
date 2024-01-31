<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index() {
        $audit=Audit::with('user')->orderBy('created_at', 'desc')->get();
        if($audit!=null){
            return response()->json([
                'statut'=>200,
                'audit'=>$audit
            ],200)  ;
        }else{
            return response()->json([ 
                'statut'=>500,
                'message'=>'Aucune donnée trouvée',
            ],500 );
        }
     }
}
