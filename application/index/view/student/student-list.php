<?php
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="__STATIC__/lib/html5shiv.js"></script>
<script type="text/javascript" src="__STATIC__/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="__STATIC__/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb">学生信息 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
  <div class="cl pd-5 bg-1 bk-gray mt-1">
    <span class="l"><a href="javascript:;" onclick="dataDel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i>批量恢复</a>
    <a href="javascript:;" onclick="student_add('添加学生','{:url('student/studentAdd')}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加学生</a></span>
    <span class="r">共有数据：<strong>{$count}</strong> 条</span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <th width="40">ID</th>
        <th width="60">姓名</th>
        <th width="40">性别</th>
        <th width="40">年龄</th>
        <th width="130">手机号</th>
        <th width="150">邮箱</th>
        <th width="100">入学时间</th>
        <th width="130">班级</th>
        <th width="70">状态</th>
        <th width="100">操作</th>
      </tr>
    </thead>
    <tbody>
      {volist name='studentList' id='vo'}
      <tr class="text-c">
        <td>{$vo.id}</td>
        <td>{$vo.name}</td>
        <td>{$vo.sex}</td>
        <td>{$vo.age}</td>
        <td>{$vo.mobile}</td>
        <td>{$vo.email}</td>
        <td>{$vo.start_time}</td>
        <td>{$vo.grade}</td>
        <td class="td-status">
            {if condition="$vo.status eq '1'"}
            <span class="label label-success radius">已启用</span>
            {else /}
            <span class="label label-default radius">已停用</span>
            {/if}
        </td>
        <td class="td-manage">
            {if condition="$vo.status eq '1'"}
            <a style="text-decoration:none" onClick="stu_stop(this,{$vo.id})" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
            {else /}
            <a title="text-decoration:none" onclick="stu_start(this,{$vo.id})" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>
            {/if}
            <a title="编辑" href="javascript:;" onclick="student_edit('编辑学生','{:url("student/stuEdit",["id"=>$vo["id"]])}','1','800','500')" class="ml-5"
            style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
            <a title="删除" href="javascript:;" onclick="student_del(this,{$vo.id})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
        </td>
      </tr>
      {/volist}
    </tbody>
  </table>
<!-- 分页-->
  <div id="pageNav" class="pageNav">

  </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="__STATIC__/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="__STATIC__/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

function stu_stop(obj, id) {
    layer.confirm('确认要停用吗？', function (index) {
        $.get("{:url('student/setStatus')}", {id: id});
        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="stu_start(this,' + id + ')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已停用</span>');
        $(obj).remove();
        layer.msg('已停用', {icon: 5, time: 1000});
    })
}

//启用的方法
function stu_start(obj, id) {
    layer.confirm('确认要启用吗？', function (index) {
        $.get("{:url('student/setStatus')}", {id: id});
        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="stu_stop(this ,id )" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
        $(obj).remove();
        layer.msg('已启用', {icon: 6, time: 1000});

    })
}
//添加的方法
function student_add(title, url, w, h) {
    $.post(url);
    layer_show(title, url, w, h);
}

//
function student_edit(title, url, id, w, h){
    $.get(url,{id : id });
    layer_show(title, url, w, h);
}

//删除教师
function student_del(obj,id){
    layer.confirm('确认要删除吗？', function (index) {
        $.get("{:url('student/deleteStu')}", {id: id});
        $(obj).parents("tr").remove();
        layer.msg('已删除!', {icon: 1, time: 1000});
    });
}

    function dataDel(){
        layer.confirm("确认要恢复吗？", function (index) {
            $.get("{:url('student/unDelete')}");
            layer.msg("已恢复",{icon:1,time:1000});
            window.location.reload();
        });
    }
</script>
</body>
</html>
