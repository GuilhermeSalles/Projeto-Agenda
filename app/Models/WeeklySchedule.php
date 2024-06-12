<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WeeklySchedule extends Model
{
    use HasFactory;

    protected $table = 'weekly_schedule';

    protected $fillable = [
        'day_of_week',
        'opening_time',
        'closing_time',
        'working',
        'special_day',
    ];

    // Mutator para converter opening_time em objeto Carbon
    public function setOpeningTimeAttribute($value)
    {
        $this->attributes['opening_time'] = Carbon::createFromFormat('H:i', $value);
    }

    // Mutator para converter closing_time em objeto Carbon
    public function setClosingTimeAttribute($value)
    {
        $this->attributes['closing_time'] = Carbon::createFromFormat('H:i', $value);
    }
}
