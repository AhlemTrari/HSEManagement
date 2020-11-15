<?php

namespace App\Http\Controllers;

use App\Unite;
use Illuminate\Http\Request;

class UniteController extends Controller
{
    public function index()
    {
        $unites = Unite::all();

        return view('unite.index')->with([
            'unites' => $unites,
        ]);
    }

    public function store(Request $request)
    {
        $unite = new Unite();
        
        $unite->nom = $request->input('nom');
        // $unite->adresse = $request->input('adresse');
        $unite->save();

        return back();
    }
    public function destroy($id)
    {
        $unite = Unite::find($id);
        try{
            $unite->delete();
            return back();
        }catch(\Exception $e){
            return back()-> with('error', 'Ooops. Vous ne pouvez pas supprimer ligne '); 
        }
    }
}
