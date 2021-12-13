<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VektorV extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $with = ['emiten'];

    public function emiten()
    {
        return $this->belongsTo(Emiten::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
