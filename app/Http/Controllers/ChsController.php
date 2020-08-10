<?php

namespace App\Http\Controllers;

use App\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $commissions = Commission::all();
         return view('HSE.CHS.index')->with([
            // 'commissions' => $commissions,
        ]);
    }

    public function store(Request $request)
    {
        $commission = new Commission();
        $commission->unite = Auth::user()->unite;
        $commission->date = $request->input('date');
        $commission->intitule = $request->input('intitule');
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/commissions/'),$file_name);
        }
        $commission->file = '/uploads/freelancers/'.$file_name; 
        
        $commission->save();
        return redirect('/CommissionHygieneSecurite');
    }
}
