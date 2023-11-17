<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index(){
        return view('dashboard');
    }
    public function membership(){
        return view('members.index');
    }
}
