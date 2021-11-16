<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emiten extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['index', 'sektor'];
    
    public function index()
    {
        return $this->belongsTo(IndexSaham::class);
    }

    public function sektor()
    {
        return $this->belongsTo(Sektor::class);
    }

    public function prefereni_kriteria()
    {
        return $this->hasOne(PreferensiKriteria::class);
    }

    public function vektor_s()
    {
        return $this->hasOne(VektorS::class);
    }
}
