<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'valor', 
        'tipo_id',
        'pessoa_id',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
