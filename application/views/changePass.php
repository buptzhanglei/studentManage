<!DOCTYPE html>
<html class=" js csstransforms3d"><head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>文章发布</title>
	<link rel="stylesheet" href="../../css/base.css">
	<link rel="stylesheet" href="../../css/page.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<style>
		.z_1 { width: 20%; text-align: right;}
		.z_2 { width: 30%; text-align: left;}
		.z_3 { width: 30%; text-align: left;}
	</style>
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
			<div class="ctab-title clearfix"><h3>个人信息>>密码修改</h3></div>
			
			<div class="ctab-Main">
				<div class="ctab-Mian-cont" align="center">
					<br><br>
					<div class="Mian-cont-wrap" align="center" style="width:600px">
						<table border="0" cellspacing="0" cellpadding="0"  class="defaultTable defaultTable2">
							<tbody>
							<tr>
								<td class="z_1"><font color="red">*</font>&nbsp;当前密码：</td>
								<td class="z_2" ><input type="text" class="form-control inp" id="opassword"></td>
								<td class="z_3"><font color="red" style="display:none" id="opassword2">&nbsp;&nbsp;请输入当前密码！</font></td>
							</tr>
							<tr>
								<td class="z_1"><font color="red">*</font>&nbsp;新密码：</td>
								<td class="z_2"><input type="text" class="form-control inp" id="npassword"></td>
								<td class="z_3"><font color="red" style="display:none" id="npassword2">&nbsp;&nbsp;请输入新密码！</font></td>
							</tr>
							<tr>
								<td class="z_1"><font color="red">*</font>&nbsp;确认新密码：</td>
								<td class="z_2"><input type="text" class="form-control inp" id="renpassword"></td>
								<td class="z_3"><font color="red" style="display:none" id="renpassword2">&nbsp;&nbsp;两次密码不一致！</font></td>
							</tr>
						    </tbody>
						</table>
					</div>
					<br><br>
					<div align="center">
					    <button class="btn btn-success" style="align-content:center" id="changepass">确认修改</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					    <button class="btn btn-warning" id="goBack">返回</button>
				    </div>
				</div>
			</div>
		</div>
		<!--main-->
		
	</div>
	<!--content E-->
<script type="text/javascript" src="js/zxxFile.js"></script>
<script>
    $(".inp").click(function(){
    	$("#opassword2").css('display','none');
    	$("#npassword2").css('display','none');
    	$("#renpassword2").css('display','none');
    });

    $("#goBack").click(function(){
    	javascript:history.back(1);  //返回前一页
    });

	$("#changepass").click(function(){
		var opassword = $("#opassword").val().replace(/(^\s*)|(\s*$)/g, "");
		var npassword = $("#npassword").val().replace(/(^\s*)|(\s*$)/g, "");
		var renpassword = $("#renpassword").val().replace(/(^\s*)|(\s*$)/g, "");
		if(opassword == ''){
			$("#opassword2").css('display','block');
			die();
		}
		if(npassword == ''){
			$("#npassword2").css('display','block');
			die();
		}
		if(renpassword != npassword){
			$("#renpassword2").css('display','block');
			die();
		}

        $.ajax({
        	type:'post',
        	url:'changePass',
        	data:{type:1,opassword:opassword,npassword:npassword},
        	dataType:'json',
        	success: function(json){
        		if(json['code'] != 0){
        			alert(json['desc']);
        			$('#remind').text(json['desc']);
        		} else {
        			alert(json['desc']);
        			window.top.location = "logout"; //密码修改成功后，跳转登录页面
        		}
        	}
        });

	});
</script>
</body></html>