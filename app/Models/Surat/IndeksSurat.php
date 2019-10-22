<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;

class IndeksSurat extends Model
{
    protected $table = 'surat_indeks';

    public function Surat()
    {
    	return $this->hasMany(Surat::Class);
    }
}
