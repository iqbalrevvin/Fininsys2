<?php

namespace App\Models\Prakerin;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'prakerin_instansi';

    public function bidang_usaha()
    {
    	return $this->belongsTo(BidangUsaha::Class);
    }
}
