<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';

    public function tenpen()
    {
    	return $this->belongsTo(Tenpen::Class);
    }
}
