<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ranges extends Model
{
    //定义模型关联的数据表
    protected $table = 'ranges';
    //定义主键
    protected $primaryKey = 'id';
    public $timestamps = false;
    //设置允许写入的字段
    protected $fillable = ['id','region','log_id'];
}
