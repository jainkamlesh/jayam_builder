<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\LumsumPaid;
use Illuminate\Http\Request;
use App\Models\Dealer;
use Auth;
class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $dealer_id=null;
        $startdate = null;
        $enddate = null;
        $materials = Material::orderBy('created_at', 'desc');
        $lumsumpaid = LumsumPaid::orderBy('created_at', 'desc');
        $totalamount = Material::orderBy('created_at', 'desc');
        $paidamount = LumsumPaid::orderBy('created_at', 'desc');
        if(Auth::user()->type == "manager"){
            $materials->where('user_id',Auth::user()->id);
        }
        if ($request->has('search')){
            $sort_search=$request->search;
            $materials->where('material_name', 'LIKE', "%$sort_search%");
        }
        if(Auth::user()->type == "admin" && $request->dealer_id!=""){
            $dealer_id =$request->dealer_id;
            $materials->where('dealer_id',  $dealer_id);
            $lumsumpaid->where('dealer_id',  $dealer_id);
            $totalamount->where('dealer_id',  $dealer_id);
            $paidamount->where('dealer_id',  $dealer_id);
        }

        if(Auth::user()->type == "admin" && $request->startdate!="" && $request->enddate!=""){
            $startdate =$request->startdate;
            $enddate =$request->enddate;
            $materials->whereBetween('created_at', [$startdate, $enddate]);
            $lumsumpaid->whereBetween('paid_date', [$startdate, $enddate]);
            $totalamount->whereBetween('created_at', [$startdate, $enddate]);
            $paidamount->whereBetween('paid_date', [$startdate, $enddate]);
        }
        $materials = $materials->paginate(10);
        $lumsumpaid = $lumsumpaid->paginate(10);
        $totalamount=$totalamount->sum('amount') ?? 0;
        $paidamount=$paidamount->sum('amount') ?? 0;
        $pendingamount = $totalamount-$paidamount;
        return view('backend.admin.materials.index', compact('materials','lumsumpaid', 'sort_search','dealer_id','startdate','enddate','totalamount','paidamount','pendingamount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dealers=Dealer::where('status',1)->get();
        return view('backend.admin.materials.create',compact('dealers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'material_name' => 'required',
            'dealer_id' => 'required',
            'quantity' => 'required'
        ]);
        $material = new Material;
        $material->material_name = $request->material_name;
        $material->dealer_id = $request->dealer_id;
        $material->dealer_name = Dealer::find($request->dealer_id)->name ?? "";
        $material->quantity = $request->quantity;
        $material->bill_no = $request->bill_no;
        $material->gadi_no = $request->gadi_no;
        $material->amount = $request->amount;
        $material->user_id = Auth::user()->id;
        if($request->hasFile('image')){
            $mainpath='uploads/material';
            $folder = public_path($mainpath);
            $fileName = date('Ymd').time().'.'.$request->image->extension();  
            $request->image->move($folder,$fileName);
            $material->image = $mainpath."/". $fileName;
        }
        if($material->save()){
            return redirect()->route('materials.index')
            ->with('success','Material Added Succefully.');
        }
        return redirect()->route('materials.index')
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
        $dealers=Dealer::where('status',1)->get();
        $material = Material::find($id);
        return view('backend.admin.materials.edit',compact('material','dealers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'material_name' => 'required',
            'dealer_id' => 'required',
            'quantity' => 'required'
        ]);

        $material = Material::find($id);
        $material->material_name = $request->material_name;
        $material->dealer_id = $request->dealer_id;
        $material->dealer_name = Dealer::find($request->dealer_id)->name ?? "";
        $material->quantity = $request->quantity;
        $material->bill_no = $request->bill_no;
        $material->gadi_no = $request->gadi_no;
        $material->amount = $request->amount;
        if($request->hasFile('image')){
            $mainpath='uploads/material';
            $folder = public_path($mainpath);
            if(isset($material->image) && $material->image != ""){
                $path  =  asset($material->image);
                if(file_exists($path))
                {
                   unlink($path);
                }
            }
            $fileName = date('Ymd').time().'.'.$request->image->extension();  
            $request->image->move($folder,$fileName);
            $material->image = $mainpath."/". $fileName;
        }

        if($material->save()){
            return redirect()->route('materials.index')
            ->with('success','Material Updated Succefully.');
        }
        return redirect()->route('materials.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $material = Material::where('id', $request->id)->first();
        if($material->delete()){
            return redirect()->route('materials.index')
            ->with('success','Material Deleted Succefully.');
        }
        return redirect()->route('materials.index')
        ->with('error','Something went wrong!');
    }


     /**
     * Show the form for creating a new resource.
     */
    public function create_lumsum()
    {
        $dealers=Dealer::where('status',1)->get();
        return view('backend.admin.materials.create_lumsum',compact('dealers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_lumsum(Request $request)
    {
        $validatedData = $request->validate([
            'dealer_id' => 'required',
            'bill_no' => 'required',
            'amount' => 'required',
            'paid_date' => 'required'
        ]);
        $lumsumpaid = new LumsumPaid;
        $lumsumpaid->dealer_id = $request->dealer_id;
        $lumsumpaid->dealer_name = Dealer::find($request->dealer_id)->name ?? "";
        $lumsumpaid->bill_no = $request->bill_no;
        $lumsumpaid->amount = $request->amount;
        $lumsumpaid->user_id = Auth::user()->id;
        $lumsumpaid->paid_date = $request->paid_date;
        if($lumsumpaid->save()){
            return redirect()->route('materials.index')
            ->with('success','Paid Succefully.');
        }
        return redirect()->route('materials.index')
        ->with('error','Something went wrong!');
    }

}
