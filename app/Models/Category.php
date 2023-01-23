<?php

namespace App\Models;

use App\Models\Gallery;
use App\Models\SiteInformation;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'site_id',
        'name',
        'slug',
        'status',
    ];

    public function siteInformation()
    {
        return $this->belongsTo(SiteInformation::class, 'site_id');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
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
}
