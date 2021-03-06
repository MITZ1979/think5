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
        $studentList=StudentModel::paginate(5);
        $count = StudentModel::count();
        //$studentList []= null; 等于$studentList [0]= null;
        //$studentList = []; //空字符串
        foreach($studentList as $value){
            $value ->grade = $value->grade->name;
        }
        $this->view->assign('count',$count);
        $this->view->assign('studentList',$studentList);
        return $this->view->fetch('student-list');
    }
    //曾（渲染添加页面）
    public function studentAdd()
    {
        //将班级表中所以数据赋值到当前模板中
        $this->view->assign('gradeList',\app\index\model\Grade::all());
        return $this->view->fetch('student-add');
    }
    //添加学生
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
    //删除学生
    public function deleteStu(Request $request)
    {
        $student_id=$request->param('id');
        //dump($student_id);
        StudentModel::update(['is_delete'=>1],['id'=>$student_id]);
        StudentModel::destroy($student_id);

    }
    //改(渲染页面)
    public function stuEdit(Request $request)
    {
        $stu_id=$request->param('id');
        $result=StudentModel::get($stu_id);
        $result->grade=$result->grade->name;
        $this->view->assign('student_info',$result);
        //关联查询
        $this->view->assign('gradeList',\app\index\model\Grade::all());
        return $this->view->fetch('student-edit');
    }
    //执行编辑
    public function doEdit(Request $request)
    {
        $data=$request->except('grade');
        $condition=['id'=>$data['id']];
        $result=StudentModel::update($data,$condition);
        //设置返回结果
        $status=0;
        $message='更新失败，请检查';

        if (true==$result){
            $status=1;
            $message='恭喜您，更新成功！';
        }
        return ['status'=>$status,'message'=>$message];
        //return '+<html>$message</html>+';//(['status'=>$status,'message'=>]);
    }
    //状态
    public function setStatus(Request $request)
    {
        $stu_id = $request->param('id');

        $result = GradeModel::get($stu_id);
        //
        if ($result->getData('status') == 1) {
            GradeModel::update(['status' => 0], ['id' => $stu_id]);
        } else {
            GradeModel::update(['status' => 1], ['id' => $stu_id]);
        }
        return $this->view->fetch('student_list');
    }
    //批量恢复数据
    public function unDelete(Request $request)
    {
        StudentModel::update(['delete_time' => NULL], ['is_delete' => 1]);
    }
}