<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'enderecos';

    public $timestamps  = false;

    protected $fillable = [
        'cep',
        'logradouro',
        'municipio_id',
        'numero',
        'bairro',
        'pessoa_id',
        'complemento'
    ];

    public function setLogradouroAttribute($value)
    {
        $this->attributes['logradouro'] = mb_strtoupper($value, 'UTF-8');
	}

    public function setBairroAttribute($value)
    {
        $this->attributes['bairro'] = mb_strtoupper($value, 'UTF-8');
	}
    
    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }


}
