<?php

namespace App\Http\Controllers\TenagaPendidik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TenagaPendidikController extends Controller
{
    public function index()
    {
    	
    }

    public function jabatan()
    {
    	$page_title = 'Jabatan Tenaga Pendidik';
    	return view('tenpen.jabatan', compact('page_title'));
    }
}
