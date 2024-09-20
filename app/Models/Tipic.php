<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipic extends Model
{
    use HasFactory;

    protected $fillable = [ // 允许填充的字段
        'title',
        'content'
    ];

    // protected $guarded = [ // 不允许填充的字段
    //     'id',
    //     'user_id'
    // ];
}