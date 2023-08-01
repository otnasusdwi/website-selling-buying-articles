<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class DownloadController extends Controller
{
    public function index($file)
    {
        // $file_path = public_path('article/'.$file);
        // return response()->download($file_path);
        return Storage::download('public/article/'.$file);
    }
    
}
