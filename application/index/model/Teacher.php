<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/31
 * Time: 20:19
 */
namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;

class Teacher extends Model
{
    use SoftDelete;

    protected $dateFormat = 'Y/m/d';

    protected $deleteTime = 'delete_time';

    protected $autoWriteTimestamp = true;

    protected $createTime = 'create_time';

    protected $updateTime = 'update_time';


    protected $type = [
        'hiredate' => 'timestamp'
    ];

    protected $insert=[
        'status'=>1
    ];

    public function Grade()
    {
        return $this->belongsTo('Grade');
    }

    public function DegreeAttr($value)
    {
        $degree=[
            1 => '专科生',
            2=> '本科生',
            3=> '研究生',
        ];
        return $degree[$value];
    }
}