<?php

namespace App\Http\Controllers\Surat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Surat\Surat;
use App\Models\Sekolah;
use PDF;

class SuratController extends Controller
{
    public function CetakSurat($id)
    {
    	$sekolah = Sekolah::first();
    	$surat = Surat::find($id);
    	$customPaper = array(0,0,600,1075);
        PDF::setOptions(['dpi' => 300, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadview('surat.cetak_surat', compact('surat', 'sekolah'))->setPaper($customPaper, 'potrait');
        return $pdf->stream('Surat.pdf'); 
    }
}
