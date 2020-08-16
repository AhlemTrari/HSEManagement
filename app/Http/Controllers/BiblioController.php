<?php

namespace App\Http\Controllers;

use App\Biblio;
use App\BiblioEmplacement;
use Illuminate\Http\Request;

class BiblioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $emplacementIds = Biblio::select('emplacement_id')
                                ->groupBy('emplacement_id')->pluck('emplacement_id')->toArray();
        $emplacements = BiblioEmplacement::find($emplacementIds);

        $allEmplacements = BiblioEmplacement::all();
        return view('biblio.index')->with([
            'emplacements' => $emplacements,
            'allEmplacements' => $allEmplacements,
        ]);
    }
    public function detail($id)
    {
        $emplacement = BiblioEmplacement::find($id);
        return view('biblio.detail')->with([
            'emplacement' => $emplacement,
        ]);
    }

    public function store(Request $request)
    {
        $biblio = new Biblio();
        $biblio->intitule = $request->input('intitule');
        $biblio->emplacement_id = $request->input('emplacement');
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/Biblio/'),$file_name);
        }
        $biblio->file = '/uploads/Biblio/'.$file_name; 
        
        $biblio->save();
        return redirect('/Bibliotheque');
    }
    public function storeEmplacement(Request $request)
    {
        $emplacement = new BiblioEmplacement();
        $emplacement->intitule = $request->input('intitule');
        
        $emplacement->save();
    }

    public function destroy($id){
    	$biblio = Biblio::find($id);
        $biblio->delete();
        return back();
    }
}
