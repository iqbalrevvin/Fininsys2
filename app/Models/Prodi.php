<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    /**
     * [Relasi Program Studi Memiliki Banyak Peserta Didik]
     */
    public function pesdik()
    {
        return $this->hasMany(Pesdik::Class);
    }
    
    public function kelas()
    {
        return $this->hasMany(Kelas::Class);
    }
    public function tenpen()
    {
        return $this->belongsTo(Tenpen::Class);
    }
    
}
