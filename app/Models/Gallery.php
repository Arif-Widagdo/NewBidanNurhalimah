<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;
    use Sluggable;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'category_id',
        'image',
        'slug',
        'title',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $slug = SlugService::createSlug(Gallery::class, 'slug', $model->title);
            $model->slug = $slug;
        });

        static::updating(function ($model) {
            $slug = SlugService::createSlug(Gallery::class, 'slug', $model->title);
            $model->slug = $slug;
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
