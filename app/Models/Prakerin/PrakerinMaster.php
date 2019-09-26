<?php

namespace App\Models\Prakerin;

use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAjaran;
use App\Models\Prodi;
use App\Models\Rombel;
use App\Models\Kelas;
class PrakerinMaster extends Model
{
    protected $table = 'prakerin_master';

    public function penempatan()
    {
    	return $this->hasMany(Penempatan::class);
    }

    public function TahunAjaran()
    {
    	return $this->belongsTo(TahunAjaran::Class);
    }

    public function prodi()
    {
    	return $this->belongsTo(Prodi::Class);
    }
    public function rombel()
    {
        return $this->belongsTo(Rombel::Class);
    }

}
