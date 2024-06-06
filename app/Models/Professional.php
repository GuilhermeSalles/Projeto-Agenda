<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $table = 'professionals';
    protected $fillable = ['name', 'specializations'];

    // Decodificar o JSON e retornar os serviços
    public function getSpecializationsAttribute($value)
    {
        return json_decode($value, true);
    }

    // Relacionamento com as horas de trabalho
    public function workingHours()
    {
        return $this->hasMany(ProfessionalWorkingHour::class);
    }
}
