<?php

namespace App\Http\Controllers;

use App\Carte;
use App\Emplacement;
use App\CarteEmplacement;
use Illuminate\Http\Request;

class CarteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $emplacementIds = Carte::select('emplacement_id')
                                ->groupBy('emplacement_id')->pluck('emplacement_id')->toArray();
        $emplacements = CarteEmplacement::find($emplacementIds);

        $allEmplacements = CarteEmplacement::all();
        return view('cartes.index')->with([
            'emplacements' => $emplacements,
            'allEmplacements' => $allEmplacements,
        ]);
    }
    public function detail($id)
    {
        $emplacement = CarteEmplacement::find($id);
        return view('cartes.detail')->with([
            'emplacement' => $emplacement,
        ]);
    }
    public function store(Request $request)
    {
        $carte = new Carte();
        $carte->date = $request->input('date');
        $carte->intitule = $request->input('intitule');
        $carte->emplacement_id = $request->input('emplacement');
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/Cartes/'),$file_name);
        }
        $carte->file = '/uploads/Cartes/'.$file_name; 
        
        $carte->save();
        return redirect('/Cartes');
    }
    public function storeEmplacement(Request $request)
    {
        $emplacement = new CarteEmplacement();
        $emplacement->intitule = $request->input('intitule');
        
        $emplacement->save();
    }
    
    public function destroy($id){
    	$carte = Carte::find($id);
        $carte->delete();
        return back();
    }

}
