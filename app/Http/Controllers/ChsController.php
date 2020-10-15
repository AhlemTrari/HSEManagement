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
        $commission->reunions_chs = $request->input('reunions_chs');
        $commission->reunions_extra = $request->input('reunions_extra');
        $commission->nbr_enquete = $request->input('nbr_enquete');
        $commission->cas_recours = $request->input('cas_recours');
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/uploads/commissions/'),$file_name);
        }
        $commission->file = '/uploads/commissions/'.$file_name; 
        
        $commission->save();
        return redirect('/CommissionHygieneSecurite');
    }
}
