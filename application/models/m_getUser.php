<?php

class m_getUser extends CI_Model {

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
     * 验证用户是否存在
     * @param  [type] $username [description]
     * @param  [type] $password [description]
     * @return 用户存在个数  0  或  1
     */
    public function check_login($user_id,$password){
        $sql = "select count(*) count from s_user where user_id = '$user_id' and password = '$password'";
        $res = $this->db->query($sql)->result_array();
        return $res[0]['count'];//返回个数
    }

    /**
     * 根据用户名修改密码
     * @param  [type] $username  [description]
     * @param  [type] $npassword [description]
     * @return 返回值为true  or  false
     */
    public function changePass($user_id,$npassword){
        $sql = "update s_user set password='$npassword' where user_id='$user_id'";
        $res = $this->db->query($sql);
        return $res;
    }

    /**
     * 根据用户user_id 查询用户信息
     * @param  type=1 表示查询用户名  2 表示查询用户所有信息
     * @return array()
     */
    public function getInfo($user_id,$type){
        if($type == 1){
            $sql = "select username from s_user where user_id ='$user_id'";
        } else {
            $sql = "select * from s_basic where user_id = '$user_id'";
        }
        $res = $this->db->query($sql)->result_array();
        return $res;
    }

    /**
     * 修改个人信息操作
     * @return [type] [description]
     */
    public function saveModify($data){
        $username = $data['username'];
        $age = $data['age'];
        $sex = $data['sex']=='男'?0:1;
        $email = $data['email'];
        $tel = $data['tel'];
        $class = $data['class'];
        $user_id = $data['user_id'];
        $sql = "update s_basic set username='$username',age='$age',sex='$sex',email='$email',tel='$tel',class='$class' where user_id = '$user_id'";
        $res = $this->db->query($sql);
        $sql = "update s_user set username='$username' where user_id='$user_id'";
        $res2 = $this->db->query($sql);
        if($res && $res2){
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }

 
    /**
     * 更新登录信息
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function updateLog($user_id){
        $time = date("Y-m-d H:i:s");
        $sql = "update s_user set login_time='$time' where user_id ='$user_id'";
        $res = $this->db->query($sql);
        return $res;
    }




    public function index(){
    }
    
    public function write_log($url, $text){
        $date = date('Y-m-d');
        $ltime = date('Y-m-d H:i:s');

        $handle = fopen('../logs/'.$date.'.log', 'a');
        fwrite($handle, "$ltime\t$url\t$text\n");
        fclose($handle);
    }
    
    private function get($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $text = curl_exec($ch);
        curl_close($ch);
        return $text;
    }
    
    private function post($url, $data){
        $postdata = http_build_query($data);
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        if($postdata != ''){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HEADER, false);
        $text = curl_exec($ch);
        curl_close($ch);
        return $text;
    }
    
    private function get_sign($string){
        $key = '1f0bTff26e1f75e';
        #print $string;
        $signature = substr(hash_hmac('sha256', $string, $key), 0, 32);
        return $signature;
    }
    
    public function getpricebyuid($uid){
        $channel = 'sinaweb';
        $timestamp = time() - 60;
        $sign = $this->get_sign($channel.$timestamp);
        
        $url = "http://i.promote.vip.weibo.com/openapi/getpricebyuid?uid=$uid&channel=$channel&signature=$sign&timestamp=$timestamp";
        print $url;
        $text = $this->get($url);
        
        $this->write_log($url, $text);
        
        $json = json_decode($text, true);
        return $json;
    }
    
    public function getpricebymid($uid, $mid){
        $channel = 'sinaweb';
        $timestamp = time() - 60;
        //$timestamp = time();
        $sign = $this->get_sign($channel.$timestamp);
        
        $url = "http://i.promote.vip.weibo.com/openapi/getpricebymid?uid=$uid&mid=$mid&nonfans=1&isadvance=0&channel=$channel&signature=$sign&timestamp=$timestamp";
        #print $url;
        $text = $this->get($url);
        
        $this->write_log($url, $text);
        
        $json = json_decode($text, true);
        return $json;
    }
    
    public function getpromotedata($adid, $mid){
        $channel = 'sinaweb';
        /*$timestamp = time() - 60;*/
        $timestamp = time();
        $sign = $this->get_sign($channel.$timestamp);
        
        $url = "http://i.promote.vip.weibo.com/openapi/getpromotedata?adid=$adid&mid=$mid&channel=$channel&signature=$sign&timestamp=$timestamp";
        #print $url;
        $text = $this->get($url);
        
        $this->write_log($url, $text);
        
        $json = json_decode($text, true);
        return $json;
    }
    
    public function setpromote($uid, $mid, $nonfans){
        $channel = 'sinaweb';
        $timestamp = time() - 60;
        $sign = $this->get_sign($channel.$timestamp);
        
        $data = array(
            'uid'=>$uid,
            'mid'=>$mid,
            'nonfans'=>$nonfans,
            'channel'=>$channel,
            'signature'=>$sign,
            'timestamp'=>$timestamp
        );
        $url = "http://i.promote.vip.weibo.com/openapi/setpromote";
        #print $url;
        $text = $this->post($url, $data);
        
        $this->write_log($url, $text);
        
        $json = json_decode($text, true);
        return $json;
    }
    
    public function setoffline($uid, $mid){
        $channel = 'sinaweb';
        $timestamp = time() - 60;
        $sign = $this->get_sign($channel.$timestamp);
        
        $data = array(
            'uid'=>$uid,
            'mid'=>$mid,
            'channel'=>$channel,
            'signature'=>$sign,
            'timestamp'=>$timestamp
        );
        $url = "http://i.promote.vip.weibo.com/openapi/setoffline";
        #print $url;
        $ch = curl_init();
        $text = $this->post($url, $data);
        
        $this->write_log($url, $text);
        
        $json = json_decode($text, true);
        return $json;
    }
}
