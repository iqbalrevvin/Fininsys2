<?php

namespace App\Models\Prakerin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tenpen;
class Penempatan extends Model
{
    protected $table = 'prakerin_penempatan';

    // protected $guarded = [''];
    
    public function PrakerinMaster()
    {
    	return $this->belongsTo(PrakerinMaster::Class);
    }

    public function instansi()
    {
    	return $this->belongsTo(Instansi::Class);
    }

    public function pembimbing_lapangan()
    {
    	return $this->belongsTo(PembimbingLapangan::Class);
    }

    public function data_instansi($id)
    {
    	$instansi = Instansi::find($id);
    	return $instansi;
    }

    public function instansi_bidang($id_bidang_usaha)
    {
    	$bidang_usaha = BidangUsaha::where('id', $id_bidang_usaha)->first();
    	return $bidang_usaha->nama;
    }

    public function data_pembimbing_lapangan($id_pembimbing)
    {
    	$pembimbing = PembimbingLapangan::find($id_pembimbing);

    	return $pembimbing;
    }
    public function data_pembimbing_akademik($id_pembimbing)
    {
    	$pembimbing = Tenpen::find($id_pembimbing);

    	return $pembimbing;
    }

}
