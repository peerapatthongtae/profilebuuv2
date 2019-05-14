<?php
class m_api extends CI_Model
{
        public function get_token(){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_USERPWD,"buu_profile:profile_999");
            curl_setopt($ch, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_URL, 'http://autolab.informatics.buu.ac.th:8005/api/token');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 5);
            $result = curl_exec($ch);
            curl_close($ch);
            $api = json_decode($result,true);
            $token = $api['result']['token'];
            return $token;
            
        }
        
        
        


}
?>