<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}
