<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/4
 * Time: 13:39
 */

namespace app\index\controller;

use app\index\model\Student as StudentModel;
use think\Request;

class Student extends Base
{
    //查询
    public function student()
    {
        $student=StudentModel::all();
        $count = StudentModel::count();
        $studentList[]=null;
        foreach($student as $value){
            $data=[
                'id'=>$value->id,
                'name'=>$value->name,
                'sex'=>$value->sex,
                'age'=>$value->age,
                'mobile'=>$value->mobile,
                'email'=>$value->email,
                'status'=>$value->status,
            ];
            $studentList[]=$data;
        }
        $this->view->assign('count',$count);
        $this->view->assign('studentList',$studentList);
        return $this->view->fetch('student-list');
    }
    //曾
    public function studentAdd()
    {
        //将班级表中所以数据赋值到当前模板中
        $this->view->assign('gradeList',\app\index\model\Grade::all());
        return $this->view->fetch('student-add');
    }
    public function doAdd(Request $request)
    {
        //从添加页面获取数据
        $data=$request->param();
        //将数据创建到数据库中
        $rusult=StudentModel::create($data);
        //设置返回状态
        $status=0;
        $message='添加失败，请检查！';
        if (true==$rusult){
            $status=1;
            $message='恭喜您，添加成功';
        }
        return ['status'=>$status,'message'=>$message];
    }
    //删
    public function deleteStu()
    {

    }
    //改
    public function stuEdit()
    {}
    //状态
    public function setStatus()
    {}
    //
    public function unDelete(Request $request)
    {
        StudentModel::update(['delete_time' => NULL], ['is_delete' => 1]);
    }
}