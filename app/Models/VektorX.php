<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VektorX extends Model
{
    use HasFactory;
    
    public $table = "vektor_x";

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

    public function preferensi()
    {
        return $this->HasOne(Preferensi::class);
    }

    public function vektor_y()
    {
        return $this->HasOne(VektorY::class);
    }
}
