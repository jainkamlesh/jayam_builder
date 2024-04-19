<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Requirement;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Auth;
class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $requirements = Requirement::orderBy('created_at', 'desc');
        if(Auth::user()->type == "manager"){
            $requirements->where('user_id',Auth::user()->id);
        }
        if ($request->has('search')){
            $sort_search=$request->search;
            $requirements->where(function ($query) use ($sort_search) {
                $query->orWhereHas('user', function($q2) use ($sort_search) {
                    $q2->where('name', 'LIKE', "%$sort_search%")->orWhere('phone', 'LIKE', "%$sort_search%");
                });
              });
        }
        $requirements = $requirements->paginate(10);
        return view('backend.admin.requirements.index', compact('requirements', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventories=Inventory::where('status',1)->get();
        return view('backend.admin.requirements.create',compact('inventories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'inventory_id' => 'required',
            'quantity' => 'required'
        ]);
        $requirement = new Requirement;
        $requirement->inventory_id = $request->inventory_id;
        $requirement->inventory_name = Inventory::find($request->inventory_id)->name ?? "";
        $requirement->quantity = $request->quantity;
        $requirement->comment = $request->comment;
        $requirement->user_id = Auth::user()->id;
        if($requirement->save()){
            return redirect()->route('requirements.index')
            ->with('success','Requirement Added Succefully.');
        }
        return redirect()->route('requirements.index')
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
        $requirement = Requirement::find($id);
        return view('backend.admin.requirements.edit',compact('requirement','inventories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'inventory_id' => 'required',
            'quantity' => 'required'
        ]);
        $requirement = Requirement::find($id);
        $requirement->inventory_id = $request->inventory_id;
        $requirement->inventory_name = Inventory::find($request->inventory_id)->name ?? "";
        $requirement->quantity = $request->quantity;
        $requirement->comment = $request->comment;
        if($requirement->save()){
            return redirect()->route('requirements.index')
            ->with('success','Requirement Updated Succefully.');
        }
        return redirect()->route('requirements.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $requirement = Requirement::where('id', $request->id)->first();
        if($requirement->delete()){
            return redirect()->route('requirements.index')
            ->with('success','Requirement Deleted Succefully.');
        }
        return redirect()->route('requirements.index')
        ->with('error','Something went wrong!');
    }

    public function status($id,$status)
    {
        $requirement = Requirement::find($id);
        $requirement->status = $status;
        if($requirement->save()){
            return redirect()->route('requirements.index')
            ->with('success','Requirement Updated Succefully.');
        }
        return redirect()->route('requirements.index')
        ->with('error','Something went wrong!');
    }
}
