<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;

    protected $table = 'atendimentos';

    protected $fillable = [
        'assistido_id',
        'data_hora',
        'recepcao_tipo',
        'is_importado'
    ];  

    public function assistido()
    {
        return $this->belongsTo(Assistido::class);
    }
}
