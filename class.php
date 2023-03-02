<?php

class Sendeo
{

	public $musteri	='musteriadiniz';
	public $sifre	='sifreniz';
	public $token;

	public function getToken() { 
		
		$data =json_encode(array("musteri"=> $this->musteri , "sifre" => $this->sifre));
		$url='https://api.sendeo.com.tr/api/Token/Login';
        
		$ch = curl_init();

        	curl_setopt($ch, CURLOPT_URL, $url);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        	curl_setopt($ch, CURLOPT_POST, 1);
       		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        	$headers = array();
        	$headers[] = 'Accept: application/xml';
        	$headers[] = 'Content-Type: application/json-patch+json';
        	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        	$response = curl_exec($ch);

		$xml      = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
		$response = json_decode(json_encode($xml), TRUE);
		
		return $response['result']['Token'];
		curl_close($ch);
 
    	} 
	
	public function SetDelivery($data) {
		
        	$ch = curl_init();
		$url='https://api.sendeo.com.tr/api/Cargo/SETDELIVERY';
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$headers = array();
		$headers[] = 'Accept: application/xml';
		$headers[] = 'Authorization:Bearer '.$this->token;
		$headers[] = 'Content-Type: application/json-patch+json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch);
		return $response;
		curl_close($ch);
 
    	}
	public function CancelDelivery($data) {
		

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://api.sendeo.com.tr/api/Cargo/CANCELDELIVERY');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$headers = array();
		$headers[] = 'Authorization:Bearer '.$this->token;
		$headers[] = 'Accept: application/json';

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		return $result;
		curl_close($ch);
 
    	}
	public function TrackDelivery($data) {
	
		$ch = curl_init();
		$url='https://api.sendeo.com.tr/api/Cargo/TRACKDELIVERY?'.http_build_query($data);
		curl_setopt($ch, CURLOPT_URL, $url);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        	$headers = array();
		$headers[] = 'Authorization:Bearer '.$this->token;
		$headers[] = 'Accept: application/json';
        	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        	$response = curl_exec($ch);
		return $response;
		curl_close($ch);
	
	}
	public function GetCityDistricts($data) {
	
		$ch = curl_init();
		$url='https://api.sendeo.com.tr/api/Cargo/GetCityDistricts?'.http_build_query($data);
        	curl_setopt($ch, CURLOPT_URL, $url);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        	$headers = array();
		$headers[] = 'Authorization:Bearer '.$this->token;
		$headers[] = 'Accept: application/json';
        	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        	$response = curl_exec($ch);

		return $response;
		curl_close($ch);
	
	}

}
