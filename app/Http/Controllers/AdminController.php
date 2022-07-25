<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_login');
    }

    public function dashboard(){
        return view('admin.index');
    }

    public function login(Request $request){
        $cek =$request->all();
        if(Auth::guard('admin')->attempt(['email' =>$cek['email'],'password' =>$cek['password'] ])){
            return redirect()->route('admin.dashboard')->with('error','admin sukes login');
        }else{
            return back()->with('error','invlaid email dan password');
        }
    }
    public function adminlogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error','admin sukes logout');
    }
    public function adminregister(){
        return view('admin.admin_register');
    }
    public function adminregistercreate(Request $request){
        Admin::insert([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password) ,
            'created_at' =>Carbon::now(),
        ]);
        return redirect()->route('login_form')->with('error','admin sukes dibuat');

        
    }

}
