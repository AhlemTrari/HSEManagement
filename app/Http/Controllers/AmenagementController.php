<?php

namespace App\Http\Controllers;

use App\Amenagement;
use App\Employe;
use App\Fonction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\AmqpCaster;

class AmenagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = Employe::where('unite',Auth::user()->unite)->get();
        $fonctions = Fonction::all();

        if (Auth::user()->is_admin) {
            $amenagements = Amenagement::all();
        }else {
            $amenagements = Amenagement::whereHas('employe', function ($query) {
                                        return $query->where('unite', '=', Auth::user()->unite);
                                    })->get();
        }
        return view('HSE.AP.index')->with([
            'employes' => $employes,
            'amenagements' => $amenagements,
            'fonctions' => $fonctions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $amenagement = new Amenagement();
        $employe = Employe::find($request->input('employe_id'));

        $amenagement->employe_id = $request->input('employe_id');
        $amenagement->old_post = $employe->fonction;
        $amenagement->new_post = $request->input('new_post');
        $amenagement->visite = $request->input('visite');
        $amenagement->date = $request->input('date');
        $amenagement->save();

        $employe->fonction = $request->input('new_post');
        $employe->save();

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Amenagement  $amenagement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $amenagement = Amenagement::find($id);

        $employe = Employe::find($amenagement->employe_id);
        $employe->fonction = $amenagement->old_post;
        $employe->save();
        
        try{
            $amenagement->delete();
            return back();
        }catch(\Exception $e){
            return back()-> with('error', 'Ooops. Vous ne pouvez pas supprimer cette déclaration '); 
        }
    }
}
