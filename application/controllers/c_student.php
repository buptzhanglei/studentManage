<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_student extends CI_Controller {

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

    
    public function deleteLesson(){
    	$id = @$_REQUEST['id'];
    	$user_id = $_SESSION['user_id'];
    	$this->load->model('m_student');
    	$res = $this->m_student->deleteLesson($id,$user_id);
    	if($res){
    		print json_encode(array('code'=>0,'desc'=>'退课成功'));
    	} else {
    		print json_encode(array('code'=>1,'desc'=>'退课失败'));
    	}
    }


    /**
     * 学生选课函数
     * @return [type] [description]
     */
    public function lessonChoose(){
    	$id = @$_REQUEST['id'];
    	$user_id = $_SESSION['user_id'];
    	$this->load->model('m_student');
    	$res = $this->m_student->chooseLesson($id,$user_id);
    	if($res){
    		print json_encode(array('code'=>0,'desc'=>'选课成功'));
    	} else {
    		print json_encode(array('code'=>1,'desc'=>'选课失败'));
    	}
    }


    /**
     * 学生选课函数
     * @return [type] [description]
     */
	public function chooseLesson()
	{
        $content = @$_REQUEST['content']?$_REQUEST['content']:'';
		$user_id = $_SESSION['user_id'];
		$username = $_SESSION['user_name'];	
		$this->load->model('m_student');
		$data = $this->m_student->getData($user_id,1,$content);
		$res_data = $this->m_student->getClass($user_id);//获取已选课程信息

		if(empty($data)){
			$data = array('data'=>array(),'username'=>$username,'user_id'=>$user_id);
		} else {
			foreach($data as &$item){
				$class_time['week'] = floor($item['time']/10);
				$class_time['detail'] = $item['time']%10;
				$item['time'] = '周'.$class_time['week']."第".$class_time['detail'].'大节';
				// if($item['status'] == 0){
				// 	$item['status'] = '未设置';
				// } else {
				// 	$item['status'] = '已设置';
				// }
				
				if(in_array($item['id'],$res_data)){
					$item['if_choose'] = 1;
				} else {
					$item['if_choose'] = 0;
				}
			}
			$data = array('data'=>$data,'username'=>$username,'user_id'=>$user_id);
		}
		$this->load->view('v_student',$data);
	}

	/**
	 * 通过id获取指定课程信息
	 * @return [type] [description]
	 */
	public function getDataById(){
		$id = $_REQUEST['id'];
		$this->load->model('m_student');
		$data = $this->m_student->getData($id,2);
		$data = $data[0];
		$time = $data['time'];
		$res = $this->m_student->changeTime($time,$id,1);
		//$class_id = $data['class_id'];
		$room_id = $this->m_student->getRoomId($id,$time);
		print json_encode(array('code'=>0,'data'=>$data,'time'=>$res,'room_id'=>$room_id['room_id']));
	}
}
