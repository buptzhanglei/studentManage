<!DOCTYPE html>
<html class=" js csstransforms3d"><head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>选课系统</title>
	<link rel="stylesheet" href="../../css/base.css">
	<link rel="stylesheet" href="../../css/page.css">
	<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/main.js"></script>
	<script type="text/javascript" src="../../js/modernizr.js"></script>
	<!--[if IE]>
	<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>

<body style="background: #f6f5fa;">

	<!--content S-->
	<div class="super-content">
		<div class="superCtab">
			<div class="ctab-title clearfix"><h3>个人信息</h3>
				<!-- <a href="javascript:;" class="sp-column"><i class="ico-mng"></i>信息管理</a> -->
			</div>
			
			<div class="ctab-Main">
				<div class="ctab-Main-title">
					<ul class="clearfix">
						<li class="cur"><a href="to_body">详细信息</a></li>
						<li><a href="" onclick="alert('项目开发中')">课表信息</a></li>
					</ul>
				</div>
				
				<div class="ctab-Mian-cont">
					<div class="Mian-cont-btn clearfix">
						<div class="operateBtn">
							<!-- <a href="javascript:;" class="greenbtn add" onclick="alert('功能开发中')">添加分类</a> -->
						</div>
						<div class="searchBar">
							<!-- <input type="text" id="" value="" class="form-control srhTxt" placeholder="输入标题关键字搜索">
							<input type="button" class="srhBtn" value=""> -->
						</div>
					</div>
					<div class="Mian-cont-wrap">
						<div class="defaultTab-T">
							<table border="0" cellspacing="0" cellpadding="0" class="defaultTable">
								<tbody>
									<tr>
										<th class="t_1">序号ID</th>
										<th class="t_1">学号</th>
										<th class="t_1">姓名</th>
										<th class="t_1">班级</th>
										<th class="t_1">性别</th>
										<th class="t_1">年龄</th>
										<th class="t_1">邮箱</th>
										<th class="t_1">联系方式</th>
										<th class="t_1">操作</th>
									</tr>
							    </tbody>
						    </table>
						</div>
						<table border="0" cellspacing="0" cellpadding="0" class="defaultTable defaultTable2">
							<tbody>
								<tr>
									<td class="t_1"><?php echo $id?></td>
									<td class="t_1"><?php echo $user_id?></td>
									<td class="t_1"><?php echo $username?></td>
									<td class="t_1"><?php echo $class?></td>
									<td class="t_1"><?php echo $sex?></td>
									<td class="t_1"><?php echo $age?></td>
									<td class="t_1"><?php echo $email?></td>
									<td class="t_1"><?php echo $tel?></td>
									<td class="t_1"><div class="btn" id="modify"><a href="#" class="modify">修改</a></div></td>
							    </tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--main-->
		
	</div>
	<!--content E-->
	<!--点击修改弹出层-->
	<div class="layuiBg" style="display: none; height: 757px;"></div><!--公共遮罩-->
	<!--点击添加分类弹出-->
	<div class="addFeileibox layuiBox">
		<div class="layer-title clearfix"><h2>修改信息</h2><span class="layerClose"></span></div>
		<div class="layer-content">
			<div class="aFllink clearfix" style="margin-top: 38px;">
				<table border="0" cellspacing="0" cellpadding="0" class="defaultTable">
					<tbody>
						<tr>
							<th class="t_1">学号</th>
							<th class="t_1"><input type="text" value="<?php echo $user_id?>" style="width:130px" disabled="true" id="user_id" /></th>
							<th class="t_1">姓名</th>
							<th class="t_1"><input id="username" type="text" value="<?php echo $username?>" style="width:130px"/></th>
						</tr>
						<tr>
							<th class="t_1">姓名</th>
							<th class="t_1"><input type="text" value="<?php echo $username?>" style="width:130px" /></th>
							<th class="t_1">班级</th>
							<th class="t_1"><input type="text" id="class" value="<?php echo $class?>" style="width:130px"/></th>
						</tr>
						<tr>
							<th class="t_1">性别</th>
							<th class="t_1"><input type="text" id="sex" value="<?php echo $sex?>" style="width:130px" /></th>
							<th class="t_1">年龄</th>
							<th class="t_1"><input type="text" id="age" value="<?php echo $age?>" style="width:130px"/></th>
						</tr>
						<tr>
							<th class="t_1">邮箱</th>
							<th class="t_1"><input type="text" id="email" value="<?php echo $email?>" style="width:130px" /></th>
							<th class="t_1">联系方式</th>
							<th class="t_1"><input type="text" id="tel" value="<?php echo $tel?>" style="width:130px"/></th>
						</tr>
				    </tbody>
			    </table>
			</div>
			<div class="aFlBtn" align="center" style="margin-left: 0px"><input type="button" value="保存" class="saveBtn" id="saveModify"></div>
		</div>
	</div>
	
	<!-- <div class="ColumnXgbox layuiBox">
		<div class="layer-title clearfix"><h2>添加分类</h2><span class="layerClose"></span></div>
		<div class="layer-content">
			<div class="aFllink clearfix"><span>修改名称：</span><input type="text" value=""></div>
			<div class="aFllink clearfix"><span>英文名称：</span><input type="text" value=""></div>
			<div class="aFlBtn"><input type="button" value="保存" class="saveBtn"></div>
		</div>
	</div> -->
</body></html>
<script>
	//LabelAdd();	
	$("#modify").click(function(){	
		$(".layuiBg").css({
			display:"block",height:$(document).height()
		});
		$(".addFeileibox").css({
			left:($("body").width()-$(".addFeileibox").width())/2-20+"px",
			top:($(window).height()-$(".addFeileibox").height())/2+$(window).scrollTop()+"px",
			display:"block"
		});
	});

	$("#saveModify").click(function(){

		var user_id = $("#user_id").val().replace(/(^\s*)|(\s*$)/g, "");
		var username = $("#username").val().replace(/(^\s*)|(\s*$)/g, "");
		var cla = $("#class").val().replace(/(^\s*)|(\s*$)/g, "");
		var sex = $("#sex").val().replace(/(^\s*)|(\s*$)/g, "");
		var age = $("#age").val().replace(/(^\s*)|(\s*$)/g, "");
		var email = $("#email").val().replace(/(^\s*)|(\s*$)/g, "");
		var tel = $("#tel").val().replace(/(^\s*)|(\s*$)/g, "");

		if(tel=='' || username=='' || cla=='' || sex=='' || age=='' || email==''){
			alert("内容不能为空");die();
		}

		$.ajax({
        	type:'post',
        	url:'saveModify',
        	data:{username,username,class:cla,sex:sex,age:age,email:email,tel:tel,user_id:user_id},
        	dataType:'json',
        	success: function(json){
        		if(json['code'] != 0){
        			alert(json['desc']);
        			$('#remind').text(json['desc']);
        		} else {
        			alert(json['desc']);
        			window.location = "to_body"; 
        		}
        	}
        });


	});
</script>
