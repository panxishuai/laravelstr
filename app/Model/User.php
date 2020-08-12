<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = "user";
    //主键  
    public $primaryKey = "user_id";
    //禁用时间戳
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     * 允许被批量操作字段
     * @var array
     */
    // protected $fillable = [
    //     'user_name', 'user_pass','email','phone'
    // ];
    public $guarded = [];
}
