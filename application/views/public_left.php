<!DOCTYPE html>
<html class=" js csstransforms3d"><head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>公共侧边栏</title>
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

<body>
	<!--side S-->
	<div class="super-side-menu">
		<div class="logo"><a href="to_left"><img src="../../images/logo.png"></a></div>
		
		<div class="side-menu">
			<ul>
				<li class="on"><a href="to_body" target="Mainindex"><i class="ico-1"></i>个人信息</a></li>
				<li><a href="../c_student/chooseLesson" target="Mainindex"><i class="ico-2"></i>学生选课</a></li>
				<li class=""><a href="../c_teacher/setLesson" target="Mainindex"><i class="ico-3"></i>预选课程</a></li>
				<li class=""><a href="../c_setLesson/setLesson" target="Mainindex"><i class="ico-3"></i>课程设定</a></li>
				<li><a href="../c_infoManage/manage" target="Mainindex"><i class="ico-4"></i>信息管理</a></li>
				<!-- <li><a href="xitong_set.html" target="Mainindex"><i class="ico-7"></i>系统设置</a></li> -->
			</ul>
		</div>
	</div>
	<!--side E-->

<script type="text/javascript">
	$(function(){
		$('.side-menu li').click(function(){
			$(this).addClass('on').siblings().removeClass('on');
		})
	})
</script>

</body></html>