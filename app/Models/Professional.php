<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProfessionalWorkingHour;

class Professional extends Model
{
    use HasFactory;
    protected $table = 'professionals';
    
    protected $fillable = ['name'];

    public function workingHours()
    {
        return $this->hasMany(ProfessionalWorkingHour::class);
    }
    
}
