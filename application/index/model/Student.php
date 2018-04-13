<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 13:54
 */

namespace app\index\model;


use think\Model;
use traits\model\SoftDelete;

class Student extends Model
{
    //
    use SoftDelete;
    //
    protected $dateFormat = 'Y/m/d';
    //
    protected $deleteTime='delete_time';

    protected $autoWriteTimestamp = true;
    //
    protected $createTime = 'create_time';
    //
    protected $updateTime = 'update_time';
    //
    protected $insert=[
        'status'=>1
    ];

    protected $type = [
        'start_time'=>'timestamp'
    ];

    //
    public function SexAttr($value)
    {
        $sex = [
            0 => '女',
            1 => '男'
        ];
        return $sex[$value];
    }

    //
    public function grade()
    {
        return $this->belongsTo('grade');
    }
}