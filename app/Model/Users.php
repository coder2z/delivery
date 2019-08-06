<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Users extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //定义模型关联的数据表
    protected $table = 'users';
    //定义主键
    protected $primaryKey = 'id';

    public $timestamps = false;
    //设置允许写入的字段
    protected $fillable = ['id','name','tel','number','token','password','remember_token','cheak'];

    use Authenticatable;
}
