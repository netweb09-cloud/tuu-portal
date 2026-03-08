<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'order', // Chắc chắn phải có dòng này ở đây
        'page_id',
    ];
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class, 'category_id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order', 'asc');
    }

    public function page() {
        return $this->belongsTo(Page::class, 'page_id');
    }

    // Hàm bổ trợ để lấy tất cả ID (bao gồm chính nó và các con)
    public function getAllSubCategoryIds()
    {
        return $this->children()->pluck('id')->push($this->id)->all();
    }
   
}

