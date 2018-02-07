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
			<div class="ctab-title clearfix"><h3>课程预设置</h3>
			</div>
			
			<div class="ctab-Main">
				<div class="ctab-Main-title">
					<ul class="clearfix">
						<li class="cur"><a href="setLesson">详细信息</a></li>
					</ul>
				</div>
				
				<div class="ctab-Mian-cont">
					<div class="Mian-cont-btn clearfix">
						<div class="operateBtn">
							<a href="javascript:;" class="greenbtn add" onclick="addCourse()">添加课程</a>
							<a href="javascript:;" class="greenbtn publish" onclick="alert('功能待开发中。。。')">一键设置</a>
						</div>
						<div class="searchBar">
							<input type="text" id="searchContent" value="" class="form-control srhTxt" placeholder="输入课程名搜索">
							<input type="button" class="srhBtn" value="" onclick="searchBar()">
						</div>
					</div>
					<div class="Mian-cont-wrap">
						<div class="defaultTab-T">
							<table border="0" cellspacing="0" cellpadding="0" class="defaultTable">
								<tbody>
									<tr>
										<th class="t_1">序号ID</th>
										<th class="t_1">课程号</th>
										<th class="t_1">课程名称</th>
										<th class="t_1">授课老师</th>
										<th class="t_1">考核方式</th>
										<th class="t_1">课程年级</th>
										<th class="t_1">上课时间</th>
									    <th class="t_1">课程状态</th>
										<th class="t_1">操作</th>
									</tr>
							    </tbody>
						    </table>
						</div>
						<table border="0" cellspacing="0" cellpadding="0" class="defaultTable defaultTable2">
							<tbody>
								<?php if(!empty($data)):?>
								<?php foreach($data as $item):?>
								<tr>
									<td class="t_1"><input type="checkbox">&nbsp;&nbsp;<?php echo $item['id']?></td>
									<td class="t_1"><?php echo $item['class_id']?></td>
									<td class="t_1"><?php echo $item['name']?></td>
									<td class="t_1"><?php echo $item['username']?></td>
									<td class="t_1"><?php echo $item['assment']==1?'开卷考试':($item['assment']==2?'闭卷考试':'提交论文')?></td>
									<td class="t_1"><?php echo $item['course_grade']==1?'研一':($item['course_grade']==2?"研二":"研三")?></td>
									<td class="t_1"><?php echo $item['time']?></td>
									<?php if($item['status'] == '已设置'):?>
									<td class="t_1 btn"><a class="Top"><?php echo $item['status']?></a></td>
								    <?php else:?>
								    <td class="t_1"><?php echo $item['status']?></td>
								    <?php endif;?>
									<td class="t_1">
										<div class="btn" id="modify">
											<a href="#" class="modify" onclick="modify('<?php echo $item["id"];?>')">修改</a>
										</div>
									</td>
							    </tr>
							    <input type="hidden" value="<?php echo count($data)?>" id="maxId">
							    <?php endforeach;?>
							    <?php endif;?>
							    <input type="hidden" value="<?php echo $username?>" id="hiddenUserName">
							    <input type="hidden" value="<?php echo $user_id?>" id="hiddenUserId">
							    <input type="hidden" value="1" id="modifyType">
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
							<th class="t_1">课程号</th>
							<th class="t_1"><input type="text" value="" style="width:130px" disabled="true" id="class_id" /></th>
							<th class="t_1">授课老师</th>
							<th class="t_1"><input id="username" disabled="true" type="text" value="" style="width:130px"/></th>
						</tr>
						<tr>
							<th class="t_1">课程名称</th>
							<th class="t_1"><input type="text" value="" style="width:130px" id="name"/></th>
							<th class="t_1">考核方式</th>
							<th class="t_1">
								<select id="assment" name="assment" style="width:140px;height:40px">
								    <option value="0">请选择</option> 
									<option value="1">开卷考试</option> 
									<option value="2">闭卷考试</option> 
									<option value="3">提交论文</option>
								</select> 
							</th>
						</tr>
						<tr>
							<th class="t_1">课程年级</th>
							<th class="t_1">
								<select id="course_grade" name="course_grade" style="width:140px;height:40px">
								    <option value="0">请选择</option> 
									<option value="1">研究生一年级</option> 
									<option value="2">研究生二年级</option> 
									<option value="3">研究生三年级</option>
								</select> 
								<!-- <input type="text" id="course_grade" value="" style="width:130px" /> -->
							</th>
							<th class="t_1">上课时间</th>
							<th class="t_1">
								<select id="time" name="time" style="width:140px;height:40px" onchange="changeTime()">
								    <option value="0">请选择</option> 
									<option value="11">周一第一大节</option> 
									<option value="12">周一第二大节</option> 
									<option value="13">周一第三大节</option>
									<option value="14">周一第四大节</option> 
									<option value="15">周一第五大节</option> 
									<option value="16">周一第六大节</option>
									<option value="21">周二第一大节</option> 
									<option value="22">周二第二大节</option> 
									<option value="23">周二第三大节</option>
									<option value="24">周二第四大节</option> 
									<option value="25">周二第五大节</option> 
									<option value="26">周二第六大节</option>
									<option value="31">周三第一大节</option> 
									<option value="32">周三第二大节</option> 
									<option value="33">周三第三大节</option>
									<option value="34">周三第四大节</option> 
									<option value="35">周三第五大节</option> 
									<option value="36">周三第六大节</option>
									<option value="41">周四第一大节</option> 
									<option value="42">周四第二大节</option> 
									<option value="43">周四第三大节</option>
									<option value="44">周四第四大节</option> 
									<option value="45">周四第五大节</option> 
									<option value="46">周四第六大节</option>
									<option value="51">周五第一大节</option> 
									<option value="52">周五第二大节</option> 
									<option value="53">周五第三大节</option>
									<option value="54">周五第四大节</option> 
									<option value="55">周五第五大节</option> 
									<option value="56">周五第六大节</option>
								</select> 
							</th>
						</tr>
						<tr>
							<th>课程状态</th>
							<th>
								<label id="status">
									<input type="radio" name="status" value="0" id="status_0">未设置
								    <input type="radio" name="status" value="1" id="status_1">已设置
								</label>
							</th>
							<th>上课教室</th>
							<th id="classroom"><select style='width:140px;height:40px'><option>请选择</option></select></th>
							<input type="hidden" id="hiddenId" value=""/>
						</tr>
				    </tbody>
			    </table>
			</div>
			<div class="aFlBtn" align="center" style="margin-left: 0px"><input type="button" value="保存" class="saveBtn" id="saveInfo"></div>
		</div>
	</div>
</body></html>
<script>
	//LabelAdd();
	
    function changeTime(){
    	var time = $("#time").val();
    	var id = $("#hiddenId").val();
    	$.ajax({
        	type:'post',
        	url:'changeTime',
        	data:{time:time,type:1,id:id},
        	dataType:'json',
        	success: function(json){
        		if(json['code'] != 0){
        			alert(json['desc']);
        			$('#remind').text(json['desc']);
        		} else {
        			makeSelect(json['data'],0);
        		}
        	}
        });
    }


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

    function searchBar(){
    	var content = $("#searchContent").val().replace(/(^\s*)|(\s*$)/g, "");
    	if(content == ''){
    		alert("搜索内容不能为空");die();
    	}
    	window.location = "setLesson?content="+content;
    }

    function addCourse(){
    	var max = $("#maxId").val();
    	var user_id = $("#hiddenUserId").val();
    	if(max == undefined){
    		max = 0;
    	}
    	max = parseInt(max) +1;
    	max = max > 10? user_id+max:user_id+"0"+max;
    	var username = $('#hiddenUserName').val();
    	$("#modifyType").val(1);
    	$("#class_id").val(max);
        $("#username").val(username);
        $("#name").val('');
        $("#assment").val(0);
        $("#course_grade").val(0);
        $("#time").val(0);
        $("#status_0").prop('checked',true);

        $.ajax({
        	type:'post',
        	url:'changeTime',
        	data:{type:2},
        	dataType:'json',
        	success:function(json){
        		makeSelect(json['data'],0);
        	}
        });
        
        openWindow();
    }

	function modify($id){
		$("#modifyType").val(2); //更改类型为 2 表示更新数据库
		$.ajax({
        	type:'post',
        	url:'getDataById',
        	data:{id:$id},
        	dataType:'json',
        	success: function(json){
        		if(json['code'] != 0){
        			alert(json['desc']);
        			$('#remind').text(json['desc']);
        		} else {
        			$("#class_id").val(json['data']['class_id']);
        			$("#username").val(json['data']['username']);
        			$("#name").val(json['data']['name']);
        			$("#assment").val(json['data']['assment']);
        			$("#course_grade").val(json['data']['course_grade']);
        			$("#time").val(json['data']['time']);
        			if(json['data']['status'] == 0){
						$("#status_0").prop('checked',true);
						$("#status_1").removeAttr('checked');
        			} else {
        				$("#status_1").prop('checked',true);
        				$("#status_0").removeAttr('checked');		
        			}
        			
        			$("#hiddenId").val($id);
                    var room_id = json['room_id'];
                    makeSelect(json['time'],room_id);
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

	$("#saveInfo").click(function(){

		var name = $("#name").val().replace(/(^\s*)|(\s*$)/g, "");
		var assment = $("#assment").val();
		var course_grade = $("#course_grade").val().replace(/(^\s*)|(\s*$)/g, "");
		var time = $("#time").val().replace(/(^\s*)|(\s*$)/g, "");
        var type = $("#modifyType").val();
        var class_id = $("#class_id").val();
        var username = $("#username").val();
        var status = $('input:radio[name="status"]:checked').val();
        var classroom = $("#classroom option:selected").val();
        
		if(name=='' || assment=='' || course_grade=='' || time=='' || classroom == 0){
			alert("内容不能为空");die();
		}

		$.ajax({
        	type:'post',
        	url:'saveInfo',
        	data:{user_id:$('#hiddenUserId').val(),name:name,assment:assment,course_grade:course_grade,time:time,type:type,class_id:class_id,username:username,status:status,classroom:classroom},
        	dataType:'json',
        	success: function(json){
        		if(json['code'] != 0){
        			alert(json['desc']);
        		} else {
        			alert(json['desc']);
        			window.location = "setLesson";
        		}
        	}
        });
	});

</script>
