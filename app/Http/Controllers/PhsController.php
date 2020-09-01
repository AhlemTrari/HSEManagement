<?php

namespace App\Http\Controllers;

use App\PlanHygiene;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $plans = PlanHygiene::all();
         return view('HSE.PHS.index')->with([
             'plans' => $plans,
         ]);
    }
    public function store(Request $request)
    {
        $plan = new PlanHygiene();

        $plan->intitule = $request->input('intitule');
        $plan->projet = $request->input('projet');
        $plan->unite = Auth::user()->unite;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/Plans/'),$file_name);
        }
        $plan->file = '/uploads/Plans/'.$file_name; 

        $plan->save();

        return back();
    }
    public function destroy($id){
    	$plan = PlanHygiene::find($id);
        $plan->delete();
        return back();
    }
}
