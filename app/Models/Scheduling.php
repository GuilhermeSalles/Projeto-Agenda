<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Service;

class Scheduling extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'pro',
        'service_id',
        'date',
        'time',
        'fulfilled'
    ];

    public function services()
    {
        return $this->belongsTo(Service::class, 'service', 'id');
    }
}
