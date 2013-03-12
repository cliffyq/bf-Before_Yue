<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function test_method($var = '')
    {
    	$preference = read_config('upload_logo', TRUE, 'company');
        return $preference;
    }   
}

// 
if (!function_exists('my_upload')){
	
	/**
	 * upload file by different module's config 
	 * 
	 * @param $field_name :  corresponding field name(e.g. <ipunt type='file' name='#'>)in the form which is submited.
	 * @param $file_name :  The name will be saved in server, Default means using the name seted in config file.
	 * @param $path : The full path of this file
	 * @param $module: determine using which module's config
	 * @param $config : The specific config file, default is upload
	 *
	 * @return string The full html for the select input.
	 */
	function my_upload($field_name,$file_name=NULL,$path,$module,$config="upload"){
			$CI =& get_instance();
			$preference = read_config($config, TRUE, $module);
			if($file_name!=NULL) $preference['file_name'] =$file_name; 
			$preference['upload_path'] =$path;
			if(!is_dir($preference['upload_path']))
			{
				mkdir($preference['upload_path'],0777,true);
			}
			$CI->load->library('upload',$preference);
			$CI->error='';
			if ( ! $CI->upload->do_upload($field_name))
			{
				$data['error'] = $CI->upload->display_errors();
			}
			else
			{
				$data = array('upload_data' => $CI->upload->data());
			}
			return $data;
		
	}
}