<?php

namespace App\Models;

use App\Models\User;
use App\Models\Work;
use App\Models\Couple;
use App\Models\Acceptor;
use App\Models\Graduated;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'user_id',
        'no_rm',
        'graduated_id',
        'work_id',
        'name',
        'phoneNumber',
        'place_brithday',
        'date_brithday',
        'gender',
        'marital_status',
        'address',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $string = 'R' . date("y") . date("m") . date("d");
            $exsist = Patient::where('no_rm', 'like', '%' . strtoupper($string) . '%')->get();
            $values = '';

            $counter = $exsist->count();

            if ($exsist->count() <= 0) {
                $values =  substr(str_pad($counter, 3,  0, STR_PAD_LEFT), -1) . '01';
                $model->no_rm = strtoupper($string)  .  $values;
            } else {
                $lastData = Patient::orderBy('no_rm', 'desc')->first();
                $no_rm = intval(substr($lastData->no_rm, 7)) + 1;
                $values = str_pad($no_rm, 3,  0, STR_PAD_LEFT);

                $model->no_rm = strtoupper($string)  .  $values;
            }
        });
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }

    public function getRouteKeyName()
    {
        return 'no_rm';
    }

    public function account()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function graduated()
    {
        return $this->belongsTo(Graduated::class, 'graduated_id');
    }
    public function work()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }

    public function couple()
    {
        return $this->hasOne(Couple::class);
    }

    public function acceptor()
    {
        return $this->hasMany(Acceptor::class);
    }
}
