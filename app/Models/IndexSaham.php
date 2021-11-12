<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexSaham extends Model
{
    use HasFactory;

    public function instrument_saham()
    {
        return $this->belongsTo(InstrumentSaham::class);
    }

    public function emiten()
    {
        return $this->hasMany(Emiten::class);
    }
}
