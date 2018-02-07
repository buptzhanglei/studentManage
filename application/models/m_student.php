<?php

class m_student extends CI_Model {

    function __construct()
    {
        parent::__construct();
        header('Content-Type: text/html; charset=UTF8');
        //$this->db = $this->load->database('default');
        /*$this->load->model('m_auth');
        $this->m_auth->check_login();*/
    }


   public function deleteLesson($id,$user_id){
        $date = date("Y-m-d H:i:s");
        $sql = "update s_class_student set status = 0 where class_id = '$id' and student_id = '$user_id'";
        $res = $this->db->query($sql);
        return $res;
   }


    public function getClass($user_id){
        $sql = "select class_id from s_class_student where status = 1 and student_id = '$user_id'";
        $res = $this->db->query($sql)->result_array();
        foreach ($res as $key => $value) {
            $array[] = $value['class_id'];
        }
        return $array;
    }
    


    public function chooseLesson($id,$user_id){
        $date = date("Y-m-d H:i:s");
        $sql = "insert into s_class_student (student_id,class_id,reg_time,status) values ('$user_id','$id','$date',1)";
        $res = $this->db->query($sql);
        return $res;
    }


    public function getId($data){
        $sql = "select id from s_class where class_id = '$data'";
        $res = $this->db->query($sql)->row_array();
        return $res['id'];
    }

    /**
     * 通过上课时间匹配到上课教室
     * @param  [type] $id   [description]
     * @param  [type] $time [description]
     * @return [type]       [description]
     */
    public function getRoomId($id,$time){
        $date = "time_".$time;
        $sql = "select room_id from s_room where $date=$id";
        $res = $this->db->query($sql)->row_array();
        return $res;
    }


    /**
     * 修改上课时间  获取课选择的上课教室信息
     * @param  $time 上课时间
     * @param  $id   $time 已经设置过的课程id 目的是找到当前课程room_id
     * @param  $type  $type=1 表示获取空余的教室  2 表示获取所有的教室（包括非空余）
     * @return array  表示可选教室的数组
     */
    public function changeTime($time,$id=0,$type=0){
        $date = 'time_'.$time;
        if($type == 1){
            $sql = "select room_id from s_room where $date = 0 or $date = $id";
        } else if($type == 2){
            $sql = "select room_id from s_room where 1=1";
        }
        
        $res = $this->db->query($sql)->result_array();
        return $res;
    }


    /**
     * 保存修改信息
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function saveInfo($data,$type){
        $class_id = @$data['class_id'];
        $name = @$data['name'];
        $user_id = @$data['user_id'];
        $time = @$data['time'];
        $course_grade = @$data['course_grade'];
        $assment = @$data['assment'];
        $status = @$data['status'];
        $classroom = @$data['classroom'];
        $id = @$data['id'];
        if($type == 1){
            $date = date("Y-m-d H:i:s");
            $sql = "insert into s_class (class_id,name,teacher_id,reg_time,time,assment,course_grade,status)value ('$class_id','$name','$user_id','$date','$time','$assment','$course_grade',$status)";
        } else {
            $sql = "update s_class set name='$name',time='$time',assment='$assment',course_grade='$course_grade',status=$status where class_id = '$class_id'";
        }
        $res = $this->db->query($sql);
        $date2 = "time_".$time; 
        if(empty($id)){
            $id = $res;
        }
        $sql3 = "update s_room set $date2=0 where $date2=$id";
        $res3 = $this->db->query($sql3);
        $sql2 = "update s_room set $date2=$id where room_id=$classroom";
        $res2 = $this->db->query($sql2);
        if($res && $res2){
            return true;
        } else {
            return false;
        }
    }


    /**
     * 获取课程信息
     * @return [type] [description]
     */
    public function getData($user_id,$type,$searchContent=''){
        if($type == 1){ //根据 user_id 获取课程信息
            $sql = "select a.*,b.username from s_class a,s_basic b where a.teacher_id = b.user_id and a.status = 1 order by a.id asc";
        } else {  // 根据 id 获取指定的课程信息
            $sql = "select a.*,b.username from s_class a,s_basic b where a.teacher_id = b.user_id and a.id = '$user_id' and a.status = 1";
        }

        if($searchContent != ''){ // 根据 待查询内容，获取课程信息
            $sql = "select a.*,b.username from s_class a,s_basic b where a.teacher_id = b.user_id and a.status = 1 and name like '%$searchContent%' order by a.id asc";
        }
        
        $res = $this->db->query($sql)->result_array();
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
