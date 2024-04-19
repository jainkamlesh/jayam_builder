<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $sites = Site::orderBy('created_at', 'desc');
        if ($request->has('search') && $request->search!=""){
            $sort_search=$request->search;
            $sites->where('name', 'LIKE', "%$sort_search%");
        }
        $sites = $sites->paginate(10);
        return view('backend.admin.sites.index', compact('sites', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.sites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $site = new Site;
        $site->name = $request->name;
        $site->note = $request->note;
        $site->address = $request->address;
        if($site->save()){
            return redirect()->route('sites.index')
            ->with('success','Site Added Succefully.');
        }
        return redirect()->route('sites.index')
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
        $site = Site::find($id);
        return view('backend.admin.sites.edit',compact('site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $site = Site::find($id);
        $site->name = $request->name;
        $site->note = $request->note;
        $site->address = $request->address;
        if($site->save()){
            return redirect()->route('sites.index')
            ->with('success','Site Updated Succefully.');
        }
        return redirect()->route('sites.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $site = Site::where('id', $request->id)->first();
        if($site->delete()){
            return redirect()->route('sites.index')
            ->with('success','Site Deleted Succefully.');
        }
        return redirect()->route('sites.index')
        ->with('error','Something went wrong!');
    }
}
