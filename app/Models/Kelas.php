<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    public function MasterPrakerin()
    {
    	
    }

    public function rombel()
    {
        return $this->hasMany(Rombel::Class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::Class);
    }
}
