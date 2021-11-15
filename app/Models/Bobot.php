<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    use HasFactory;

    public function instrument_saham()
    {
        return $this->belongsTo(InstrumentSaham::class);
    }
}
