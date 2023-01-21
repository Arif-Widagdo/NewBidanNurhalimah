<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        'id',
        'category_id',
        'image',
        'title',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
