<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_infoManage extends CI_Controller {

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
     * 信息管理主页面
     * @return [type] [description]
     */
    public function manage(){
    	$content = @$_REQUEST['content']?$_REQUEST['content']:"";

    	$this->load->model('m_infoManage');
    	$res = $this->m_infoManage->getStudentInfo(1,0,$content);
    	$data['res'] = $res;
    	$num = $this->m_infoManage->getStudentInfo(3);
    	$data['page']['num'] = $num[0]['num'];
    	$data['page']['pageNum'] = ceil($num[0]['num']/5);
    	$data['page']['currentPage'] = 1;

        //引入使用page类
    	$this->load->library('pagination');
    	$config['base_url'] = 'http://test.sina.com.cn/zl/index.php/c_infoManage/manage/';
		$config['total_rows'] = $num[0]['num'];
		$config['per_page'] = 1;
        $this->pagination->initialize($config);
        $data['page']['pageInfo'] = $this->pagination->create_links();

    	$this->load->view("v_studentInfoManage",$data);
    }

    /**
     * 教师信息管理
     * @return [type] [description]
     */
    public function teacherManage(){
    	$content = @$_REQUEST['content']?$_REQUEST['content']:"";

    	$this->load->model('m_infoManage');
    	$res = $this->m_infoManage->getTeacherInfo(1,0,$content);
    	$data['res'] = $res;
    	$num = $this->m_infoManage->getTeacherInfo(3);
    	$data['page']['num'] = $num[0]['num'];
    	$data['page']['pageNum'] = ceil($num[0]['num']/5);
    	$data['page']['currentPage'] = 1;

        //引入使用page类
    	$this->load->library('pagination');
    	$config['base_url'] = 'http://test.sina.com.cn/zl/index.php/c_infoManage/manage/';
		$config['total_rows'] = $num[0]['num'];
		$config['per_page'] = 1;
        $this->pagination->initialize($config);
        $data['page']['pageInfo'] = $this->pagination->create_links();
    	$this->load->view("v_teacherInfoManage",$data);
    }

    /**
     * 修改信息 异步 返回
     * @return [type] [description]
     */
    public function modify(){
    	$id = $_REQUEST['id'];
    	$userType = $_REQUEST['userType'];
    	$this->load->model('m_infoManage');
    	if($userType == 1){
    		$res = $this->m_infoManage->getTeacherInfo(2,$id);
    	} else {
    		$res = $this->m_infoManage->getStudentInfo(2,$id);
    	}   	
    	$data = $res[0];
    	print json_encode(array('code'=>0,'data'=>$data));
    }


    public function saveInfo(){
    	$data['id'] = @$_REQUEST['id'];
    	$data['user_id'] = @$_REQUEST['user_id'];
    	$data['username'] = @$_REQUEST['username'];
    	$data['class'] = @$_REQUEST['class'];
    	$data['age'] = @$_REQUEST['age'];
    	$data['sex'] = @$_REQUEST['sex'];
    	$data['email'] = @$_REQUEST['email'];
    	$data['tel'] = @$_REQUEST['tel'];
    	$data['address'] = @$_REQUEST['address'];
        $data['type'] = @$_REQUEST['type'];

        $this->load->model('m_infoManage');
    	$res = $this->m_infoManage->saveStudentInfo($data);
    	if($res){
    		print json_encode(array('code'=>0,'desc'=>'操作成功'));
    	} else {
    		print json_encode(array('code'=>1,'desc'=>'操作失败'));
    	}
    }
}
