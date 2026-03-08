<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    // Cho phép lưu các trường này vào Database
    protected $fillable = [
        'title',
        'show_title', // Thêm dòng này
        'image_path',
        'link',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_title' => 'boolean', // Thêm dòng này
    ];
}
