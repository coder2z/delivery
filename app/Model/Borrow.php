<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    //定义模型关联的数据表
    protected $table = 'borrow';
    //定义主键
    protected $primaryKey = 'id';

    public $timestamps = false;
    //设置允许写入的字段
    protected $fillable = ['id','receiver','status','tel','goods','number','order_time','rangs_id','sale','specifications','weight'];
}
