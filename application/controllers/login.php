<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	function _construct(){
		$this->load->model('m_getUser');
	}
	
    /**
     * 将 教室与课程关系关联数据插入
     * @return [type] [description]
     */
    public function insertdata(){
    	$sql = "insert into s_room (room_id,name,time_11,time_12,time_13,time_14,time_15,time_16,time_21,time_22,time_23,time_24,time_25,time_26,time_31,time_32,time_33,time_34,time_35,time_36,time_41,time_42,time_43,time_44,time_45,time_46,time_51,time_52,time_53,time_54,time_55,time_56,max_num) values ";
    	for($i=1;$i<20;$i=$i+2){
    		if($i <10){
    			$room_id = "30".$i;
    		} else {
    			$room_id = "3".$i;
    		}
    		$name = "教三".$room_id;
    		$sql .=" ($room_id,'$name',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,30),";
    	}
    	$sql = substr($sql,0,-1);
    	$res = $this->db->query($sql);
    	var_dump($res);
    }



	/**
	 *  系统登录入口函数
	 * 
	 */
    public function to_page(){
    	$this->load->view('welcome');
    }

    /**
     * 登录验证函数
     * @return 返回判断结果
     */
    public function to_check(){
    	$user_id = @$_POST['user_id'];
    	$password = @$_POST['password'];
    	$captcha = @$_POST['captcha'];

    	if(strcasecmp($_SESSION['authcode'],$captcha)!=0){
    		print (json_encode(array('code'=>1,'desc'=>'验证码错误，请重新输入')));return;
    	}

    	$this->load->model('m_getUser');
    	$res = $this->m_getUser->check_login($user_id,$password);
        if($res == 0){
        	print (json_encode(array('code'=>2,'desc'=>'用户名或密码错误,请重新输入'))); return;  
        }

        $user_name = $this->m_getUser->getInfo($user_id,1);
        $_SESSION['user_name'] = $user_name[0]['username'];
        $_SESSION['user_id'] = $user_id; 

        $res = $this->m_getUser->updateLog($user_id); //记录最新的登录时间
        
        print (json_encode(array('code'=>0,'desc'=>'登录验证成功')));    	

    }


    /**
     * 登录成功函数
     * @return 返回系统主页面
     */
    public function to_index(){
    	// var_dump($_SESSION['username']);exit;
    	if(empty($_SESSION['user_id'])){
    		$this->to_page();
    	} else {
    		$this->load->view('index');
    	}
    	
    }


	public function logout(){
		$_SESSION['user_id'] = null;
		$this->to_page();
	}

    /**
     * 用户修改密码
     * @return 返回用户修改页面
     */
    public function changePass(){
    	$type = @$_POST['type'];
    	if($type == 1){
             $opassword = $_POST['opassword'];
             $npassword = $_POST['npassword'];
             $user_id = $_SESSION['user_id'];
             $this->load->model('m_getUser');
             $res = $this->m_getUser->check_login($user_id,$opassword);
             if($res == 0){
             	print json_encode(array('code'=>1,'desc'=>'当前密码输入错误'));
             	return 0;
             }
             $res = $this->m_getUser->changePass($user_id,$npassword);
             if($res){
             	print json_encode(array('code'=>0,'desc'=>'密码修改成功'));
             	return 0;
             }

    	} else {
    		$this->load->view('changePass');
    	}
    	
    }


	/**
	 * 验证码生成函数
	 * @return 验证码图片
	 */
	public function createImg(){
		//必须位于顶部
		$captch_code ="";
		//生成验证码底图
		$image  = imagecreatetruecolor(120,60);
		$bgcolor = imagecolorallocate($image,255,255,255);
		imagefill($image,0,0,$bgcolor);

		//生成验证码的数字
		   /* for($i=0;$i<4;$i++){
		       $fontsize = 6;
		       $fontcolor = imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
		       $fontcontent = rand(0,9);
		       $x = ($i*100/4)+rand(5,10);
		       $y = rand(5,10);
		       imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
		    }*/
	    for($i=0;$i<4;$i++){
	       $fontsize = 8;
	       $fontcolor = imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
	       $data = "abcdefghjkmnpqrst23456789ABCDEFGHJKLMNPQRSTUVWXYZ";
	       $fontcontent = substr($data,rand(0,strlen($data)),1);
	       $captch_code .= $fontcontent;
	       $x = ($i*100/4)+rand(5,10);
	       $y = rand(5,10);
	       imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
	    }
	    $_SESSION['authcode'] = $captch_code;

		//生成验证码的小点
	    for($i=0;$i<200;$i++){
	       $pointcolor = imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
	       imagesetpixel($image,rand(1,99),rand(1,29),$pointcolor);
	    }

		//生成验证码的干扰线
	    for($i=0;$i<3;$i++){
	      //随机生成
	      $linecolor = imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
	      
	      imageline($image,rand(1,99),rand(1,99),rand(1,99),rand(1,29),$linecolor);
	    }

	    header('content-type:image/png');
	    imagepng($image);
	}
}
