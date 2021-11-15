<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emiten extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'emiten_char',
    //     'perusahaan',
    //     'index_id',
    //     'sektor_id',
    //     'deskripsi',
    //     'eps',
    //     'roe',
    //     'per',
    //     'der',
    // ];
    protected $with = ['index', 'sektor'];
    
    public function index()
    {
        return $this->belongsTo(IndexSaham::class);
    }

    public function sektor()
    {
        return $this->belongsTo(Sektor::class);
    }
}
