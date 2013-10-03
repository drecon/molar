<?php

class MolarController extends BaseController {

	public function signPlan()
	{
		$url = 'https://sandbox.moip.com.br/assinaturas/v1/subscriptions?new_customer=true';
		//set credentials and headers
		$credentials = \Config::get('molar.productionToken') . ':' . \Config::get('molar.productionKey');
		$header[] = "Accept: application/json";
		$header[] = "Content-Type: application/json";
        $header[] = "Authorization: Basic " . base64_encode($credentials);
        //set post data
        $data = array(
        	"code" => Input::get('sign_code'),
		    "plan" => array(
		        "code" => Input::get('plan_code')
		    ),
			"customer" => array(
				"code" => Input::get('customer_code'),
				"email" => Input::get('email'),
				"fullname" => Input::get('fullname'),
				"cpf" => Input::get('cpf'),
				"phone_number" => Input::get('phone_number'),
				"phone_area_code" => Input::get('phone_area_code'),
				"birthdate_day" => Input::get('birthdate_day'),
				"birthdate_month" => Input::get('birthdate_month'),
				"birthdate_year" => Input::get('birthdate_year'),
				"address" => array(
					"street" => Input::get('street'),
					"number" => Input::get('number'),
					"complement" => Input::get('complement'),
					"district" => Input::get('district'),
					"city" => Input::get('city'),
					"state" => Input::get('state'),
					"country" => Input::get('country'),
					"zipcode" => Input::get('zipcode')
				),
				"billing_info" => array(
           			"credit_card" => array(
						"holder_name" => Input::get('holder_name'),
						"number" => Input::get('credicard_number'),
						"expiration_month" => Input::get('expiration_month'),
						"expiration_year" => Input::get('expiration_year')
					)
				)
			)
		);
		//init curl
        $ch = curl_init();
        //set options
        $options = array(
        	CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD => $credentials,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data)
        );

        curl_setopt_array($ch, $options);
        //execute curl
        $response = curl_exec($ch);
        //close curl
        curl_close($ch);
        //return json with result;
        return View::make('molar.main')->with('moip_return',$response);
	}

}