<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $table = 'rombel';

    /**
     * [Relasi Rombel Dimiliki Kelas]
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::Class);
    }
    /**
     * [Relasi Rombel Dimiliki Tahun Ajaran ]
     */
    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::Class);
    }
    /**
     * [Relasi Rombel Dimiliki Banyak Peserta Didik]
     */
     public function pesdik()
    {
        return $this->belongsToMany(Pesdik::Class);
    }
    /**
     * [Relasi Rombel Dimiliki Tenaga Pendidik]
     */
    public function tenpen()
    {
        return $this->belongsTo(Tenpen::Class);
    }

}
