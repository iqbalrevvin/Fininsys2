<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenpen extends Model
{
    protected $table = 'tenpen';

    /**
     * [Relasi Tenaga Pendidik Memiliki Banyak Rombel]
     */
    public function rombel()
    {
        return $this->hasMany(Rombel::Class);
    }
    
}
