<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        switch(Auth::user()->role){
            case 'admin':
                return redirect('/admin/dashboard');
                // return redirect()->route('admin.dashboard');
                break;
            case 'pembeli':
                return redirect('/pembeli/dashboard');
                break;
            case 'penulis':
                return redirect('/penulis/dashboard');
                break;
            default:
                return redirect('/login');
        }
    }

}