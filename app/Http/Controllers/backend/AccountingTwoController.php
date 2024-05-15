<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\AccountingTwo;
use App\Models\Site;
use App\Models\Inventory;
use Illuminate\Http\Request;

class AccountingTwoController extends Controller
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
        $total_credit =AccountingTwo::where('type','CR');
        $total_debit =AccountingTwo::where('type','DR');
        $accounting =AccountingTwo::orderBy('created_at', 'desc');

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
        $total_credit=$total_credit->sum('gst_credit') ?? 0;
        $total_debit=$total_debit->sum('gst_credit') ?? 0;
        $total_grand = $total_credit-$total_debit;
        return view('backend.admin.accountingtwo.index', compact('accounting', 'sort_search','site_id','startdate','enddate','total_credit','total_debit','total_grand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sites=Site::get();
        $inventories=Inventory::where('status',1)->get();
        return view('backend.admin.accountingtwo.create',compact('sites','inventories'));
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
        $accounting = new AccountingTwo;
        $accounting->site_id = $request->site_id;
        $accounting->site_name = Site::find($request->site_id)->name ?? "";
        $accounting->gst_no = $request->gst_no;
        $accounting->gst_percentage = $request->gst_percentage;
        $accounting->amount = $request->amount;
        $accounting->gst_credit = $request->gst_credit;
        $accounting->inventory = $request->inventory;
        $accounting->inventory_name = Inventory::find($request->inventory)->name ?? "";
        $accounting->type = $request->type;
        $accounting->accounting_date = $request->accounting_date;
        if($request->hasFile('image')){
            $mainpath='uploads/account_two';
            $folder = public_path($mainpath);
            $fileName = date('Ymd').time().'.'.$request->image->extension();  
            $request->image->move($folder,$fileName);
            $accounting->image = $mainpath."/". $fileName;
        }
        if($accounting->save()){
            return redirect()->route('accountingtwo.index')
            ->with('success','Added Succefully.');
        }
        return redirect()->route('accountingtwo.index')
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
        $accounting =AccountingTwo::find($id);
        $sites=Site::get();
        $inventories=Inventory::where('status',1)->get();
        return view('backend.admin.accountingtwo.edit',compact('accounting','sites','inventories'));
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
        $accounting =AccountingTwo::find($id);
        $accounting->site_id = $request->site_id;
        $accounting->site_name = Site::find($request->site_id)->name ?? "";
        $accounting->gst_no = $request->gst_no;
        $accounting->gst_percentage = $request->gst_percentage;
        $accounting->amount = $request->amount;
        $accounting->gst_credit = $request->gst_credit;
        $accounting->inventory = $request->inventory;
        $accounting->inventory_name = Inventory::find($request->inventory)->name ?? "";
        $accounting->type = $request->type;
        $accounting->accounting_date = $request->accounting_date;
        if($request->hasFile('image')){
            $mainpath='uploads/account_two';
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
            return redirect()->route('accountingtwo.index')
            ->with('success','Updated Succefully.');
        }
        return redirect()->route('accountingtwo.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $accounting =AccountingTwo::where('id', $request->id)->first();
        if(isset($accounting->image) && $accounting->image != ""){
            $path  =  asset($accounting->image);
            if(file_exists($path))
            {
               unlink($path);
            }
        }
        if($accounting->delete()){
            return redirect()->route('accountingtwo.index')
            ->with('success','Deleted Succefully.');
        }
        return redirect()->route('accountingtwo.index')
        ->with('error','Something went wrong!');
    }

    public function status($id,$status)
    {
        $accounting = AccountingTwo::find($id);
        $accounting->status = $status;
        if($accounting->save()){
            return redirect()->route('accountingtwo.index')
            ->with('success','Accounting Updated Succefully.');
        }
        return redirect()->route('accountingtwo.index')
        ->with('error','Something went wrong!');
    }
}
