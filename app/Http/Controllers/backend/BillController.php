<?php
namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Inventory;
use App\Models\Site;
use Illuminate\Http\Request;
use Auth;
class BillController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $manager_id = null;
        $site_id = null;
        $startdate = null;
        $enddate = null;
        $bills = Bill::orderBy('created_at', 'desc');
        if(Auth::user()->type == "manager"){
            $bills->where('user_id',Auth::user()->id);
        }

        if($request->manager_id !=""){
            $manager_id =$request->manager_id;
            $bills->where('user_id',$request->manager_id);
        }

        if($request->site_id !=""){
            $site_id =$request->site_id;
            $bills->where('site_id',$request->site_id);
        }

        if ($request->search !=""){
            $sort_search=$request->search;
            $bills->where(function ($query) use ($sort_search) {
                $query->orWhereHas('user', function($q2) use ($sort_search) {
                    $q2->where('name', 'LIKE', "%$sort_search%")->orWhere('phone', 'LIKE', "%$sort_search%");
                });
              });
        }

        if($request->startdate!="" && $request->enddate!=""){
            $startdate =$request->startdate;
            $enddate =$request->enddate;
            $bills->whereBetween('created_at', [$startdate, $enddate]);
        }
        $bills = $bills->paginate(10);
        return view('backend.admin.bills.index', compact('bills', 'sort_search','site_id','manager_id','startdate','enddate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventories=Inventory::where('status',1)->get();
        $sites=Site::where('status',1)->get();
        return view('backend.admin.bills.create',compact('inventories','sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'inventory_id' => 'required',
            'amount' => 'required'
        ]);
        $bill = new Bill;
        $bill->site_id = $request->site_id;
        $bill->site_name = Site::find($request->site_id)->name ?? "";
        $bill->inventory_id = $request->inventory_id;
        $bill->inventory_name = Inventory::find($request->inventory_id)->name ?? "";
        $bill->amount = $request->amount;
        $bill->comment = $request->comment;
        $bill->type = $request->type;
        $bill->user_id = Auth::user()->id;
        if($request->hasFile('image')){
            $mainpath='uploads/bills';
            $folder = public_path($mainpath);
            $fileName = date('Ymd').time().'.'.$request->image->extension();  
            $request->image->move($folder,$fileName);
            $bill->image = $mainpath."/". $fileName;
        }
        if($bill->save()){
            return redirect()->route('bills.index')
            ->with('success','Bill Added Succefully.');
        }
        return redirect()->route('bills.index')
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
        $inventories=Inventory::where('status',1)->get();
        $bill = Bill::find($id);
        return view('backend.admin.bills.edit',compact('bill','inventories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'inventory_id' => 'required',
            'amount' => 'required'
        ]);
        $bill = Bill::find($id);
        $bill->site_id = $request->site_id;
        $bill->site_name = Site::find($request->site_id)->name ?? $bill->site_name;
        $bill->inventory_id = $request->inventory_id;
        $bill->inventory_name = Inventory::find($request->inventory_id)->name ?? "";
        $bill->amount = $request->amount;
        $bill->comment = $request->comment;
        if($request->hasFile('image')){
            $mainpath='uploads/bills';
            $folder = public_path($mainpath);
            if(isset($bill->image) && $bill->image != ""){
                $path  =  asset($bill->image);
                if(file_exists($path))
                {
                   unlink($path);
                }
            }
            $fileName = date('Ymd').time().'.'.$request->image->extension();  
            $request->image->move($folder,$fileName);
            $bill->image = $mainpath."/". $fileName;
        }

        if($bill->save()){
            return redirect()->route('bills.index')
            ->with('success','Bill Updated Succefully.');
        }
        return redirect()->route('bills.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $Bill = Bill::where('id', $request->id)->first();
        if(isset($Bill->image) && $Bill->image != ""){
            $path  =  asset($Bill->image);
            if(file_exists($path))
            {
               unlink($path);
            }
        }
        if($Bill->delete()){
            return redirect()->route('bills.index')
            ->with('success','Bill Deleted Succefully.');
        }
        return redirect()->route('requirements.index')
        ->with('error','Something went wrong!');
    }
}
