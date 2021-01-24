<?php

namespace App\Http\Controllers;

use cache;
use PDF;
use App\Employe;
use App\Fonction;
use Illuminate\Http\Request;
use App\Exports\EmployeExport;
use App\Imports\EmployeImport;
use App\Exports\EmployesExport;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;



class EmployeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fcts = Fonction::all();
        if (Auth::user()->is_admin) {
            $employes = Employe::all();
        }else{
            $employes = Employe::where('unite',Auth::user()->unite)->get();
        }
         return view('employe.index')->with([
            'fonctions' => $fcts,
            'employes' => $employes,
        ]);
    }

    public function store(Request $request)
    {
        $employe = new Employe();

        $employe->matricule = $request->input('matricule');
        $employe->nom = $request->input('nom');
        $employe->sexe = $request->input('sexe');
        $employe->fonction = $request->input('fonction');
        $employe->unite = Auth::user()->unite;
        $employe->statut = $request->input('statut');
        $employe->date_naissance = $request->input('date_naissance');
        $employe->lieu_naissance = $request->input('lieu_naissance');
        $employe->adresse = $request->input('adresse');
        $employe->situation = $request->input('situation');
        $employe->num_sociale = $request->input('num_sociale');
        $employe->date_rec = $request->input('date_rec');
        $employe->affectation = $request->input('affectation');
        $employe->poste_risque = $request->input('poste_risque');
        $employe->visite_embauche = $request->input('visite_embauche');

        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/employes/'),$file_name);
            $employe->photo = '/uploads/employes/'.$file_name; 
        }

        $employe->save();

        return redirect('employes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employe = Employe::find($id);
        return view('employe.profil')->with([
            'employe' => $employe
        ]);
    }

    public function update(Request $request, $id)
    {
       $employe = Employe::find($id);
        
       $employe->matricule = $request->input('matricule');
       $employe->nom = $request->input('nom');
       $employe->sexe = $request->input('sexe');
       $employe->fonction = $request->input('fonction');
       $employe->statut = $request->input('statut');
       $employe->date_naissance = $request->input('date_naissance');
       $employe->lieu_naissance = $request->input('lieu_naissance');
       $employe->adresse = $request->input('adresse');
       $employe->situation = $request->input('situation');
       $employe->num_sociale = $request->input('num_sociale');
       $employe->date_rec = $request->input('date_rec');
       $employe->affectation = $request->input('affectation');
       $employe->poste_risque = $request->input('poste_risque');
       $employe->visite_embauche = $request->input('visite_embauche');

       if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/employes/'),$file_name);
            $employe->photo = '/uploads/employes/'.$file_name; 
        }

       $employe->save();
       return back();
    }
     
    public function destroy($id)
    {
        $employe = Employe::find($id);
        try{
            $employe->delete();
            return back();
        }catch(\Exception $e){
            return back()-> with('error', 'Ooops. Vous ne pouvez pas supprimer  '.$employe->nom); 
        }
    }

    public function import(Request $request)
     {
        if($request->hasFile('file')){
            Excel::import(new EmployeImport,request()->file('file'));
        }

        return back();
     }
     
    public function exportProfil($id)
    {   
        $employe = Employe::with('unitee')->get()->find($id);
        $pdf = PDF::loadView('employe.exportProfil', array('employe'=> $employe) );
        return $pdf->stream();
    }

      public function export() 
    {
        return Excel::download(new EmployesExport(), 'employes.xlsx');
    }
   
}
