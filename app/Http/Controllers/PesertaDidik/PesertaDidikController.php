<?php

namespace App\Http\Controllers\PesertaDidik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Pesdik;
use Session;
use Yajra\DataTables\DataTables;
use Excel;
use File;

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
        $pesdik   = Pesdik::with('tahun_ajaran', 'status_pesdik')->select('pesdik.id', 'pesdik.NIK', 'pesdik.nama_lengkap', 'pesdik.jenis_kelamin', 'pesdik.NIPD', 'pesdik.NISN', 'pesdik.created_at', 'pesdik.tahun_ajaran_id', 'pesdik.status_pesdik_id')->orderBy('created_at', 'desc');
        // $pesdik   = Pesdik::select('pesdik.id', 'pesdik.NIK', 'pesdik.nama_lengkap', 'pesdik.jenis_kelamin', 'pesdik.NIPD', 'pesdik.NISN', 'pesdik.created_at')->orderBy('created_at', 'desc');
        return $datatables->eloquent($pesdik)->make(true);
    }

    public function proses_import(Request $request)
    {
        $this->validate($request, [
          'file_import'  => 'required|mimes:xls,xlsx'
        ]);

         $path = $request->file('file_import')->getRealPath();
         $data = Excel::load($path)->get();

         if($data->count() > 0){
            foreach($data as $key => $value){
                $cek_nik = Pesdik::where('NIK', $value->nik)->exists();
                $cek_nisn = Pesdik::where('NISN', $value->nisn)->exists();
                $cek_nipd = Pesdik::where('NIPD', $value->nipd)->exists();
                if(!$cek_nik && !$cek_nisn && !$cek_nipd){
                    $insert_data = [
                        'nama_lengkap'  => $value->nama_lengkap,
                        'NIK' => $value->nik,
                        'NISN' => $value->nisn,
                        'NIPD' => $value->nipd,
                        'jenis_kelamin' => $value->jenis_kelamin,
                        'NPSN_sekolah_asal' => $value->NPSN_sekolah_asal, 
                        'nama_sekolah_asal' => $value->nama_sekolah_asal,
                        'tempat_lahir' => $value->tempat_lahir,
                        'tanggal_lahir' => $value->tanggal_lahir,
                        'nama_ayah' => $value->nama_ayah,
                        'NIK_ayah' => $value->nik_ayah,
                        'tahun_lahir_ayah' => $value->thn_lahir_ayah,
                        'nama_ibu' => $value->nama_ibu,
                        'NIK_ibu' => $value->nik_ibu,
                        'tahun_lahir_ibu' => $value->tahun_lahir_ibu,
                        'tahun_ajaran_id' => tapel_aktif()->id,
                        'status_pesdik_id' => 1
                    ];
                    Pesdik::create($insert_data);
                    $count = 0;
                    $success[] = $count++;
                    // return back()->with('success', 'Excel Data Imported successfully.');
                }else{
                    $count = 0;
                    $failed[] = $count++;
                    // return back()->with('error', $no++);
                }
            }
            // if(!empty($insert_data)){
            //     // DB::table('pesdik')->insert($insert_data);
            //     Pesdik::insert($insert_data);
            // }
        }
        if($success){
            return back()->with('success', count($success).' Peserta Didik Berhasil Masuk Ke Database');
        }else{
             return back()->with('error', 'Tidak Ada Data Yang Berhasil Masuk Ke Database');
        }
        // return back()->with('success', count($success).' Berhasil Masuk Database & '.count($failed).' Gagal Masuk');
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }
       
    
}
