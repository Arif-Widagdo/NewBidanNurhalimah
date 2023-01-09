<?php

namespace App\Models;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;
    use Sluggable;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'position_code',
        'slug',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $len = strlen($model->name);
            $half = $len / 2;
            $start = substr($model->name, 0, 1);
            $mid = ($len % 2 == 0) ? substr($model->name, (floor($half) - 1), 2) : substr($model->name, $half, 1);
            $end = substr($model->name, -1);
            $exsist = Position::where('position_code', 'like', '%' . strtoupper($start . $mid . $end) . '%')->get();

            if ($exsist->count() <= 0) {
                $model->position_code = strtoupper($start . $mid . $end);
            } else {
                $model->position_code = strtoupper($start . $mid . $end) . $exsist->count() + 1;
            }
        });
    }

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

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
