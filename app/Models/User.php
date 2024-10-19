<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 返回给前端隐藏的值
        'password',
        'remember_token',
        'mobile',
        'unionid',
        'email'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public $appends = [
        'is_administrator'
    ];

    /***
     *
     * 是否为超级管理员
     *
     */
    protected function isAdministrator(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->id == 1
        );
    }
    public function tipics()
    {
        return $this->hasMany(Tipic::class); // 一个用户可以有多个帖子
    }
    public function orders()
    {
        return $this->hasMany(Order::class); // 一个用户可以有多个订单

    }
    public function chapters(): Attribute
    {
        // $user->orders->pluck('chapter_id')->toArray() 获取当前用户的所有订单的章节id
        // Chapter::whereIn('id', $user->orders->pluck('chapter_id'))->get()->toArray(); // 根据订单的章节id查询对应的章节
        return Attribute::make(
            get: fn() => Chapter::whereIn('id', $this->orders->pluck('chapter_id'))->get()
        );
    }
}
