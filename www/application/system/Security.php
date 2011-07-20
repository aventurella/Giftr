<?php
namespace Giftr\System;
class Security
{
	private static $key = 'e32d7e51c66b20a54d03c0dc51390c88';
	
	public static function hash($input)
	{
		return hash('sha256', $input);
	}
	
	public static function is_valid_user_cookie($token, $user_token)
	{
		$configuration = Configuration::standardConfiguration();
		return $token == hash_hmac('sha1', $user_token, $configuration['cookieSecret']);
	}
	
	public static function generate_cookie_token($user_token)
	{
		$configuration = Configuration::standardConfiguration();
		return hash_hmac('sha1', $user_token, $configuration['cookieSecret']);
	}
	
	public static function generate_token($salt=null)
	{

		$key    = null;
		$data   = null; 
		
		if(function_exists('openssl_random_pseudo_bytes'))
		{
			$strong = false;

			while(!$strong)
			{
				$data = openssl_random_pseudo_bytes(512, $strong);
			}
		}
		else
		{
			$stream = fopen('/dev/urandom', 'rb');
			//$stream = fopen('/dev/random', 'rb');

			if($stream)
			{
				$data   = fread($stream, 64);
				fclose($stream);
			}
		}

		$key =  hash('md5', base64_encode($data).$salt.uniqid(mt_rand(), true));
		return $key;
	}
	
	public static function generate_password()
	{
		/*
		$base   = "_-!@#%^&*()[]{}|?><.+=;:0123456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		*/
		
		$base   = "!@$0123456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$string = "";
		$i      = 0;

		while ($i < 8) 
		{ 
			$char = substr($base, mt_rand(0, strlen($base)-1), 1);

			if (!strstr($string, $char)) 
			{ 
				$string .= $char;
				$i++;
			}
		}

		return $string;
	}
}
?>