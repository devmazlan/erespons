<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Dashboard | Superadmin';
        $user = Auth::user();
        return view('admin.home', compact('user'))->with('title', $title);
    }
}
