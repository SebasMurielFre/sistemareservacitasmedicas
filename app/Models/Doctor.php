<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'dni',
        'licencia_medica',
        'especialidad',
        'celular',
        'fecha_nacimiento',
        'direccion',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function consultorio(){
        return $this->belongsTo(Consultorio::class);
    }
    
    public function horarios(){
        return $this->hasMany(Horario::class);
    }

    public function eventos(){
        return $this->hasMany(Evento::class);
    }
}
