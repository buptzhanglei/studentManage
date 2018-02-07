<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

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


	public function to_left()
	{
		$this->load->view('public_left');
	}


    public function to_header()
	{
		$data['user'] = $_SESSION['user_name'];
		$this->load->view('public_header',$data);
	}

    public function to_body()
	{
		//获取登录用户的个人信息
    	$this->load->model('m_getUser');
    	$res = $this->m_getUser->getInfo($_SESSION['user_id'],2);
    	$data = $res[0];
    	if($data['sex'] == 0){
    		$data['sex'] = '男';
    	} else {
    		$data['sex'] = '女';
    	}
		$this->load->view('public_body',$data);
	}

    /**
     * 个人修改用户信息
     * @return 是否修改成功
     */
    public function saveModify(){
    	$data['username'] = $_REQUEST['username'];
    	$data['age'] = $_REQUEST['age'];
    	$data['sex'] = $_REQUEST['sex'];
    	$data['email'] = $_REQUEST['email'];
    	$data['tel'] = $_REQUEST['tel'];
    	$data['class'] = $_REQUEST['class'];
    	$data['user_id'] = $_REQUEST['user_id'];
    	$this->load->model('m_getUser');
    	$res = $this->m_getUser->saveModify($data);
    	if($res){
    		print json_encode(array('code'=>0,'desc'=>'修改成功'));
    	} else {
    		print json_encode(array('code'=>1,'desc'=>'修改失败'));
    	}
    }

    /**
     * 修改用户密码
     * @return 返回修改成功与否
     */
	public function change_password(){
       return 0;
	}
}
