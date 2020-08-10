<?php

namespace App\Http\Controllers;

use App\Sm;
use Illuminate\Http\Request;

class SmhseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $manuels = Sm::where('type','Manuel')->where('archive','0')->get();
        $procedures = Sm::where('type','Procedure')->where('archive','0')->get();
        $instructions = Sm::where('type','Instruction')->where('archive','0')->get();
        $enregistrements = Sm::where('type','Enregistrement')->where('archive','0')->get();
         return view('SMHSE.index')->with([
             'manuels' => $manuels,
             'procedures' => $procedures,
             'instructions' => $instructions,
             'enregistrements' => $enregistrements,
         ]);
    }
    public function indexArchives()
    {
        $manuels = Sm::where('type','Manuel')->where('archive','1')->get();
        $procedures = Sm::where('type','Procedure')->where('archive','1')->get();
        $instructions = Sm::where('type','Instruction')->where('archive','1')->get();
        $enregistrements = Sm::where('type','Enregistrement')->where('archive','1')->get();
         return view('SMHSE.archives')->with([
             'manuels' => $manuels,
             'procedures' => $procedures,
             'instructions' => $instructions,
             'enregistrements' => $enregistrements,
         ]);
    }
    public function store(Request $request)
    {
        $sm = new Sm();
        $sm->indice_revision = 'R0';
        $sm->code = $request->input('code');
        $sm->intitule = $request->input('intitule');
        $sm->type = $request->input('type');
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/SM_HSE/'),$file_name);
        }
        $sm->file = '/uploads/SM_HSE/'.$file_name; 
        
        $sm->save();
        return redirect('/S_M_HSE');
    }
    public function archiver(Request $request,$id)
    {
        $sm = Sm::find($id);
        $sm->archive = 1;
        $sm->save();

        $indice = $sm->indice_revision;
        $indice = substr( $indice,1);
        $indice++;

        $smNew = new Sm();
        $smNew->indice_revision = 'R'.$indice;
        $smNew->code = $request->input('code');
        $smNew->intitule = $request->input('intitule');
        $smNew->type = $request->input('type');
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/SM_HSE/'),$file_name);
        }
        $smNew->file = '/uploads/SM_HSE/'.$file_name; 
        
        $smNew->save();
        return redirect('/S_M_HSE');
    }
    public function destroy($id){

    	$commission = Sm::find($id);

        $commission->delete();
        return redirect('S_M_HSE');

    }
}
