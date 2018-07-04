<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class people extends CI_Controller {
 
	// num of records per page
    private $limit = 10;

	function __construct()
	{
		parent::__construct();

		//load the library
        $this->load->library("authex");

        // load library
        $this->load->library(array('table','form_validation'));

        if(!$this->authex->logged_in())
        {
            //they are not logged in
            redirect("home/login");
        }
	}

	public function index($offset = 0)
    {
    	// Get the list of peoples
        $this->load->model("people_model");   
        $people = $this->people_model->get_users();            

        $data['main_content'] = 'people/index';
		$data['title'] = "Address Book";
		$data['links'] = array(
			'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
			'address book' => site_url("people/index"),
			'logout' => site_url("home/logout"),
		);

		// generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('people/index/');
        $config['total_rows'] = 11;//$this->people_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;

        // Customize links
        $config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

		$data['people'] = $people;

        $this->load->view('includes/template',$data);
    }

	public function create()
	{
		$this->load->helper('form');

        $data['main_content'] = 'people/create';
		$data['title'] = "peoples";
		$data['links'] = array(
			'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
            'address book' => site_url("people/index"),
            'logout' => site_url("home/logout"),
		);

        $this->load->view('includes/template',$data);
		
	}

	public function add_user()
	{
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

        if ($this->form_validation->run() === FALSE)
        {
            $this->create();
        }
        else
        {       
            // get the user model
            $this->load->model('user_model');

            $result = $this->user_model->create_member();
            
            if ($result == TRUE) {
                $this->index();
            } else {
                // set the error
                $this->session->set_flashdata('error', 'Username already exists!');
                $this->create();
            }
        }

	}

    public function view()
    {
    	$this->load->model("people_model");
    	
    	// get people id & ensure integer
    	$person_id = (int)$this->uri->segment(3);

        $data['main_content'] = 'people/view';
        $data['title'] = "View Person";
    	$data['links'] = array(
			'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
            'address book' => site_url("people/index"),
            'logout' => site_url("home/logout"),
		);

    	// get the user for the address book
    	$person = $this->people_model->get_user($person_id);

        if($person==false) {
            $flash_data = 'User not found';
            redirect('people/index');
        }

        $data['person'] = $person[0];

    	// load view
    	$this->load->view('includes/template', $data);
    }

    public function delete()
    {
        $this->load->model("people_model");
        
        // get people id & ensure integer
        $person_id = (int)$this->uri->segment(3);

        $deleted = $this->people_model->delete($person_id);

        if($deleted==false) {
            $this->session->set_flashdata('error', 'Delete unsuccesful!');
        } else {
            $this->session->set_flashdata('success', 'Person removed!');
        }
        
        redirect("people/index");
    }

    public function update()
    {
        $this->load->model("people_model");
        
        // get people id & ensure integer
        $person_id = (int)$this->uri->segment(3);

        $data['main_content'] = 'people/update';
        $data['title'] = "Update Person";
        $data['links'] = array(
            'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
            'address book' => site_url("people/index"),
            'logout' => site_url("home/logout"),
        );

        // get the user for the address book
        $person = $this->people_model->get_user($person_id);

        if($person==false) {
            $this->session->set_flashdata('error', 'User not found');
            redirect('people/index');
        }

        $data['person'] = $person[0];

        // load view
        $this->load->view('includes/template', $data);
    }

    public function email()
    {   
        $this->load->model("user_model");

        // Get the search parameter
        $search = $this->input->get('search');

        $suggestion = $this->user_model->getEmailList($search);

        $email = array();
        foreach ($suggestion as $row) {
            $email[] = $row['email'];
        }
        echo json_encode($email);
    }
}