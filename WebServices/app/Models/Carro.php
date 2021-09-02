<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Carro;
use App\Models\User;

class Carro extends Model
{
    protected $table = 'carros';
    protected $fillable = ['nome_veiculo','ano','combustivel','portas','quilometragem','cambio','cor','link','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
