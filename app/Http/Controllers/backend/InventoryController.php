<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $inventories = Inventory::orderBy('created_at', 'desc');
        if ($request->has('search') && $request->search!=""){
            $sort_search=$request->search;
            $inventories->where('name', 'LIKE', "%$sort_search%");
        }
        $inventories = $inventories->paginate(10);
        return view('backend.admin.inventories.index', compact('inventories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.inventories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $inventory = new Inventory;
        $inventory->name = $request->name;
        $inventory->note = $request->note;
        if($inventory->save()){
            return redirect()->route('inventories.index')
            ->with('success','Inventory Added Succefully.');
        }
        return redirect()->route('inventories.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bills $bills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        return view('backend.admin.inventories.edit',compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $inventory = Inventory::find($id);
        $inventory->name = $request->name;
        $inventory->note = $request->note;
        if($inventory->save()){
            return redirect()->route('inventories.index')
            ->with('success','Inventory Updated Succefully.');
        }
        return redirect()->route('inventories.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $inventory = Inventory::where('id', $request->id)->first();
        if($inventory->delete()){
            return redirect()->route('inventories.index')
            ->with('success','Inventory Deleted Succefully.');
        }
        return redirect()->route('inventories.index')
        ->with('error','Something went wrong!');
    }
}
