<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    public function nombreApellidos(){
        return $this->nombre.' '.$this->apellidos;
    }

    protected function casts(): array {
        return [
            'fechaN' => 'datetime',
        ];
    }

    public function cuentas(): HasMany
    {
        return $this->hasMany(Cuenta::class);
    }

    /*
    protected $maps = [
        'fechaN' => 'Fecha de nacimiento'
    ];

    protected $append = ['Fecha de nacimiento'];

    public function getColumnaFechaN(){
        return $this->attributes['fechaN'];
    }
    protected $hidden = ['fechaN'];*/
}
