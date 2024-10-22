<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    public $fillable = [
        'title',
        'path'
    ];
    public $hidden = ["path"]; // 隐藏播放地址
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function chapter(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->lesson->chapter
        );
    }
}
