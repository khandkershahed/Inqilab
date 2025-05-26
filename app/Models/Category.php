<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasSlug;

    protected $slugSourceColumn = 'name';

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // public function children()
    // {
    //     return $this->hasMany(Category::class, 'parent_id');
    // }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }
    public function primaryNews()
    {
        return $this->hasMany(News::class, 'category_id');
    }

    public function secondaryNews()
    {
        return $this->hasMany(News::class, 'sub_category_id');
    }

    public function allNews(): HasMany
    {
        return $this->hasMany(News::class, 'category_id')
            ->orWhere(function (Builder $query) {
                $query->whereColumn('sub_category_id', 'categories.id');
            });
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
