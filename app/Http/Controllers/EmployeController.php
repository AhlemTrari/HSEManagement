<?php

namespace App\Http\Controllers;

use App\Employe;
use App\Fonction;
use Illuminate\Http\Request;
use App\Exports\EmployeExport;
use App\Imports\EmployeImport;
use App\Exports\EmployesExport;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;



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
        $employe->prenom = $request->input('prenom');
        $employe->fonction = $request->input('fonction');
        $employe->unite = $request->input('unite');
        $employe->tel = $request->input('tel');
        $employe->adresse = $request->input('adresse');
        $employe->date_naissance = $request->input('date_naissance');
        $employe->date_rec = $request->input('date_rec');

        $employe->save();

        return redirect('employes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $id)
    {
        //
    }

    public function update(Request $request, Employe $id)
    {
       $employe = Employe::find($id);
    }
     
    public function destroy(Employe $id)
    {
        $employe = Employe::find($id);
        $employe->delete();
        return redirect('employes');
    }

    public function import(Request $request)
     {
        if($request->hasFile('file')){
            Excel::import(new EmployeImport,request()->file('file'));
        }

        return back();
     }

      public function export() 
    {
        return Excel::download(new EmployesExport, 'employes.xlsx');
    }
   
}
