<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\BirthControl;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Acceptor extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'attendance_date',
        'patient_id',
        'birthControl_id',
        'menstrual_date',
        'weight',
        'blood_pressure',
        'complication',
        'failure',
        'description',
        'return_date',
    ];

    // public function getAttendanceDateAttribute()
    // {
    //     // return Carbon::parse($this->attributes['attendance_date'])->translatedFormat('l, d F Y');
    //     return Carbon::parse($this->attributes['attendance_date'])->translatedFormat('d F Y');
    // }

    // public function getMenstrualDateAttribute()
    // {
    //     return Carbon::parse($this->attributes['menstrual_date'])->translatedFormat('d F Y');
    // }

    // public function getReturnDateAttribute()
    // {
    //     return Carbon::parse($this->attributes['return_date'])->translatedFormat('d F Y');
    // }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function birthControl()
    {
        return $this->belongsTo(BirthControl::class, 'birthControl_id');
    }
}
