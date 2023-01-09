<?php

namespace App\Models;

use App\Models\Couple;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Work extends Model
{
    use HasFactory;
    use Sluggable;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'slug',
        'job_status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function patient()
    {
        return $this->hasMany(Patient::class);
    }
    public function couple()
    {
        return $this->hasMany(Couple::class);
    }
}
