<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatan;
class Surat extends Model
{
    protected $table = 'surat';

    public function indeks_surat()
    {
    	return $this->belongsTo(IndeksSurat::Class);
    }
    public function jabatan()
    {
    	return $this->belongsTo(Jabatan::Class);
    }
}
