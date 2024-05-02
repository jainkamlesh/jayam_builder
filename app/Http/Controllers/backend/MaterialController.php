<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Material;
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
        $materials = Material::orderBy('created_at', 'desc');
        if(Auth::user()->type == "manager"){
            $materials->where('user_id',Auth::user()->id);
        }
        if ($request->has('search')){
            $sort_search=$request->search;
            $materials->where('material_name', 'LIKE', "%$sort_search%");
            // $materials->where(function ($query) use ($sort_search) {
            //     $query->orWhereHas('user', function($q2) use ($sort_search) {
            //         $q2->where('name', 'LIKE', "%$sort_search%")->orWhere('phone', 'LIKE', "%$sort_search%");
            //     });
            //   });
        }
        $materials = $materials->paginate(10);
        return view('backend.admin.materials.index', compact('materials', 'sort_search'));
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

}
