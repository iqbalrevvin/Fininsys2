<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;
use DB;
class TestAjaxController extends Controller
{
    public function index()
    {
        $provinsi = Provinsi::orderBy('name', 'asc')->get();
        return view('testajax',[
            'provinsi' => $provinsi
        ]);
    }

    public function responeajax(Request $request)
    {
        $data = $request->input('idPilihan');
        return view('ajaxrespone',['data' => $data]);
    }

    public function list_kabupaten(Request $request)
    {
        $idProvinsi = $request->input('idProvinsi');
        $listKota   = DB::table('kabupaten')
                        ->where('provinsi_id', $idProvinsi)
                        ->orderBy('name')
                        ->get();
        $lists = '<select class="form-control" name="kabupaten" id="kabupaten">';
        $lists .= "<option value=''>Silahkan Pilih Kabupaten</option>";
        foreach($listKota as $data){
			$lists .= "<option value='".$data->id."'>".$data->name."</option>";
		}
		$callback = ['list_kabupaten'=>$lists]; 

		echo json_encode($callback); 
    }

    public function list_kecamatan(Request $request)
    {
        $idKabupaten    = $request->input('idKabupaten');
        $listKecamatan  = DB::table('kecamatan')
                            ->where('kabupaten_id',$idKabupaten)
                            ->orderBy('name')
                            ->get();
        $lists   = "<select class='form-control' name='kecamatan' id='kecamatan'>";
        $lists   .= "<option value=''>Silahkan Pilih Kecamatan</option>";
        foreach ($listKecamatan as $data) {
            $lists .= "<option value='".$data->id."'>".$data->name."</option>";
        }
        $callback = ['list_kecamatan' => $lists];

        echo json_encode($callback);
    }
}