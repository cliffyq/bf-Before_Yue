<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	//url safe base64 encode and decode
	if ( ! function_exists('urlsafe_b64encode'))
	{
		function urlsafe_b64encode($string) {
			$data = base64_encode($string);
			$data = str_replace(array('+','/','='),array('-','_',''),$data);
			return $data;
		}
	}
	if ( ! function_exists('urlsafe_b64decode'))
	{
		function urlsafe_b64decode($string) {
			$data = str_replace(array('-','_'),array('+','/'),$string);
			$mod4 = strlen($data) % 4;
			if ($mod4) {
				$data .= substr('====', $mod4);
			}
			return base64_decode($data);
		}
	}
	
