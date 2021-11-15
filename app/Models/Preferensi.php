<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preferensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['index'];
    public function index()
    {
        return $this->belongsTo(IndexSaham::class);
    }
}
