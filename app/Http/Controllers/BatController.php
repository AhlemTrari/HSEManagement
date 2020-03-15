<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
         return view('HSE.BAT.index');
    }

    public function create()
    {
         return view('HSE.BAT.create');
    }

    public function details()
    {
        return view('HSE.BAT.details');
    }

    public function store(Request $request)
    {
        return redirect('/BilanAccidentT/details');
    }
    public function showBilanMois()
    {
        return view('HSE.BAT.showBilanMois');
    }
    public function showBilanTrimestre()
    {
        return view('HSE.BAT.showBilanTrimestre');
    }
    public function showBilanSemestre()
    {
        return view('HSE.BAT.showBilanSemestre');
    }
}
