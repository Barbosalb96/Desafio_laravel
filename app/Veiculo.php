<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $table = 'veiculos';
    protected $fillable = [
        'modelo',
        'marca',
        'versao',
        'ano',
        'descricao',
        'id_tipo_veiculo'
    ];


}
