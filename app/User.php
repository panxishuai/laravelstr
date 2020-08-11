<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //模型关联表
    public $table = "peter_user";

    //设置主键
    public $primaryKey = "id";

    //禁用时间戳
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     * 允许被批量操作字段
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
