<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Site;
class UserController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $users = User::orderBy('created_at', 'desc');
        if ($request->has('search') && $request->search!=""){
            $sort_search=$request->search;
            $users->where('name', 'LIKE', "%$sort_search%")->orWhere('username', 'LIKE', "%$sort_search%")->orWhere('phone', 'LIKE', "%$sort_search%");
        }

        $users = $users->paginate(10);
        return view('backend.admin.users.index', compact('users', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sites=Site::where('status',1)->get();
        return view('backend.admin.users.create',compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required',
            'site' => 'required',
            'user_type' => 'required'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->site_id = $request->site;
        $user->type = $request->user_type;
        if($user->save()){
            return redirect()->route('users.index')
            ->with('success','User Added Succefully.');
        }
        return redirect()->route('users.index')
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
        $user=User::find($id);
        $sites=Site::where('status',1)->get();
        return view('backend.admin.users.edit',compact('user','sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'site' => 'required',
            'user_type' => 'required'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        if($request->password!=""){
            $user->password = bcrypt($request->password);
        }
        $user->site_id = $request->site;
        $user->type = $request->user_type;
        if($user->save()){
            return redirect()->route('users.index')
            ->with('success','User Updated Succefully.');
        }
        return redirect()->route('users.index')
        ->with('error','Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if($user->delete()){
            return redirect()->route('users.index')
            ->with('success','User Deleted Succefully.');
        }
        return redirect()->route('users.index')
        ->with('error','Something went wrong!');
    }

}
