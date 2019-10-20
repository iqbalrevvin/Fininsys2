<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class TestMapsController extends Controller
{
    public function index()
    {
    	return view('testmaps');
    }

    public function add(Request $request)
    {
    	$title 		= $request->input('title');
    	$lat 		= $request->input('lat');
    	$lng 		= $request->input('lat');

    	DB::table('maps-sample')->insert([
    		'title' => $title,
    		'lat' 	=> $lat,
    		'lng' 	=> $lng
    	]);

    	return back();
    }
}
