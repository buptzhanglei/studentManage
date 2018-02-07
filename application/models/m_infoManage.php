<?php

class m_infoManage extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        parent::__construct();
        header('Content-Type: text/html; charset=UTF8');
        //$this->db = $this->load->database('default');
        /*$this->load->model('m_auth');
        $this->m_auth->check_login();*/
    }
    

   /**
     * 获取教师信息
     * $type = 1 表示获取所有教师信息   2表示获取指定教师信息 3 表示计算总数
     * @return [type] [description]
     */
    public function getTeacherInfo($type,$id=0,$content=''){
        if($type == 1){
            $sql = "select * from s_basic where user_type = 1";
        } else if($type ==2){
            $sql = "select * from s_basic where user_type = 1 and id = $id";
        } else {
            $sql = "select count(*) num from s_basic where user_type = 1";
        }

        if($content != ''){
            $sql = "select * from s_basic where user_type = 1 and username like '%$content%'";
        }

        $res = $this->db->query($sql)->result_array();
        return $res;
    }


   /**
    * 保存学生信息
    * @param  [type] $data [description]
    * @return [type]       [description]
    */
   public function saveStudentInfo($data){
        $type = $data['type'];
        $id = $data['id'];
        $user_id = $data['user_id'];
        $username = $data['username'];
        $class = $data['class'];
        $age = $data['age'];
        $sex = $data['sex'];
        $email = $data['email'];
        $tel = $data['tel'];
        $address = $data['address'];
        
        if($type == 1){
            $sql = "insert into s_basic (user_id,username,class,age,sex,email,tel,address,user_type) value ('$user_id','$username','$class',$age,$sex,'$email','$tel','$address',0)";
        } else if($type ==2){
            $sql = "update s_basic set user_id = '$user_id',username = '$username',class='$class',age=$age,sex=$sex,email='$email',tel='$tel',address='$address' where id=$id";
        } else if($type == 3){
            $sql = "insert into s_basic (user_id,username,class,age,sex,email,tel,address,user_type) value ('$user_id','$username','$class',$age,$sex,'$email','$tel','$address',1)";
        }
        
        $res = $this->db->query($sql);
        return $res;
   }



    /**
     * 获取学生信息
     * $type = 1 表示获取所有学生信息   2表示获取指定学生信息 3 表示计算总数
     * @return [type] [description]
     */
    public function getStudentInfo($type,$id=0,$content=''){
        if($type == 1){
            $sql = "select * from s_basic where user_type = 0";
        } else if($type ==2){
            $sql = "select * from s_basic where user_type = 0 and id = $id";
        } else {
            $sql = "select count(*) num from s_basic where user_type = 0";
        }

        if($content != ''){
            $sql = "select * from s_basic where user_type = 0 and username like '%$content%'";
        }

        $res = $this->db->query($sql)->result_array();
        return $res;
    }
}
