<?php

namespace App\Models;

use App\Models\SiteInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FAQ extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        'id',
        'site_id',
        'title',
        'description',
    ];

    public function siteInformation()
    {
        return $this->belongsTo(SiteInformation::class, 'site_id');
    }
}
