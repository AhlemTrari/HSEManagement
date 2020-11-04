<?php

namespace App\Http\Controllers;

use App\Employe;
use App\Induction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IhseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $employes = Employe::all();

        if (Auth::user()->is_admin) {
            $inductions = Induction::select(DB::raw('YEAR(date) as year'))
                                    ->groupBy('year')->get();
        }else{
            $inductions = Induction::select(DB::raw("YEAR(date) as year"))
                                        ->whereHas('employe', function ($query) {
                                            return $query->where('unite', '=', Auth::user()->unite);
                                        })->groupBy('year')->get();
        }
         return view('HSE.IHSE.index')->with([
             'employes' => $employes,
             'inductions' => $inductions,
         ]);
    }
    public function show($year)
    {
        $employes = Employe::all();
        if (Auth::user()->is_admin) {
            $inductions = Induction::where(DB::raw('YEAR(date)'),$year)
                                    ->get();
        }else {
            $inductions = Induction::where(DB::raw('YEAR(date)'),$year)
                                    ->whereHas('employe', function ($query) {
                                        return $query->where('unite', '=', Auth::user()->unite);
                                    })->get();
        }
        return view('HSE.IHSE.detail')->with([
            'inductions' => $inductions,
            'employes' => $employes,
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
        $induction = new Induction();

        $induction->employe_id = $request->input('employe_id');
        $induction->date = $request->input('date');
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/inductions/'),$file_name);
            $induction->file = '/uploads/inductions/'.$file_name; 
        }
        $induction->save();
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $induction = Induction::find($id);

        $induction->employe_id = $request->input('employe_id');
        $induction->date = $request->input('date');
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/inductions/'),$file_name);
            $induction->file = '/uploads/inductions/'.$file_name; 
        }
        $induction->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $induction = Induction::find($id);
        try{
            $induction->delete();
            return back();
        }catch(\Exception $e){
            return back()-> with('error', 'Ooops. Vous ne pouvez pas supprimer cette ligne'); 
        }
    }
}
