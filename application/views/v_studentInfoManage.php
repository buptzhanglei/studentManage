<!DOCTYPE html>
<html class=" js csstransforms3d"><head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>文章发布</title>
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
	<div class="super-content RightMain" id="RightMain">
		
		<!--header-->
		<div class="superCtab">
			<div class="ctab-title clearfix"><h3>信息管理</h3><a href="javascript:;" class="sp-column"><i class="ico-mng"></i>栏目管理</a></div>
			
			<div class="ctab-Main">
				<div class="ctab-Main-title">
					<ul class="clearfix">
						<li class="cur"><a href="manage">学生信息管理</a></li>
						<li><a href="teacherManage">教师信息管理</a></li>
					</ul>
				</div>
				
				<div class="ctab-Mian-cont">
					<div class="Mian-cont-btn clearfix">
						<div class="operateBtn">
							<a href="javascript:;" class="greenbtn add" onclick="addStudent()">添加学生</a>
							<a href="javascript:;" class="greenbtn add" onclick="alert('功能待开发')">导入信息</a>
						</div>
						<div class="searchBar">
							<input type="text" value="" class="form-control srhTxt" placeholder="输入标题关键字搜索" id="searchContent">
							<input type="button" class="srhBtn" value="" id="stdSearch">
						</div>
					</div>
					<!-- <div class="super-label clearfix">
						<a href="#">行业新闻<em style="display: none;"></em></a><a href="#">保险常识<em style="display: none;"></em></a>
					</div> -->
					
					<div class="Mian-cont-wrap">
						<div class="defaultTab-T">
							<table border="0" cellspacing="0" cellpadding="0" class="defaultTable">
								<tbody>
									<tr>
										<th class="t_1">ID</th>
										<th class="t_1">学号</th>
										<th class="t_1">姓名</th>
										<th class="t_1">班级</th>
										<th class="t_1">性别</th>
										<th class="t_1">年龄</th>
										<th class="t_1">邮箱</th>
										<th class="t_1">电话</th>
										<th class="t_1">住址</th>
										<th class="t_1">操作</th>
									</tr>
							    </tbody>
						    </table>
						</div>
						<table border="0" cellspacing="0" cellpadding="0" class="defaultTable defaultTable2">
						<tbody>
							<?php foreach ($res as $item):?>
							<tr>
								<td class="t_1"><?php echo $item['id']?></td>
								<td class="t_1"><?php echo $item['user_id']?></td>
								<td class="t_1"><?php echo $item['username']?></td>
								<td class="t_1"><?php echo $item['class']?></td>
								<td class="t_1"><?php echo $item['sex']=='0'?'男':'女'?></td>
								<td class="t_1"><?php echo $item['age']?></td>
								<td class="t_1"><?php echo $item['email']?></td>
								<td class="t_1"><?php echo $item['tel']?></td>
								<td class="t_1"><?php echo $item['address']?></td>
								<td class="t_1">
									<div class="btn">
										<a href="#" class="modify" onclick="modify(<?php echo $item['id']?>)">修改</a>
									</div>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					    </table>
						<!--pages S-->
						<div class="pageSelect">
							<span>共 <b><?php echo $page['num']?></b> 条 每页 <b>5 </b>条   <?php echo $page['currentPage']?>/<?php echo $page['pageNum']?></span>
							<div class="pageWrap">
								<?php echo $page['pageInfo']?>
							</div>
						</div>
						<!--pages E-->
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
							<th class="t_1"><input type="text" value="" style="width:130px" id="user_id" /></th>
							<th class="t_1">姓名</th>
							<th class="t_1"><input id="username" type="text" value="" style="width:130px"/></th>
						</tr>
						<tr>
							<th class="t_1">班级</th>
							<th class="t_1"><input type="text" value="" style="width:130px" id="class"/></th>
							<th class="t_1">性别</th>
							<th class="t_1">
								<select id="sex" name="sex" style="width:140px;height:40px">
								    <option value="0">男</option> 
									<option value="1">女</option> 
								</select> 
							</th>
						</tr>
						<tr>
							<th class="t_1">年龄</th>
							<th class="t_1"><input type="text" id="age" value="" style="width:130px" /></th>
							<th class="t_1">邮箱</th>
							<th class="t_1">
								<input type="text" id="email" style="width:130px" />
							</th>
						</tr>
						<tr>
							<th class="t_1">电话</th>
							<th class="t_1"><input type="text" id="tel" style="width:130px" />
							</th>
							<th class="t_1">住址</th>
							<th class="t_1"><input type="text" id="address" style="width:130px" />
							</th>
						</tr>
						<input type="hidden" value="" id="hiddenId"/>
						<input type="hidden" value="0" id="modifyType"/>
				    </tbody>
			    </table>
			</div>
			<div class="aFlBtn" align="center" style="margin-left: 0px"><input type="button" value="保存" class="saveBtn" id="saveInfo"></div>
		</div>
	</div>
<script>

	function addStudent(){
    	$("#modifyType").val(1);
    	$("#user_id").val('');
        $("#username").val('');
        $("#class").val('');
        $("#age").val(18);
        $("#sex").val(0);
        $("#email").val('');
        $("#tel").val('');
        $("#address").val('');
        openWindow();
    }

    $("#stdSearch").click(function(){
    	var content = $("#searchContent").val().replace(/(^\s*)|(\s*$)/g, "");
    	if(content == ''){
    		alert("搜索内容不能为空");die();
    	}
    	window.location = "manage?content="+content;
    });


    $("#saveInfo").click(function(){
    	var username = $("#username").val().replace(/(^\s*)|(\s*$)/g, "");
		var user_id = $("#user_id").val();
		var cla = $("#class").val().replace(/(^\s*)|(\s*$)/g, "");
		var age = $("#age").val().replace(/(^\s*)|(\s*$)/g, "");
        var sex = $("#sex").val();
        var email = $("#email").val();
        var tel = $("#tel").val();
        var address = $("#address").val();
        var id = $("#hiddenId").val();
        var modifyType = $("#modifyType").val();
		if(username=='' || user_id=='' || cla=='' || age=='' || email == '' || tel ==''|| address==''){
			alert("内容不能为空");die();
		}

		$.ajax({
        	type:'post',
        	url:'saveInfo',
        	data:{user_id:user_id,username:username,class:cla,age:age,sex:sex,email:email,tel:tel,address:address,id:id,type:modifyType},
        	dataType:'json',
        	success: function(json){
        		if(json['code'] != 0){
        			alert(json['desc']);
        		} else {
        			alert(json['desc']);
        			window.location = "manage";
        		}
        	}
        });
    });


	function makeSelect(data,room_id){
    	var room = "<select id='classroom' name='classroom' style='width:140px;height:40px'>";
    	if(room_id == 0){
            room += "<option value='0' selected='selected'>请选择</option>";
    	} else {
    		room += "<option value='0'>请选择</option>";
    	}
    	
        for(var i=0;i<data.length;i++){
        	if(room_id == data[i]['room_id']){
				room += "<option value='"+data[i]['room_id']+"' selected='selected'>"+"教三"+data[i]['room_id'];
        	    room += "</option>";
        	} else {
        		room += "<option value='"+data[i]['room_id']+"'>"+"教三"+data[i]['room_id'];
        	    room += "</option>";
        	}	
        }
        room += "</select>";
        $("#classroom").html(room);
    }


	function modify($id){
		$.ajax({
        	type:'post',
        	url:'modify',
        	data:{id:$id,userType:2},
        	dataType:'json',
        	success: function(json){
        		if(json['code'] != 0){
        			alert(json['desc']);
        		} else {
        			$("#user_id").val(json['data']['user_id']);
        			$("#username").val(json['data']['username']);
        			$("#class").val(json['data']['class']);
        			$("#age").val(json['data']['age']);
        			$("#sex").val(json['data']['sex']);
        			$("#email").val(json['data']['email']);
        			$("#tel").val(json['data']['tel']);
        			$("#address").val(json['data']['address']);
        			$("#hiddenId").val(json['data']['id']);
        			$("#modifyType").val(2);
        			openWindow();
        		}
        	}
        });
	}

	function openWindow(){	
		$(".layuiBg").css({
			display:"block",height:$(document).height()
		});
		$(".addFeileibox").css({
			left:($("body").width()-$(".addFeileibox").width())/2-20+"px",
			top:($(window).height()-$(".addFeileibox").height())/2+$(window).scrollTop()+"px",
			display:"block"
		});
	}

</script>
</body></html>