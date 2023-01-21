<?php

namespace App\Models;

use App\Models\FAQ;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteInformation extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'address',
        'telp',
        'email',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
    ];

    public function faq()
    {
        return $this->hasMany(FAQ::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class);
    }
}
