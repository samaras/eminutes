<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This file name is home.php
// The class name for this file should be the same
//  filename, except it should be capitalized. 

class Home extends CI_Controller
{

	function __construct(){
		// To grab the class variable, (this) needs to be used
       	parent::__construct();

       	/*if($this->authex->logged_in())
        {
            //they are logged in
            redirect("home/dashboard");
        }*/
	}
	
	public function index()
	{
		if($this->authex->logged_in())
        {
            //they are logged in
            redirect("home/dashboard");
        }

		$data['main_content'] = 'home_view';
		$data['title'] = "Eminutes Tracking System";
		$data['links'] = array(
			'login' => site_url('home/login'),
			'register' => site_url("home/register"),
		);

		$this->load->view('includes/template', $data);
	}

	public function login()
	{	
		//This method will have the credentials validation
		$this->load->helper('form');

		// First is the main content to display
		$data['main_content'] = 'login_view';
		$data['title'] = "Login Tracking System";
		$data['links'] = array(
			'register' => site_url("home/register"),
		);
		
	 	//Field validation failed.  User redirected to login page
	 	$this->load->view('includes/template', $data);
	}

	public function signin()
	{
		//This method will have the credentials validation
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_model');

		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			$this->login();
		}
		else
		{
			if($this->user_model->validate()){
			 	//Go to private area
			 	$this->dashboard();
			}
			else 
			{
				$this->session->set_flashdata('error', 'Incorrect login details');
				$this->login();
			}
		}
	}

	function logout() 
	{
		$this->session->sess_destroy();
		
		// We will load the template.
		$this->index();
	}

	public function register()
	{
		// load from library
		$this->load->helper('form');

		$data['main_content'] = 'register_view';
		$data['title'] = "Register";
		$data['links'] = array(
			'login' => site_url("home/login"),
		);

		$this->load->view('includes/template', $data);
	}

	public function signup()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_model');

		// validation
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha_numeric|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha_numeric|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|is_unique[users.username]|alpha_numeric|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconfirm]',
                array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_rules('phone', 'Phone','regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('passconfirm', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('gender', 'Gender', 'required');

        if ($this->form_validation->run() == FALSE)
        {
			$this->register();
		}
		else
		{		
			$result = $this->user_model->create_member();
			if ($result == TRUE) {
				$data['success'] = 'Registration Successful !';
				$this->session->set_flashdata('success', 'Registration Successful!');

				$data['main_content'] = 'login_view';
				$data['title'] = "Login Tracking System";
				$data['links'] = array(
					'register' => site_url("home/register"),
				);
				$this->load->view('includes/template', $data);
			} else {
				// set the error
				$data['error'] = 'Username already exist!';
				$this->session->set_flashdata('error', 'Username already exists!');

				$data['main_content'] = 'register_view';
				$data['title'] = "Register - Tracking System";
				$data['links'] = array(
					'login' => site_url("home/login"),
				);

				$this->load->view('includes/template', $data);
			}
		}
	}

	public function dashboard()
	{
		if(!$this->authex->logged_in())
        {
            //they are not logged in
            redirect("home/login");
        }

		$data['main_content'] = 'dashboard_view';
		$data['title'] = "Eminutes Tracking System";
		$data['links'] = array(
			'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
			'address book' => site_url("people/index"),
			'logout' => site_url("home/logout"),
		);

		$this->load->view('includes/template', $data);
	}

	public function about()
	{
		$data['main_content'] = 'about_view';
		$data['title'] = "About Us";

		if($this->authex->logged_in())
        {
            $data['links'] = array(
				'meeting' => site_url('meeting/index'),
	            'invites' => site_url('meeting/invites'),
				'address book' => site_url("people/index"),
				'logout' => site_url("home/logout"),
			);
        } else {
    		$data['links'] = array(
    			'login' => site_url('home/login'),
    			'register' => site_url('home/register'),
			);
        }
		
		$this->load->view('includes/template', $data);
	}

	public function contact()
	{

		$data['main_content'] = 'contact_view';
		$data['title'] = "Contact Us";
		if($this->authex->logged_in())
        {
            $data['links'] = array(
				'meeting' => site_url('meeting/index'),
	            'invites' => site_url('meeting/invites'),
				'address book' => site_url("people/index"),
				'logout' => site_url("home/logout"),
			);
        } else {
    		$data['links'] = array(
    			'login' => site_url('home/login'),
    			'register' => site_url('home/register'),
			);
        }

		$this->load->view('includes/template', $data);
	}

	public function get_graph_data()
	{
		if($_POST) {
 			$this->load->model('meeting_model');
        	$json_data = $this->meeting_model->getGraphData();
    		echo json_encode ($json_data);
    	}
	}
}
