<?php

namespace App\Http\Controllers\Prakerin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Prakerin\PrakerinMaster;
use App\Models\Prakerin\Instansi;
use App\Models\Prakerin\PembimbingLapangan;
use App\Models\Prakerin\Penempatan;
use App\Models\Tenpen;
use App\Models\Pesdik;
use App\Models\Rombel;
use Yajra\DataTables\DataTables;
class PrakerinController extends Controller
{
    public function index()
    {

    }

    public function count_instansi($id)
    {
        $count = Penempatan::where('prakerin_master_id', $id)->count();
        return $count;
    }

    public function peserta(Request $request, $id)
    {
    	$page_title 		= 'Kelola Peserta Prakerin';
    	$master_prakerin 	= PrakerinMaster::find($id);
    	$instansi 			= Instansi::select('prakerin_instansi.kabupaten_id')
    									->orderBy('prakerin_instansi.kabupaten_id')
    									->groupBy('prakerin_instansi.kabupaten_id')
    									->get();
    	foreach($instansi as $list){
    		$nama_instansi = Instansi::where('kabupaten_id', $list->kabupaten_id)->get();
    	} 
    	$pembimbing_lapangan = PembimbingLapangan::All();
    	$pembimbing_akademik = Tenpen::All();
    	$list_instansi 		 = Penempatan::where('prakerin_master_id', $id)->get();
    	// dd($list_instansi);
    	return view('prakerin/kelola_peserta', 
    					compact(
    								'page_title', 'master_prakerin', 'instansi', 'nama_instansi', 'pembimbing_lapangan', 
    								'pembimbing_akademik', 'list_instansi'
    					)
    	);
    }

    public function get_list_instansi(Request $request)
    {
    	$master_prakerin_id 	= $request->input('master_id');
    	$list_instansi 		 	= Penempatan::where('prakerin_master_id', $master_prakerin_id)->get();
        
    	return view('prakerin.list_instansi', compact('list_instansi'));
    }

    public function get_list_peserta(Request $request)
    {
    	$penempatan_id     = $request->input('penempatan_id');
        $nama_instansi     = $request->input('nama_instansi');
    	$list_peserta      = Penempatan::find($penempatan_id)->pesdik()->get();
    	return view('prakerin.list_peserta', compact('list_peserta', 'nama_instansi', 'penempatan_id'));
    }

    public function insert_penempatan(Request $request)
    {
        $cek_penempatan = Penempatan::where('prakerin_master_id', $request->input('master_id'))
                                        ->where('instansi_id', $request->input('instansi'))
                                        ->exists();
        if($cek_penempatan) {
           $callback = [
                'status'    => 'error',
                'title'     => 'Penambahan Data Gagal',
                'message'   => 'Instansi Sudah Tersedia, Silahkan inputkan instansi lainnya.' 
            ];                                 
        }else{
            $penempatan = new Penempatan;
            $penempatan->prakerin_master_id         = $request->input('master_id');
            $penempatan->instansi_id                = $request->input('instansi');
            $penempatan->pembimbing_lapangan_id     = $request->input('pembimbing_lapangan');
            $penempatan->tenpen_id                  = $request->input('pembimbing_akademik');
            $penempatan->tgl_mulai                  = $request->input('tanggal_mulai');
            $penempatan->tgl_selesai                = $request->input('tanggal_selesai');
            $penempatan->save();

            $callback = [
                    'status'    => 'success',
                    'title'     => 'Penambahan Data Berhasil',
                    'message'   => 'Penempatan Prakerin Berhasil Ditambahkan' 
            ];
        }                                
    	
    	echo json_encode($callback);
    }

    public function delete_instansi(Request $request)
    {
        $penempatan_id  = $request->input('penempatan_id');

        $penempatan     = Penempatan::find($penempatan_id);
        $penempatan->delete();
        $callback = [
            'status'    => 'success',
            'title'     => 'Hapus Instansi Berhasil',
            'message'   => 'instansi beserta peserta terkait berhasil dihapus' 
        ];

        echo json_encode($callback);
    }

    public function get_list_pilih_peserta(DataTables $datatables, Request $request)
    {
        // $id = $request->input('id');
        $master_id      = $request->input('master_id');
        $rombel_id      = $request->input('rombel_id');
        $cek_penempatan     = Penempatan::where('prakerin_master_id', $master_id)->exists();
        if($cek_penempatan){ //JIKA PADA MASTER PRAKERIN SUDAH ADA INSTANSI
            $penempatan     = Penempatan::where('prakerin_master_id', $master_id)->get();
            foreach ($penempatan as $penempatan) { //TANGKAP DATA PENEMPATAN/INSTANSI
                $penempatan_id[] = $penempatan->id;
            }
            $cek_list_peserta_terdaftar = DB::table('penempatan_pesdik')->whereIn('penempatan_id', $penempatan_id)->exists();
            if($cek_list_peserta_terdaftar){// JIKA PADA PENEMPATAN TERDAPAT PESERTA TERDAFTAR
                $list_peserta_terdaftar = DB::table('penempatan_pesdik')->whereIn('penempatan_id', $penempatan_id)->get();
                foreach ($list_peserta_terdaftar as $list_peserta) { // TANGKAP DATA PESERTA
                    $list[] = $list_peserta->pesdik_id;
                }
            }else{ // JIKA PADA TABEL PENEMPATAN_PESDIK KOSONG
                $list = [];
            }
            
            $pesdik     = Rombel::find($rombel_id)->pesdik()->select('*', 'pesdik.id as pesdikid')->whereNotIn('pesdik_id', $list);
        }else{
            $pesdik     = Rombel::find($rombel_id)->pesdik()->select('*', 'pesdik.id as pesdikid');
        }
        
        

        // $students = Pesdik::select('pesdik.id', 'pesdik.nama_lengkap', 'pesdik.jenis_kelamin', 'pesdik.NIPD', 'pesdik.NISN')
        //                   ->where('status_pesdik_id', '1');
        
        return $datatables->eloquent($pesdik)
                ->addColumn('checkbox', '<label class="kt-checkbox kt-checkbox--success"><input type="checkbox" name="student_checkbox[]" class="student_checkbox data-check" value="{{$pesdikid}}" /> Pilih<span></span></label>')
                //->addColumn('nama', return $tahun_ajaran->nama);
                ->rawColumns(['checkbox','action'])
                ->make(true);
    }

    public function insert_peserta(Request $request)
    {
        $list_peserta   = $request->input('id');
        $penempatan_id  = $request->input('penempatan_id');

        foreach ($list_peserta as $list) {
            $penempatan = Penempatan::find($penempatan_id);
            if($penempatan->pesdik()->where('pesdik_id', $list)->exists()) {
                //Tidak Ada Operasi
            }else{
                $penempatan->pesdik()->attach($list);
            }
        }
    }
}
