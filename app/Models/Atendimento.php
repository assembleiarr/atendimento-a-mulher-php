<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Area;
use Carbon\Carbon;

class Atendimento extends Model
{
    use HasFactory;

    protected $table = 'atendimentos';

    protected $fillable = [
        'assistido_id',
        'data_atendimento',
        'recepcao_tipo',
        'is_importado'
    ];  

    public function assistido()
    {
        return $this->belongsTo(Assistido::class);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function setDataAtendimentoAttribute($value){      
       
        $this->attributes['data_atendimento'] = Carbon::createFromFormat('d/m/Y', $value);

    }

    // public function getDataAtendimentoAttribute(){      
       
    //     return Carbon::parse($this->attributes['data_atendimento'])->format('d/m/Y');

    // }
}
