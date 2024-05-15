<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\Site;
use Illuminate\Http\Request;
use Auth;
class AccountingController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $site_id = null;
        $startdate = null;
        $enddate = null;
        $total_credit = Accounting::where('type','CR');
        $total_debit = Accounting::where('type','DR');
       
        $accounting = Accounting::orderBy('created_at', 'desc');

        if($request->site_id !=""){
            $site_id =$request->site_id;
            $accounting->where('site_id',$request->site_id);
            $total_credit->where('site_id',$request->site_id);
            $total_debit->where('site_id',$request->site_id);
        }

        if ($request->search !=""){
            $sort_search=$request->search;
            $accounting->where('site_name', 'LIKE', "%$sort_search%");
            $total_credit->where('site_name', 'LIKE', "%$sort_search%");
            $total_debit->where('site_name', 'LIKE', "%$sort_search%");
        }

        if($request->startdate!="" && $request->enddate!=""){
            $startdate =$request->startdate;
            $enddate =$request->enddate;
            $accounting->whereBetween('accounting_date', [$startdate, $enddate]);
            $total_credit->whereBetween('accounting_date', [$startdate, $enddate]);
            $total_debit->whereBetween('accounting_date', [$startdate, $enddate]);
        }
        $accounting = $accounting->paginate(10);
        $total_credit = $total_credit->sum('amount') ?? 0;
        $total_debit = $total_debit->sum('amount') ?? 0;
        $total_grand = $total_credit-$total_debit;
        return view('backend.admin.accounting.index', compact('accounting', 'sort_search','site_id','startdate','enddate','total_credit','total_debit','total_grand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sites=Site::get();
        return view('backend.admin.accounting.create',compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'site_id' => 'required',
            'amount' => 'required',
            'accounting_date' => 'required',
        ]);
        $accounting = new Accounting;
        $accounting->site_id = $request->site_id;
        $accounting->site_name = Site::find($request->site_id)->name ?? "";
        $accounting->amount = $request->amount;
        $accounting->type = $request->type;
        $accounting->comment = $request->comment;
        $accounting->accounting_date = $request->accounting_date;
        if($request->hasFile('image')){
            $mainpath='uploads/accounting';
            $folder = public_path($mainpath);
            $fileName = date('Ymd').time().'.'.$request->image->extension();  
            $request->image->move($folder,$fileName);
            $accounting->image = $mainpath."/". $fileName;
        }
        if($accounting->save()){
            return redirect()->route('accounting.index')
            ->with('success','Added Succefully.');
        }
        return redirect()->route('accounting.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $accounting = Accounting::find($id);
        $sites=Site::get();
        return view('backend.admin.accounting.edit',compact('accounting','sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'site_id' => 'required',
            'amount' => 'required',
            'accounting_date' => 'required',
        ]);
        $accounting = Accounting::find($id);
        $accounting->site_id = $request->site_id;
        $accounting->site_name = Site::find($request->site_id)->name ?? "";
        $accounting->amount = $request->amount;
        $accounting->type = $request->type;
        $accounting->comment = $request->comment;
        $accounting->accounting_date = $request->accounting_date;
        if($request->hasFile('image')){
            $mainpath='uploads/accounting';
            $folder = public_path($mainpath);
            if(isset($accounting->image) && $accounting->image != ""){
                $path  =  asset($accounting->image);
                if(file_exists($path))
                {
                   unlink($path);
                }
            }
            $fileName = date('Ymd').time().'.'.$request->image->extension();  
            $request->image->move($folder,$fileName);
            $accounting->image = $mainpath."/". $fileName;
        }

        if($accounting->save()){
            return redirect()->route('accounting.index')
            ->with('success','Updated Succefully.');
        }
        return redirect()->route('accounting.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $accounting = Accounting::where('id', $request->id)->first();
        if(isset($accounting->image) && $accounting->image != ""){
            $path  =  asset($accounting->image);
            if(file_exists($path))
            {
               unlink($path);
            }
        }
        if($accounting->delete()){
            return redirect()->route('accounting.index')
            ->with('success','Deleted Succefully.');
        }
        return redirect()->route('requirements.index')
        ->with('error','Something went wrong!');
    }
}
