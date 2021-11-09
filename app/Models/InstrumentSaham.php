<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumentSaham extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function index()
    {
        return $this->hasMany(IndexSaham::class);
    }
}
