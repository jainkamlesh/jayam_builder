<?php
namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use Illuminate\Http\Request;

class DealerController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $dealers = Dealer::orderBy('created_at', 'desc');
        if ($request->has('search') && $request->search!=""){
            $sort_search=$request->search;
            $dealers->where('name', 'LIKE', "%$sort_search%");
        }
        $dealers = $dealers->paginate(10);
        return view('backend.admin.dealers.index', compact('dealers', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.dealers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $dealer = new Dealer;
        $dealer->name = $request->name;
        $dealer->comment = $request->comment;
        if($dealer->save()){
            return redirect()->route('dealers.index')
            ->with('success','Dealer Added Succefully.');
        }
        return redirect()->route('dealers.index')
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
        $dealer = Dealer::find($id);
        return view('backend.admin.dealers.edit',compact('dealer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $dealer = Dealer::find($id);
        $dealer->name = $request->name;
        $dealer->comment = $request->comment;
        if($dealer->save()){
            return redirect()->route('dealers.index')
            ->with('success','Dealer Updated Succefully.');
        }
        return redirect()->route('dealers.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $dealer = Dealer::where('id', $request->id)->first();
        if($dealer->delete()){
            return redirect()->route('dealers.index')
            ->with('success','Dealer Deleted Succefully.');
        }
        return redirect()->route('dealers.index')
        ->with('error','Something went wrong!');
    }
}
