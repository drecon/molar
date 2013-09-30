<?php namespace Drecon\Molar;
 
class Molar {
 
  public static function plans(){
		$url = 'https://sandbox.moip.com.br/assinaturas/v1/plans';
		//set credentials and headers
		$credentials = \Config::get('molar.productionToken') . ':' . \Config::get('molar.productionKey');
		$header[] = "Accept: application/json";
		$header[] = "Content-Type: application/json";
        $header[] = "Authorization: Basic " . base64_encode($credentials);
        //inicit curl
        $ch = curl_init();
        //set options
        $options = array(
        	CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD => $credentials,
            CURLINFO_HEADER_OUT => true
        );

        curl_setopt_array($ch, $options);
        //execute curl
        $response = curl_exec($ch);
        //close curl
        curl_close($ch);
        //return json with a list of plans;
        return $response;
	}
 
}