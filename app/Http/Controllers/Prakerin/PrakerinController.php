<?php

namespace App\Http\Controllers\Prakerin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Prakerin\PrakerinMaster;
use App\Models\Prakerin\Instansi;
use App\Models\Prakerin\PembimbingLapangan;
use App\Models\Prakerin\Penempatan;
use App\Models\Tenpen;
class PrakerinController extends Controller
{
    public function index()
    {
    	
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
 
    	return view('prakerin.list_instansi', compact('list_instansi', 'instansi'));
    }

    public function get_list_peserta()
    {
    	return view('prakerin.list_peserta');
    }

    public function insert_penempatan(Request $request)
    {
    	$penempatan = new Penempatan;
    	$penempatan->prakerin_master_id 				= $request->input('master_id');
    	$penempatan->prakerin_instansi_id 				= $request->input('instansi');
    	$penempatan->prakerin_pembimbing_lapangan_id 	= $request->input('pembimbing_lapangan');
    	$penempatan->tenpen_id 							= $request->input('pembimbing_akademik');
    	$penempatan->tgl_mulai 						= $request->input('tanggal_mulai');
    	$penempatan->tgl_selesai 					= $request->input('tanggal_selesai');
    	$penempatan->save();

    	$callback = [
                'status'    => 'success',
                'title' 	=> 'Penambahan Data Berhasil',
                'message'     => 'Penempatan Prakerin Berhasil Ditambahkan' 
        ];
    	echo json_encode($callback);
    }
}
