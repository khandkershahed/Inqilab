<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    use HasFactory;
    // protected $slugSourceColumn = 'name';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }
    // public function getImageUrlAttribute()
    // {
    //     return asset('storage/' . $this->image);
    // }
}
