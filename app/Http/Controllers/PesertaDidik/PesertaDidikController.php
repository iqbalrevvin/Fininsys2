<?php

namespace App\Http\Controllers\PesertaDidik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pesdik;
use Yajra\DataTables\DataTables;
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
    public function import()
    {
        $page_title = 'Import Data Peserta Didik';
        return view('pesdik.import', compact('page_title'));
    }

    public function get_data_pesdik_import(DataTables $datatables)
    {
        $pesdik   = Pesdik::with('tahun_ajaran')->select('pesdik.id', 'pesdik.NIK', 'pesdik.nama_lengkap', 'pesdik.jenis_kelamin', 'pesdik.NIPD', 'pesdik.NISN', 'pesdik.created_at', 'pesdik.tahun_ajaran_id')->orderBy('created_at', 'desc');
        return $datatables->eloquent($pesdik)->make(true);
    }
}
