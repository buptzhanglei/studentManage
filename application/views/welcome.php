
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>选课系统</title>
	<link rel="stylesheet" href="../../css/base.css" />
	<link rel="stylesheet" href="../../css/login.css" />
</head>
<body>
<div class="superlogin">
	<div align="center" style="height:200px;padding-top:100px;">
		<font size="10" face="verdana">软件学院学生选课系统</font>
	</div>
</div>
<div class="loginBox">
	<div class="loginMain">
		<div class="tabwrap">
		<table border="0" cellspacing="0" cellpadding="0">
			<tr><td class="title">用户名：</td><td><input type="text" class="form-control txt" id="user_id" onclick="focuss()"/></td></tr>
			<tr><td class="title">密   码：</td><td><input type="password" class="form-control txt" id="password" onclick="focuss()"/></td></tr>
			<tr><td class="title">验证码：</td><td><input type="text" class="form-control txt txt2" id="captcha" onclick="focuss()"/><span class="yzm"><img id="captcha_img" src="createImg" onclick="document.getElementById('captcha_img').src='createImg?r='+Math.random()" style="cursor:pointer" /></span></td></tr>
			<tr class="errortd"><td>&nbsp;</td><td><span class="errorword" id="remind"></span></td></tr>		
			<tr><td>&nbsp;</td><td><input type="button" class="loginbtn" value="登录" onclick="check_login()"/><input type="button" class="resetbtn" value="忘记密码" onclick="alert('请联系管理员')"/></td></tr>		
			<tr><td>&nbsp;</td><td class="forgetpsw"></td></tr>	
		</table>
		</div>
	</div>
</div>
<div class="footer">Copyright © 2016-2017 ALalei  All Rights Reserved.</div>
</body>
</html>
<script src="../../js/jquery-2.1.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script>
	function check_login(){
		var user_id = $("#user_id").val().replace(/(^\s*)|(\s*$)/g, "");
		var password = $("#password").val().replace(/(^\s*)|(\s*$)/g, "");
		var captcha = $("#captcha").val().replace(/(^\s*)|(\s*$)/g, "");
		
		if(captcha == ""){
			alert("请输入验证码");
			$('#remind').text("请输入验证码");
			die();
		}
		if(user_id == "" && password == ""){
			alert("请输入用户名/密码");
			$('#remind').text("请输入用户名/密码");
			die();
		}
        $.ajax({
        	type:'post',
        	url:'to_check',
        	data:{user_id:user_id,password:password,captcha:captcha},
        	dataType:'json',
        	success: function(json){
        		if(json['code'] != 0){
        			alert(json['desc']);
        			$('#remind').text(json['desc']);
        		} else {
        			window.location.href="to_index";
        		}
        	}
        });
	}

	function focuss(){
		$('#remind').text('');
	}
</script>
