<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cuenta extends Model
{
    
    public function cliente(): BelongsTo{
        return $this->belongsTo(Cliente::class);
    }

    public static function buscaCodigoANDSaldo($codigo,$saldo){
        return Cuenta::where('codigo','like', '%'.$codigo.'%')
            ->where('saldo','>',$saldo)
            ->get();
    }

    public static function buscaCodigoORSaldo($codigo,$saldo){
        return Cuenta::where('codigo','like', '%'.$codigo.'%')
            ->orWhere('saldo','>',$saldo)
            ->get();
    }
}
