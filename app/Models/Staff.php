<?php

namespace App\Models;

use App\Models\User;
use App\Models\Position;
use App\Models\Graduated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'employe_id',
        'user_id',
        'position_id',
        'graduated_id',
        'name',
        'phoneNumber',
        'place_brithday',
        'date_brithday',
        'gender',
        'address',
    ];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $staff = Staff::where('position_id', $model->position->id)->get();
    //         $getValue = $staff->count() + 1;

    //         $values = str_pad($getValue, 5,  0, STR_PAD_LEFT);

    //         $model->employe_id = strtoupper($model->position->position_code)  . $values;
    //     });
    // }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $string = $model->position->position_code;
            $stringLenght = strlen($string);
            $staff = Staff::where('position_id', $model->position->id)->get();
            $counter = $staff->count();
            $values = '';

            if ($staff->count() <= 0) {
                $values =  substr(str_pad($counter, 3,  0, STR_PAD_LEFT), -1) . '01';
                $model->employe_id = strtoupper($string)  . $values;
            } else {
                $lastData = Staff::orderBy('employe_id', 'desc')->first();
                $position_code = intval(substr($lastData->employe_id, $stringLenght)) + 1;
                $values = str_pad($position_code, 3,  0, STR_PAD_LEFT);
                $model->employe_id = strtoupper($string)  .  $values;
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'employe_id';
    }

    public function account()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function graduated()
    {
        return $this->belongsTo(Graduated::class, 'graduated_id');
    }
}
