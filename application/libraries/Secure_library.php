<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("SECRET_HASH", "qe3jigneqfrgnqw2egfmas4qetjkn5lg");

class Secure_library {
	
	function secure_text($str)

	{

		$CI=& get_instance();

		$CI->load->library('encrypt');

		$Pass = $CI->config->item('encryption_key');

		$CI->encrypt->set_cipher(MCRYPT_BLOWFISH);

		$CI->encrypt->set_mode(MCRYPT_MODE_CFB);

		$encrypted_string = $CI->encrypt->encode($str,$Pass);

		return $encrypted_string;

	}

	

	function decode_text($str)

	{

		$CI=& get_instance();

		$CI->load->library('encrypt');

		$Pass = $CI->config->item('encryption_key');

		$CI->encrypt->set_cipher(MCRYPT_BLOWFISH);

		$CI->encrypt->set_mode(MCRYPT_MODE_CFB);

		$encrypted_string = $CI->encrypt->decode($str,$Pass);

		return $encrypted_string;

	}

	

	

	function filter_post($var,$filter)

	{

		$CI=& get_instance();

		$CI->load->helper(array('form', 'url'));

		$CI->load->library('form_validation');

		return $CI->form_validation->set_rules($var, $var, $filter);		

	}

	

	function start_post()

	{

		$CI=& get_instance();

		$CI->load->helper(array('form', 'url'));

		$CI->load->library('form_validation');

		if ($CI->form_validation->run() == FALSE)

		{

			return false;

		}else{

			return true;

		}

	}

	

	function filter_segment($id)

	{

		$CI=& get_instance();

		

		$CI->load->helper('security');

		$is_kode=$CI->security->xss_clean($CI->uri->segment($id));

		if($is_kode)

		{

			return $is_kode;

		}else{

			return false;

		}

	}

	

	function filter_xss($data)

	{

		$CI=& get_instance();

		$CI->load->helper('security');

		if ($CI->security->xss_clean($data, TRUE) === FALSE)

		{

			return false;		

		}else{

			return true;

		}

	}

	

	function filter_post2($var)

	{

		$CI=& get_instance();

		$is_data=$CI->input->post($var,TRUE);

		return $is_data;

	}

	

	function password_hash($password)

	{

		$pl=sha1(md5(sha1(md5(md5($password) + sha1($password)) + md5($password))));

		return $pl;

	}

	

	

	public function make_url($_url)

 	{

 		if (!isset($_SESSION['hashed_urls']))	{

 			$_SESSION['hashed_urls'] = array();

 		}

 		$hashed_url = $this->_make_hash_by_url($_url);

 		$_SESSION['hashed_urls'][$_url]=$hashed_url;

 		return $hashed_url;

 	}

 	

 	public function get_real_url($_hash)

 	{

 		

 		$url = $this->_get_url_by_hash($_hash);

 		$_SESSION['hashed_urls'][$url]="";

 		 		

 		return $url;

 	}

 	

 	

 	

 	private function _get_url_by_hash($_hash)

 	{

 		if (isset($_SESSION['hashed_urls']))	{

	 		foreach ($_SESSION['hashed_urls'] as $key=>$value)

	 		{

	 			if ($value == $_hash)

	 			{

	 				return $key;

	 			}

	 		}

 		}

 		return null;

 	}

 	

 	private function _make_hash_by_url($_url)

 	{

 		return md5($_url . SECRET_HASH . time());

 	}	

	function make_password($str)
	{
		require_once(APPPATH.'libraries/phpass-0.1/PasswordHash.php');
		$t_hasher = new PasswordHash(8, FALSE);
		return $t_hasher->HashPassword($str);
	}
	
	function check_password($password,$hash)
	{
		require_once(APPPATH.'libraries/phpass-0.1/PasswordHash.php');
		$t_hasher = new PasswordHash(8, FALSE);
		$is_ok=$t_hasher->CheckPassword($password, $hash);
		if($is_ok)
		{
			return true;
		}else{
			return false;
		}
	}

}