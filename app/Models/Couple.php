<?php

namespace App\Models;

use App\Models\Work;
use App\Models\Patient;
use App\Models\Graduated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Couple extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'patient_id',
        'graduated_id',
        'work_id',
        'name',
        'phoneNumber',
        'place_brithday',
        'date_brithday',
        'gender',
        'address',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function graduated()
    {
        return $this->belongsTo(Graduated::class, 'graduated_id');
    }
    public function work()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }
}
