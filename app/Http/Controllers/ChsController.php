<?php

namespace App\Http\Controllers;

use PDF;
use App\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use LynX39\LaraPdfMerger\Facades\PdfMerger;

class ChsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $commissions = Commission::all();
        if (Auth::user()->is_admin) {
            $commissions = Commission::select('unite',DB::raw('YEAR(date) as year'))
                                    ->groupBy('year','unite')->get();
        }else{
            $commissions = Commission::select(DB::raw("DATE_FORMAT(date, '%Y') year"), DB::raw("count(id) as nbr"))
                                        ->where('unite',Auth::user()->unite)
                                        ->groupBy('year')->get();
        }
        //dd($commissions);
         return view('HSE.CHS.index')->with([
            'commissions' => $commissions,
        ]);
    }

    public function store(Request $request)
    {
        $commission = new Commission();
        $commission->unite = Auth::user()->unite;
        $commission->date = \Carbon\Carbon::createFromFormat('Y-m-d',$request->input('date').'-01');
        $commission->intitule = $request->input('intitule');
        $commission->reunions_chs = $request->input('reunions_chs');
        $commission->reunions_extra = $request->input('reunions_extra');
        $commission->nbr_enquete = $request->input('nbr_enquete');
        $commission->cas_recours = $request->input('cas_recours');
        
        $filename = time().'Merge.pdf';
        $pdf = PDF::loadView('HSE.CHS.page1', array('commission'=> $commission));
        // return $pdf->stream();
        $pdf->save(public_path('/uploads/commissions/'.$filename));
        
        $pdfMerger = PDFMerger::init(); //Initialize the merger
        $pdfMerger->addPDF(public_path('/uploads/commissions/'.$filename), 'all');

        if($request->hasFile('file1')){
            $file1 = $request->file('file1');
            $file1_name = time().'1.'.$file1->getClientOriginalExtension();
            $file1->move(public_path('/uploads/commissions/'),$file1_name);
            $commission->file1 = '/uploads/commissions/'.$file1_name; 
            $pdfMerger->addPDF(public_path($commission->file1), 'all');
        }

        if ($request->input('reunions_extra') > 0) {
            if($request->hasFile('file2')){
                $file2 = $request->file('file2');
                $file2_name = time().'2.'.$file2->getClientOriginalExtension();
                $file2->move(public_path('/uploads/commissions/'),$file2_name);
                $commission->file2 = '/uploads/commissions/'.$file2_name; 
                $pdfMerger->addPDF(public_path($commission->file2), 'all'); 
            }
        }

        $pdfMerger->merge();
        $pdfMerger->save(public_path('/uploads/commissions/'.$filename), "file");
        $commission->merger = '/uploads/commissions/'.$filename;
        $commission->save();
        return back();
    }

    public function update($id, Request $request)
    {
        $commission = Commission::find($id);

        $commission->date = \Carbon\Carbon::createFromFormat('Y-m-d',$request->input('date').'-01');
        $commission->intitule = $request->input('intitule');
        $commission->reunions_chs = $request->input('reunions_chs');
        $commission->reunions_extra = $request->input('reunions_extra');
        $commission->nbr_enquete = $request->input('nbr_enquete');
        $commission->cas_recours = $request->input('cas_recours');
        
        $filename = time().'Merge.pdf';
        $pdf = PDF::loadView('HSE.CHS.page1', array('commission'=> $commission));
        // return $pdf->stream();
        $pdf->save(public_path('/uploads/commissions/'.$filename));
        
        $pdfMerger = PDFMerger::init(); //Initialize the merger
        $pdfMerger->addPDF(public_path('/uploads/commissions/'.$filename), 'all');

        if($request->hasFile('file1')){
            $file1 = $request->file('file1');
            $file1_name = time().'1.'.$file1->getClientOriginalExtension();
            $file1->move(public_path('/uploads/commissions/'),$file1_name);
            $commission->file1 = '/uploads/commissions/'.$file1_name; 
        }
        $pdfMerger->addPDF(public_path($commission->file1), 'all');

        if ($request->input('reunions_extra') > 0) {
            if($request->hasFile('file2')){
                $file2 = $request->file('file2');
                $file2_name = time().'2.'.$file2->getClientOriginalExtension();
                $file2->move(public_path('/uploads/commissions/'),$file2_name);
                $commission->file2 = '/uploads/commissions/'.$file2_name; 
            }
        }else {
            $commission->file2 = null;
        }
        if($commission->file2) {
            $pdfMerger->addPDF(public_path($commission->file2), 'all'); 
        }

        $pdfMerger->merge();
        $pdfMerger->save(public_path('/uploads/commissions/'.$filename), "file");
        $commission->merger = '/uploads/commissions/'.$filename;
        $commission->save();
        return back();
    }

    public function show($year)
    {
        if (Auth::user()->is_admin) {
            $commissions = Commission::where(DB::raw('YEAR(date)'),$year)
                                    ->get();
        }else {
            $commissions = Commission::where(DB::raw('YEAR(date)'),$year)
                                    ->where('unite',Auth::user()->unite)
                                    ->get();
        }
        return view('HSE.CHS.detail')->with([
            'commissions' => $commissions,
        ]);
    }

    
    public function destroy($id){
    	$commission = Commission::find($id);
        $commission->delete();
        return back();
    }
}
