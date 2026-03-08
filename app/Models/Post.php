<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'content', 'thumbnail', 'category_id', 'is_published', 'slug'];

    // Thiết lập quan hệ ngược lại với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 1. Tự động cắt tiêu đề 80 ký tự
    /*protected function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::limit($value, 100, '...'),
        );
    }
    */

    // 2. Tự động lấy mô tả từ 120-150 từ
    // Lưu ý: Ta dùng 'words' thay vì 'limit' (ký tự) theo yêu cầu của bạn
    public function getShortDescriptionAttribute()
    {
        return Str::words($this->description, 200, '...'); 
    }
}
