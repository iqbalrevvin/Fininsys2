<?php

namespace App\Http\Controllers\Rombel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Rombel;
use App\Models\Tenpen;
use App\models\Pesdik;
use App\Models\Prodi;
use App\Models\Kelas;
use Yajra\DataTables\DataTables;
class RombelController extends Controller
{
    public function index(Rombel $rombel)
    {    
        $page_title     = 'Kelola Rombel';
        $page_notice    = 'Pastikan sudah mengatur program studi pilihan pada peserta didik';
        $peserta_rombel = Rombel::find($rombel->id);
        $kelas          = Kelas::find($rombel->kelas_id);
        $tenpen         = Tenpen::where('id', '!=', $rombel->tenpen->id)->get();
       
		return view('rombel.kelola',[
            'page_title'        => $page_title,
            'page_notice'       => $page_notice,
            'rombel'            => $rombel,
            'tenpen'            => $tenpen,
            'kelas'             => $kelas,
            'peserta_rombel'    => $peserta_rombel,
			'id'                => $id 
		]);    	
    }

    public function get_konten_peserta(Request $request)
    {   
        $idRombel       = $request->input('idRombel');
        $rombel         = Rombel::find($idRombel);
        $peserta_rombel = Rombel::find($rombel->id);
        $kelas          = Kelas::find($rombel->kelas_id);
        $tenpen         = Tenpen::where('id', '!=', $rombel->tenpen->id)->get();
        return view('rombel.konten_tabel_peserta_kelas',[
            'rombel'            => $rombel,
            'tenpen'            => $tenpen,
            'kelas'             => $kelas,
            'peserta_rombel'    => $peserta_rombel,
		]);
    }

    public function get_list_pesdik(DataTables $datatables, Request $request)
    {
        $tapel_id           = $request->input('tahun_ajaran_id');
        $prodi_id           = $request->input('prodi_id');
        $rombel_id          = $request->input('rombel_id');

        $rombel_tapel       = Rombel::where('tahun_ajaran_id', $tapel_id)->get();
        foreach ($rombel_tapel as $rombel) {
            $list_rombel[] = $rombel->id; /*List Rombel Teridentifikasi di Tapel Terpilih*/
        }

        $cek_rombel         = DB::table('pesdik_rombel')->whereIn('rombel_id', $list_rombel)->exists();
        if($cek_rombel){ /*Apabila rombel pada pesdik rombel tersedia*/
            $pesdik = DB::table('pesdik_rombel')->whereIn('rombel_id', $list_rombel)->get();
            foreach ($pesdik as $pesdik) {
                $list_pesdik[] = $pesdik->pesdik_id; /*List Pesdik Yang Terdaftar Ke Rombel Di Tapel Terpilih*/
            }
            $students   = Pesdik::with('tahun_ajaran')->select('pesdik.id', 'pesdik.nama_lengkap', 'pesdik.jenis_kelamin', 'pesdik.NIPD', 'pesdik.NISN', 'pesdik.tahun_ajaran_id')
                ->where('status_pesdik_id', '1')
                ->where('prodi_id', $prodi_id)
                ->whereNotIn('id', $list_pesdik);
        }else{ /*Jika rombel terpilih tidak ada pada tabel pesdik_rombel*/
            $students   = Pesdik::with('tahun_ajaran')->select('pesdik.id', 'pesdik.nama_lengkap', 'pesdik.jenis_kelamin', 'pesdik.NIPD', 'pesdik.NISN', 'pesdik.tahun_ajaran_id')
                ->where('status_pesdik_id', '1')
                ->where('prodi_id', $prodi_id);
        }
        

        return $datatables->eloquent($students)
                ->addColumn('checkbox', '<label class="kt-checkbox kt-checkbox--success"><input type="checkbox" name="student_checkbox[]" class="student_checkbox data-check" value="{{$id}}" /> Pilih<span></span></label>')
                //->addColumn('nama', return $tahun_ajaran->nama);
                ->rawColumns(['checkbox','action'])
                ->make(true);
    }

    public function insert_siswa_kelas(Request $request)
    {
        $list_pd    = $request->input('id');
        $rombel_id  = $request->input('rombelID');

        // if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){
        //     return redirect('siswa/'.$idSiswa.'/profile')->with('gagal', 'Data Nilai Yang Ditambahkan Sudah Ada');
        // }


        foreach($list_pd as $id){
            $rombel = Rombel::find($rombel_id);
            if($rombel->pesdik()->where('pesdik_id', $id)->exists()){
                //Tidak Ada Operasi
            }else{
                $rombel->pesdik()->attach($id);
            }
            
        }
    }
    public function delete_siswa_kelas(Request $request)
    {
        $idPesdik   = $request->input('id');
        $idRombel   = $request->input('rombel');
        $pesdik     = Pesdik::find($idPesdik);
        $pesdik->rombel()->detach($idRombel);
    }

    public function set_wali_kelas(Request $request)
    {
        $rombelID       = $request->input('rombelID');
        $waliKelas      = $request->input('waliKelas');
        $kelasID        = $request->input('kelasID');
        $tahunAjaranID  = $request->input('tahunAjaranID');
        $cekWaliKelas   = Rombel::where('tenpen_id', $waliKelas)
                                ->where('tahun_ajaran_id', $tahunAjaranID)
                                ->exists();
        if($cekWaliKelas){
            $callback = [
                'status'    => 'failed',
                'pesan'     => 'Tenaga Pendidik Untuk Tahun Ajaran Ini Sudah Menjabat Dikelas Lain' 
            ];
        }else{
            $rombel = Rombel::find($rombelID);
            $rombel->tenpen_id = $waliKelas;
            $rombel->save();
            $callback = [
                'status'    => 'success',
                'pesan'     => 'Tenaga Pendidik Terpilih Berhasil Diatur Sebagai Wali Kelas' 
            ]; 
        }
        echo json_encode($callback);
    }
}
