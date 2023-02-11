<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistido extends Model
{
    use HasFactory;

    protected $table = 'assistidos';

    protected $fillable = [
        'local_arquivo',
        'pessoa_id'
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

}
