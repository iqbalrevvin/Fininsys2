<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPesdik extends Model
{
    protected $table = 'status_pesdik';

    public function pesdik()
    {
    	return $this->hasMany(Pesdik::Class);
    }
}
