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
  <script type="text/javascript" src="__STATIC__/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
  <script>DD_belatedPNG.fix('*');</script>
  <title>{$title|default="标题"}</title>
  <meta name="keywords" content="{$keywords|default='关键字'}">
  <meta name="description" content="{$description|default='描述'}">
  </head>
<body>
  <article class="cl pd-20">
    <form action="" method="post" class="form form-horizontal" id="form-teacher-edit">

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名:</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text disable" value="{$teacher_info.name}" placeholder="姓名" id="name"
                       name="name" style="width: 500px">
            </div>

        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>学历:</label>
            <div class="form-Controls col-xs-8 col-sm-9">
                <input type="text" id="degree" name="degree" class="input-text" autocomplete="off" placeholder="学历"
                       style="width: 500px"   value="{$teacher_info.degree}">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>毕业学校:</label>
            <div class="form-Controls col-xs-8 col-sm-9">
                <input type="text" class="input-text" id="school" name="school" placeholder="学费" style="width: 500px"
                       value="{$teacher_info.school}">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机号:</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" maxlength="11" placeholder="phoneNumber"
                       style="width: 500px"   value="{$teacher_info.mobile}" name="mobile" id="mobile">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>入职时间:</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="hiredate" name="hiredate" placeholder="入职时间" type="date" value="{$teacher_info.hiredate}">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">负责班级:</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width: 150px">
                    <select class="select" name="grade_id" size="1">
                        {volist name='gradeList' id='vo'}
                        <option value="{$vo.id}" selected>{$vo.name}</option>
                        {/volist}
                        <option value="0" selected>不分配</option>
                    </select>
              </span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">状态:</label>
            <div class="form-Controls col-xs-8 col-sm-9">
              <span class="select-box" style="width:150px"><select class="select" name="status" size="1">
                      {eq name='$teacher_info.status' value="1"}
                      <option value="1">启用</option>
                      {else /}
                      <option value="0" selected>不启用</option>
                      {/eq}
                  </select>
              </span>
            </div>
        </div>

        <!--將当前记录的id作为隐藏域发送到服务器-->
        <input type="hidden" value="{$teacher_info.id}" name="id">

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
    //当用户修改了输入框内容时才触发
    $("form").children().change(function(){
        $("#submit").removeClass('disabled');
    });
    //ajax方式提交当前表单数据
    $("#submit").on("click", function(event){
        $.ajax({
            type: "POST",
            url: "{:url('teacher/doEdit')}",
            data: $("#form-teacher-edit").serialize(),
            dataType: "json",
            success: function(data){
                if (data.status == 1) {
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            }
        });
    })
})
</script>
</body>
</html>