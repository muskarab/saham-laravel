<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VektorY extends Model
{
    use HasFactory;
    
    public $table = "vektor_y";

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
        return $this->belongsTo(Preferensi::class);
    }

    public function vektor_x()
    {
        return $this->belongsTo(VektorX::class);
    }

    public function emiten()
    {
        return $this->belongsTo(Emiten::class);
    }
}
