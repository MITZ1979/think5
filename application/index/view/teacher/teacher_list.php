<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
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
<nav class="breadcrumb">教师信息 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
  <div class="cl pd-5 bg-1 bk-gray mt-1">
    <span class="l"><a href="javascript:;" onclick="unDelete()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量恢复</a>
    <a href="javascript:;" onclick="teacher_add('添加教师','{:url("teacher/teacherAdd")}','800','510')" class="btn btn-primary radius"><i class="icon-plus"></i> 添加用户</a></span>
    <span class="r">共有数据：<strong>{$count}</strong>条</span>
  </div>
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th style="width: 30px;">ID</th>
            <th style="width: 40px;">姓名</th>
            <th style="width: 50px;" >学历</th>
            <th style="width: 100px;">手机号</th>
            <th style="width: 150px;">毕业学校</th>
            <th style="width: 100px;">入职时间</th>
            <th style="width: 150px;">负责班级</th>
            <th style="width: 50px;">状态</th>
            <th style="width: 100px;">操作</th>
        </tr>
        </thead>
        <tbody>
        {volist name='teacherList' id='vo'}
        <tr class="text-c">
            <td>{$vo.id}</td>
            <td>{$vo.name}</td>
            <td>{$vo.degree}</td>
            <td>{$vo.mobile}</td>
            <td>{$vo.school}</td>
            <td>{$vo.hiredate}</td>
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
                <a style="text-decoration:none" onClick="teach_stop(this,{$vo.id})" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
                {else /}
                <a title="text-decoration:none" onclick="teach_start(this,{$vo.id})" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>
                {/if}
                <a title="编辑" href="javascript:;" onclick="teach_edit('编辑教师','{:url("teacher/teacherEdit",["id"=>$vo["id"]])}','1','800','500')" class="ml-5"
                style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                <a title="删除" href="javascript:;" onclick="teach_del(this,{$vo.id})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
            </td>
        </tr>
        {/volist}
        </tbody>
    </table>
    <div id="pageNav" class="pageNav"></div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__STATIC__/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="__STATIC__/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="__STATIC__/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    window.onload = (function () {
        // optional set
        pageNav.pre = "&lt;上一页";
        pageNav.next = "下一页&gt;";
        // p,当前页码,pn,总页面
        pageNav.fn = function (p, pn) {
            $("#pageinfo").text("当前页:" + p + " 总页: " + pn);
        };
        //重写分页状态,跳到第三页,总页33页
        pageNav.go(1, 13);
    });
//    $('.table-sort').dataTable({
//        "lengthMenu": false,//显示数量选择
//        "bFilter": false,//过滤功能
//        "bPaginate": false,//翻页信息
//        "bInfo": false,//数量信息
//        "aaSorting": [[1, "desc"]],//默认第几个排序
//        "bStateSave": true,//状态保存
//        "aoColumnDefs": [
//            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
//            {"orderable": false, "aTargets": [0, 8, 9]}// 制定列不参与排序
//        ]
//    });

//停用的方法
function teach_stop(obj, id) {
    layer.confirm('确认要停用吗？', function (index) {
        $.get("{:url('teacher/setStatus')}", {id: id});
        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="teach_start(this,' + id + ')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已停用</span>');
        $(obj).remove();
        layer.msg('已停用', {icon: 5, time: 1000});
    })
}

//启用的方法
function teach_start(obj, id) {
    layer.confirm('确认要启用吗？', function (index) {
        $.get("{:url('teacher/setStatus')}", {id: id});
        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="teach_stop(this ,id )" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
        $(obj).remove();
        layer.msg('已启用', {icon: 6, time: 1000});
    })
}

    //添加教师的方法
    function teacher_add(title, url, w, h) {
        $.post(url);
        layer_show(title, url, w, h);
    }

    //
    function teach_edit(title, url, id, w, h){
        $.get(url,{id : id });
        layer_show(title, url, w, h);
    }
    //删除教师
    function teach_del(obj,id){
        layer.confirm('确认要删除吗？', function (index) {
            $.get("{:url('teacher/deleteTeacher')}", {id: id});
            $(obj).parents("tr").remove();
            layer.msg('已删除!', {icon: 1, time: 1000});
        });
    }
    //批量恢复
    function unDelete() {
        layer.confirm('确认要恢复吗？', function (index) {
            $.get('{:url("teacher/unDelete")}');
            layer.msg('已恢复！',{icon:1, time:1000});
            window.location.reload();
        })
    }
</script>
</body>
</html>
