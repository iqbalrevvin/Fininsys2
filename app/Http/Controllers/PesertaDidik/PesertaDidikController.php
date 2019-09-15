<?php

namespace App\Http\Controllers\PesertaDidik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pesdik;

class PesertaDidikController extends Controller
{
    public function index(Request $request)
    {
    	$page_title = 'List Peserta Didik';
    	$pencarian = $request->input('SearchPesdik');
    	if ($request->has('SearchPesdik')) {
    		$pesdik = Pesdik::where('nama_lengkap', 'LIKE', '%'.$request->SearchPesdik.'%')
    						->orWhere('NIK', 'LIKE', '%'.$request->SearchPesdik.'%')
    						->orWhere('NISN', 'LIKE', '%'.$request->SearchPesdik.'%')
    						->orWhere('NIPD', 'LIKE', '%'.$request->SearchPesdik.'%')
    						->orderBy('NIPD', 'asc')
    						->paginate(8);
    	}else{
    		$pesdik = Pesdik::where('status_pesdik_id', 1)->orderBy('NIPD', 'asc')->paginate(8);
    	}

    	foreach ($pesdik as $list) {
    		$kelas = Pesdik::find($list->id)->rombel()->where('rombel.tahun_ajaran_id', tapel_aktif()->id)->get();
    	}
    	return view('pesdik.list', compact('pesdik', 'page_title', 'kelas', 'pencarian'));
    }

    public function profil(Pesdik $pesdik)
    {
        $page_title = $pesdik->nama_lengkap;
        $riwayat_kelas = Pesdik::find($pesdik->id)->rombel()->get();
        return view('pesdik.profil',compact('page_title', 'pesdik', 'riwayat_kelas'));
    }
}
