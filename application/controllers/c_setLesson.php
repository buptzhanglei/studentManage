<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_setLesson extends CI_Controller {

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



    /**
     * 改变上课时间获取上课地点
     * @return [type] [description]
     */
    public function changeTime(){
    	$time = @$_REQUEST['time'];
    	$id = @$_REQUEST['id']?$_REQUEST['id']:0;
    	$type = @$_REQUEST['type']?$_REQUEST['type']:2;
    	// $type = $_REQUEST['type'];
    	$this->load->model('m_admin');
    	$res = $this->m_admin->changeTime($time,$id,$type);
    	print json_encode(array('code'=>0,'data'=>$res));
    }


    /**
     * 管理员设置课程函数
     * @return [type] [description]
     */
	public function setLesson()
	{
		$content = @$_REQUEST['content']?$_REQUEST['content']:'';
		$user_id = $_SESSION['user_id'];
		$username = $_SESSION['user_name'];
		$this->load->model('m_admin');
		$data = $this->m_admin->getData($user_id,1,$content);
		if(empty($data)){
			$data = array('data'=>array(),'username'=>$username,'user_id'=>$user_id);
		} else {
			foreach($data as &$item){
				$class_time['week'] = floor($item['time']/10);
				$class_time['detail'] = $item['time']%10;
				$item['time'] = '周'.$class_time['week']."第".$class_time['detail'].'大节';
				if($item['status'] == 0){
					$item['status'] = '未设置';
				} else {
					$item['status'] = '已设置';
				}
			}
			$data = array('data'=>$data,'username'=>$username,'user_id'=>$user_id);
		}

		/*if($content){
			var_dump($data);exit;
		}*/
		$this->load->view('v_setLesson',$data);
	}

	/**
	 * 通过id获取指定课程信息
	 * @return [type] [description]
	 */
	public function getDataById(){
		$id = $_REQUEST['id'];
		$this->load->model('m_admin');
		$data = $this->m_admin->getData($id,2);
		$data = $data[0];
		$time = $data['time'];
		$res = $this->m_admin->changeTime($time,$id,1);
		//$class_id = $data['class_id'];
		$room_id = $this->m_admin->getRoomId($id,$time);
		print json_encode(array('code'=>0,'data'=>$data,'time'=>$res,'room_id'=>$room_id['room_id']));
	}


    /**
     * 保存 添加/修改 的课程信息
     * @return [type] [description]
     */
	public function saveInfo(){
		$data['user_id'] = $_REQUEST['user_id'];
		$data['name'] = $_REQUEST['name'];
		$data['course_grade'] = $_REQUEST['course_grade'];
		$data['time'] = $_REQUEST['time'];
		$data['assment'] = $_REQUEST['assment'];
		$data['class_id'] = $_REQUEST['class_id'];
		$data['status'] = $_REQUEST['status'];
		$data['classroom'] = $_REQUEST['classroom'];
		$type = $_REQUEST['type'];
		$this->load->model('m_admin');
		$data['id'] = $this->m_admin->getId($data['class_id']);
		$res = $this->m_admin->saveInfo($data,$type);
		if($res){
			print json_encode(array('code'=>0,'desc'=>'操作成功'));
		} else {
			print json_encode(array('code'=>1,'desc'=>'操作失败'));
		}
	}
}
