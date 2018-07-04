<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Authex
{
	function __construct()
	{
		$CI =& get_instance();

		//load libraries
		$CI->load->database();
		$CI->load->library("session");
	}

	function logged_in()
	{
		$CI =& get_instance();
		return ($CI->session->userdata("username")) ? true : false;
	}

	function get_userdata()
	{
		$CI =& get_instance();

		if( ! $this->logged_in())
		{
			return false;
		}
		else
		{
			$query = $CI->db->get_where("users", array("ID" => $CI->session->userdata("user_id")));
			return $query->row();
		}
	}
}