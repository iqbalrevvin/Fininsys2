<?php

namespace App\Models\Prakerin;

use Illuminate\Database\Eloquent\Model;

class BidangUsaha extends Model
{
    protected $table = 'prakerin_bidang_usaha';

    public function instansi()
    {
    	return $this->hasMany(Instansi::Class);
    }
}
