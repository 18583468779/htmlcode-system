<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'description',
        'preview',
        'chapter_id'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class); // 一个课程有多个视频
    }
}