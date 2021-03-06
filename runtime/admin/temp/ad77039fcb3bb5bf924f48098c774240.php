<?php /*a:1:{s:52:"F:\www\www.study.com\app\admin\view\goods\index.html";i:1604196044;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/static/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/static/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/static/admin/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/static/admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>管理员管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="javascript:;" onclick="dataDel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a href="javascript:;" onclick="member_add('添加用户','<?php echo url('admin/create'); ?>','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a>
        </span>
        <span class="r">共有数据：<strong><?php echo htmlentities(count($data)); ?></strong> 条</span></div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="id"></th>
                <th width="80">ID</th>
                <th width="100">用户名</th>
                <th width="40">性别</th>
                <th width="90">手机</th>
                <th width="150">邮箱</th>
                <th width="130">注册时间</th>
                <th width="70">状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($data as $key=>$val): ?>
            <tr class="text-c">
                <td><input type="checkbox" value="<?php echo htmlentities($val['id']); ?>" name="id[]" class="checkbox"></td>
                <td><?php echo htmlentities($val['id']); ?></td>
                <td><?php echo htmlentities($val['username']); ?></td>
                <td>
                    <?php switch($val['sex']): case "1": ?>男<?php break; case "2": ?>女<?php break; default: ?>保密
                    <?php endswitch; ?>
                </td>
                <td><?php echo htmlentities($val['phone']); ?></td>
                <td><?php echo htmlentities($val['email']); ?></td>
                <td><?php echo htmlentities(date("Y-m-d H:i",!is_numeric($val['regtime'])? strtotime($val['regtime']) : $val['regtime'])); ?></td>
                <td class="td-status">
                    <?php switch($val['status']): case "0": ?><span class="label label-warning radius">已停用</span><?php break; case "2": ?><span class="label label-danger radius">已删除</span><?php break; default: ?><span class="label label-success radius">已启用</span>
                    <?php endswitch; ?>
                </td>
                <td class="td-manage">
                    <?php if($val['status'] == '1'): ?>
                    <a style="text-decoration:none" onClick="member_stop(this,<?php echo htmlentities($val['id']); ?>)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe60e;</i></a>
                    <?php else: ?>
                    <a style="text-decoration:none" onClick="member_start(this,<?php echo htmlentities($val['id']); ?>)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe605;</i></a>
                    <?php endif; ?>
                    <a title="编辑" href="javascript:;" onclick="member_edit('编辑','<?php echo url('admin/edit',['id'=>$val['id']]); ?>',<?php echo htmlentities($val['id']); ?>,'','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                    <a title="删除" href="javascript:;" onclick="member_del(this,<?php echo htmlentities($val['id']); ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $data; ?>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    /*用户-添加*/
    function member_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }

    /*用户-停用*/
    function member_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: "<?php echo url('admin/update'); ?>",
                data:{'id':id,'status':0},
                dataType: 'json',
                success: function (data) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe605;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!', {icon: 5, time: 1000});
                },
                error: function (data) {
                    layer.msg(data.msg);
                },
            });
        });
    }

    /*用户-启用*/
    function member_start(obj, id) {
        layer.confirm('确认要启用吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: "<?php echo url('admin/update'); ?>",
                data:{'id':id,'status':1},
                dataType: 'json',
                success: function (data) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe60e;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!', {icon: 6, time: 1000});
                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        });
    }

    /*用户-编辑*/
    function member_edit(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }

    /*用户-删除*/
    function member_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: "<?php echo url('admin/delete'); ?>",
                data:{'id':id},
                dataType: 'json',
                success: function (res) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        });
    }

    /*批量删除*/
    function dataDel() {
        var ids = new Array();
        $('tbody input:checkbox').each(function(){
            if(this.checked == true){
                ids.push(this.value);
            }
        });
        ids = ids.join(',');
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: "<?php echo url('admin/deleteAll'); ?>",
                data:{'ids':ids},
                dataType: 'json',
                success: function (res) {
                    layer.msg('已删除!', {icon: 1, time: 1000},function () {
                        parent.location.reload();
                    });
                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        });
    }
</script>
</body>
</html>