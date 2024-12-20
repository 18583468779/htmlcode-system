<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'preview'
    ];

    public function lessons()
    {
        // 一个章节有多个课程
        return $this->hasMany(Lesson::class);
    }
}