<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';

    public function rombel()
    {
        return $this->hasMany(Rombel::Class);
    }

    public function pesdik()
    {
        return $this->hasMany(Pesdik::Class);
    }

}
