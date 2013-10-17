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
        return View::make('molar.main_plans')->with('moip_return_plans',$response);
	}

	public function plans(){
		$url = 'https://sandbox.moip.com.br/assinaturas/v1/plans';
		//set credentials and headers
		$credentials = \Config::get('molar.productionToken') . ':' . \Config::get('molar.productionKey');
		$header[] = "Accept: application/json";
		$header[] = "Content-Type: application/json";
        $header[] = "Authorization: Basic " . base64_encode($credentials);
        //init curl
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

	public function checkout()
	{
        $url = 'https://desenvolvedor.moip.com.br/sandbox/ws/alpha/EnviarInstrucao/Unica';
		//set credentials and headers
		$credentials = \Config::get('molar.token') . ':' . \Config::get('molar.key');
		$header[] = "Accept: text/xml";
		$header[] = "Content-Type: text/xml";
        $header[] = "Authorization: Basic " . base64_encode($credentials);
        //set post data
        $data = "
        	<EnviarInstrucao>
			    <InstrucaoUnica TipoValidacao='Transparente'>
			        <Razao>".  Input::get('reason') ."</Razao>
			        <Valores>
			            <Valor moeda='BRL'>". Input::get('price') ."</Valor>
			        </Valores>
			        <IdProprio>". Input::get('id') ."</IdProprio>
			        <Pagador>
			           <Nome>". Input::get('fullname') ."</Nome>
			           <Email>". Input::get('email') ."</Email>
			           <IdPagador>". Input::get('id') ."</IdPagador>
			           <EnderecoCobranca>
			               <Logradouro>". Input::get('street') ."</Logradouro>
			               <Numero>". Input::get('number') ."</Numero>
			               <Complemento>". Input::get('complement') ."</Complemento>
			               <Bairro>". Input::get('district') ."</Bairro>
			               <Cidade>". Input::get('city') ."</Cidade>
			               <Estado>". Input::get('state') ."</Estado>
			               <Pais>BRA</Pais>
			               <CEP>". Input::get('zipcode') ."</CEP>
			               <TelefoneFixo>(". Input::get('phone_area_code') .") ". Input::get('phone_number') ."</TelefoneFixo>
			           </EnderecoCobranca>
			       </Pagador>
			    </InstrucaoUnica>
			</EnviarInstrucao>
        ";
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
            CURLOPT_POSTFIELDS => $data
        );

        curl_setopt_array($ch, $options);
        //execute curl
        $response = curl_exec($ch);
        //close curl
        curl_close($ch);
        //return json with result;
        $xml = simplexml_load_string($response);
        return View::make('moip.main_checkout')->with('moip_return_checkout',json_encode($xml));
	}

}