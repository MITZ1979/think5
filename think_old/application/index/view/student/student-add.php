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
<title>添加学生</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-student-add">

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名:</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" id="name" name="name" placeholder="姓名" value="" style="width: 500px">
		</div>
	</div>

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>性别:</label>
		<div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" id="sex" name="sex" placeholder="性别" value="" style="width: 500px">
		</div>
	</div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>年龄:</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text"  placeholder="年龄" name="age" id="age" value=""  style="width: 500px" >
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机号:</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input id="mobile" class="input-text" name="mobile" placeholder="mobile" type="text" maxlength="11" value=""  style="width: 500px" >
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱:</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text"  placeholder="@" name="email" id="email"  style="width: 500px" >
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>入学时间:</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input id="start_time" name="start_time" placeholder="入学时间" type="date" value="">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">班级:</label>
        <div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width: 150px">
                <select class="select" name="grade_id" size="1">
                    {volist name='gradeList' id='vo'}
                    <option value="{$vo.id}" selected>{$vo.name}</option>
                    {/volist}
                </select>
            </span>
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">启用状态:</label>
        <div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width: 150px;">
                <select class="select" name="status" size="1">
                    <option value="1">启用</option>
                    <option value="0" selected>不启用</option>
                </select>
            </span>
        </div>
    </div>

	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" id="submit">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="__STATIC__/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
    //防止用户无更新提交，只有表中用户更新了才提交
    $("form").children().change(function () {
        $("#submit").removeClass('disable');
    });

    //提交表單
    $("#submit").on("click",function (event) {
        $.ajax({
            type:"POST",
            url:"{:url('student/doAdd')}",
            data:$("#form-student-add").serialize(),
            dataType:"json",
            success: function (data) {
                if (data.status==1){
                    alert(data.message);
                }else {
                    alert(data.message);
                }
            }
        });
    });
});
</script>
</body>
</html>