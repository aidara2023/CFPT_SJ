<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
class roleController extends Controller
{
    public function index() {
        $roles=Role::all();
        return view ('role.index',Compact('roles'));
    }



    
    public function ajouter (Request $request){
        $data=$request->validate([
            'intitule'=>'required'
        ]);
        $role=Role::create($data);
        if($role!=null){
            return view('role.index')->with('message','Role ajoute avec succes');
        }else{
            return redirect()->back()->with('message','Le role n\'est pas ajoute ' );
        }
    }









    
    public function mis_ajour(Request $request, $id){
        $role=Role::find($id);
        if($role!=null){
           $role->intitule=$request['intitule'];
           $role->save();
            return redirect->back()->with('message','Mise à jour effectuée avec succés.');
        }else{
            return redirect->back()->with('message','Mise à jour non effectuée ');
        }
    }
    public function supprimer($id){
        $role=Role::find($id);
        if($role!=null){
            $role->delete();
            return redirect()->back()->with('message','Role supprimé avec succés');
 
        }else{
            return redirect()->back()->with('messsage','Role non supprimer');
        }
       
    }


    
    public function show($id){
        $role=Role::find($id);
        if($role!=null){
            return view('role.show',Compact('roles'));
        }else{
            return redirect()->back()->with('messsage','le de n\'existe pas');
        }
       
    }

}
