<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check())
            return redirect()->route('admin.home');
        else
            return view('auth.login');
    }

   function Admin_dashboard(){
      return view('backend.admin.dashboard');
   }

   public function logout_user(Request $request)
   {
       Auth::logout();
       return redirect()->route('home');
   }

   public function Password_Change(Request $request)
   {
       $validated = $request->validate([
           'new_password' => 'required',
       ]);
       $user = User::where('id', auth()->user()->id)->first();
       $user->password = Hash::make($request->new_password);
       if($user->save()){
           toastr()->success('Password changed successfully!');
           return $this->logout();
       }else{
           toastr()->error('Something want wrongs!.');
           return back();
       }
   }

}
