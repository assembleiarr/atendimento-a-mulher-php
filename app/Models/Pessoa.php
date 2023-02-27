<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;


class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas';

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'telefone_principal'
    ];

    public function setTelefonePrincipalAttribute($value)
    {
        $this->attributes['telefone_principal'] = preg_replace("/[^0-9]/","", $value);
    }

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = mb_strtoupper($value, 'UTF-8');
	}

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] =  preg_replace("/[^0-9]/","", $value);
	}

    public function getCpfAttribute($value)
    {
        $cpf =  preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $this->attributes['cpf']);

        return $cpf;
	}

    public function getTelefonePrincipalAttribute($value)
    {
        $telefone =  $this->attributes['telefone_principal'];
        $formatado = "(".substr($telefone,0,2).") ".substr($telefone,2);

        return $formatado;
	}

    public function setDataNascimentoAttribute($value)
    {      
        if($value)
            $this->attributes['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getDataNascimentoAttribute()
    {      
        if($this->attributes['data_nascimento'])
            return Carbon::parse($this->attributes['data_nascimento'])->format('d/m/Y');
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    public function assistido()
    {
        return $this->hasOne(Assistido::class);
    }


}
