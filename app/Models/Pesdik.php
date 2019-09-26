<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prakerin\Penempatan;
class Pesdik extends Model
{
    protected $table = 'pesdik';
    /**
     * [Relasi Peserta Didik Dimiliki Program Studi]
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::Class);
    }
    /**
     * [Relasi Peserta Didik Dimiliki Banyak Rombel]
     */
    public function rombel()
    {
        return $this->belongsToMany(Rombel::Class);
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::Class);
    }

    public function status_pesdik()
    {
        return $this->belongsTo(StatusPesdik::Class);
    }

    public function penempatan()
    {
        return $this->belongsToMany(Penempatan::Class);
    }


}
