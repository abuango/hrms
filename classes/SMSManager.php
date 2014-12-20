<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SMSManager
 *
 * @author abuango
 */
class SMSManager {
    //put your code here
    
    function getRecp($acc_id){
        global $db;
        
        $contact = new ContactAddress($acc_id);
        
        return $contact->getPhones();
    }
    
    
    function sendmsg($recp, $msg){
	if(is_array($recp)){
		$contacts = implode(",",$recp);
	}else{
		$contacts = $recp;
	}
	/*echo "<br>---<br>Sending Message<br>Recipients: ".$contacts."<br>Message: ".$msg."<br>";
	$status[0] = 1;
			$status[1] = "1002";
			return $status;
	
	*/
	
	$data= array(
            "Type"=> "sendparam", 
            "Username" => "abuango",
            "Password" => "h4xx22live",
            "live" => "true",
            "numto" => $contacts,
            "data1" => $msg,
            //"default_senderid" => "2348069741803",
            "senderid" => "abuango",
            "return_credits" => true
         ) ; //This contains data that you will send to the server.
        
$data = http_build_query($data); //builds the post string ready for posting
$resp = do_post_request('http://www.mymobileapi.com/api5/http5.aspx', $data);
//echo  $data;

if( $resp[0] != 0){
	  //Sends the post, and returns the result from the server.
	  $res = $resp[1];
	  $r = strip_tags(substr($res, strpos($res,"<credits>"),strpos($res,"<credits>")));
	
	  		$status[0] = 1;
			$status[1] = "Credits Left: ". $r;
			return $status;
	 
}else{
			$status[0] = 0;
			$status[1] = $resp[1];
			return $status;
}


}



function do_post_request($url, $data, $optional_headers = null)
  {
     $params = array('http' => array(
                  'method' => 'POST',
                  'content' => $data
               ));
     if ($optional_headers !== null) {
        $params['http']['header'] = $optional_headers;
     }
     $ctx = stream_context_create($params);
	// echo $url;
     $fp = @fopen($url, 'rb', false, $ctx);
     if (!$fp) {
        $status[0] = 0;
				$status[1] = "There was a problem Receiving data with the Gateway.";
				return $status;
     }
     $response = @stream_get_contents($fp);
     if ($response === false) {
        $status[0] = 0;
				$status[1] = "There was a problem Receiving data with the Gateway.";
				return $status;
     }
	 $status[0] = 1;
	 $status[1] = $response;
     return $status;
     //formatXmlString($response);
     
  }
}
