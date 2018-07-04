<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
// Determine if request is an AJAX Request
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

class Meeting extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();

		//load the library
        $this->load->library("authex");

        // load meeting_model
        $this->load->model("meeting_model");

        if(!$this->authex->logged_in())
        {
            //they are not logged in
            redirect("home/login");
        }
	}

	public function index()
    {
    	// Get the list of meetings
        $meetings = $this->meeting_model->get_meetings_list();            

        $data['main_content'] = 'meeting/index';
		$data['title'] = "Meetings";
		$data['links'] = array(
			'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
			'address book' => site_url("people/index"),
			'logout' => site_url("home/logout"),
		);

        $data["meetings"] = $meetings;
        $this->load->view('includes/template',$data);
    }

	public function create()
	{
		$this->load->helper('form');

        $data['main_content'] = 'meeting/create';
		$data['title'] = "Meetings";
		$data['links'] = array(
			'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
			'address book' => site_url("people/index"),
			'logout' => site_url("home/logout"),
		);

        $this->load->view('includes/template',$data);
		
	}

	public function save_meeting()
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required');
        /*$this->form_validation->set_rules('organiser', 'Organiser', 'required');
        $this->form_validation->set_rules('minutes_taker', 'Secretary', 'required');*/
        $this->form_validation->set_rules('location', 'Location', 'required');
        /*$this->form_validation->set_rules('when', 'Date', 'required');*/
        $this->form_validation->set_rules('description', 'Description', 'required');
        /*$this->form_validation->set_rules('description', 'Attendees', 'required');
        */
        if ($this->form_validation->run() == FALSE)
        {
            $this->create();
        }
        else
        {       
            $result = $this->meeting_model->create_meeting();

            if ($result == TRUE) {
                $this->session->set_flashdata('success', 'Meeting creation successful');
                $this->index();
            } else {
                // set the error
                $this->session->set_flashdata('error', 'Meeting creation unsuccessful');
                $this->create();
            }
        }
	}

    public function view($mid = 0)
    {   	
    	// get meeting id & ensure integer
    	$meeting_id = (int)$this->uri->segment(3);

        $data['main_content'] = 'meeting/view';
        $data['title'] = "Meetings";
    	$data['links'] = array(
			'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
			'address book' => site_url("people/index"),
			'logout' => site_url("home/logout"),
		);

    	// get meeting actions
    	$meeting = $this->meeting_model->get_meeting($meeting_id);
        $agenda = $this->meeting_model->getMeetingAgenda($meeting_id);
        $agenda_items = $this->meeting_model->getMeetingAgendaItems($meeting_id);
        $attendees = $this->meeting_model->getAttendees($meeting_id);

        $data['meeting_agenda'] = $agenda;
        $data['meeting_agenda_items'] = $agenda_items;
        $data['meeting_details'] = $meeting[0];
        $data['attendees'] = $attendees;

    	// load view
    	$this->load->view('includes/template',$data);
    }

    public function update()
    {
        $this->load->helper('form');

        $data['main_content'] = 'meeting/create';
        $data['title'] = "Meetings";
        $data['links'] = array(
            'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
            'address book' => site_url("people/index"),
            'logout' => site_url("home/logout"),
        );

        $this->load->view('includes/template',$data);
    }

    public function agenda()
    {
    	// get meeting id & ensure integer
    	$meeting_id = (int)$this->uri->segment(3);

    	if($meeting_id==0) {
    		// redirect to create dashboard
    		redirect("meeting/index");
    	}

    	$agenda = $this->meeting_model->getMeetingAgenda($meeting_id);
        $agenda_items = $this->meeting_model->getMeetingAgendaItems($meeting_id);

        $data['meeting_agenda'] = $agenda;
        $data['meeting_agenda_items'] = $agenda_items;

        $data['main_content'] = 'meeting/view_meeting_agenda';
        $data['title'] = "Meetings";
    	$data['links'] = array(
			'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
			'address book' => site_url("people/index"),
			'logout' => site_url("home/logout"),
		);

    	// load view of meetings agenda
    	$this->load->view('includes/template',$data);
    }

    function save_agenda()
    {
        // get meeting id & ensure integer
        $meeting_id = (int)$this->uri->segment(3);

        if($meeting_id==0) {
            // redirect to create dashboard
            redirect("meeting/index");
        }

        $data['meeting_agenda'] = $this->meeting_model->getMeetingAgenda($meeting_id);
        $data['meeting_agenda_items'] = $this->meeting_model->getMeetingAgendaItems($meeting_id);

        $data['main_content'] = 'meeting/view_meeting_agenda';
        $data['title'] = "Meetings";
        $data['links'] = array(
            'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
            'address book' => site_url("people/index"),
            'logout' => site_url("home/logout"),
        );

        print_r($data);

        // load view of meetings agenda
        $this->load->view('includes/template',$data);
    }

    function delete()
    {
        $this->load->model("meeting_model");
        
        // get people id & ensure integer
        $meeting_id = (int)$this->uri->segment(3);

        $deleted = $this->meeting_model->delete($meeting_id);

        if($deleted==false) {
            $this->session->set_flashdata('error', 'Delete unsuccesful!');
        } else {
            $this->session->set_flashdata('success', 'Meeting removed!');
        }
        
        redirect("meeting/index");

    }

    public function test_email()
    {
        $this->load->model("meeting_model");

        $inv = "skomfi@gmail.com";
        $email_body = "<div>";
        $email_body .= "<div>Meeting invite: My Meeting</div>";
        $email_body .= "<div><p></p></div>";
        $email_body .= "<div>We would hereby like to invite you to attend the Inauguration ceremony of our business located at ergtgef.</div>";
        $email_body .= "<div><br/ ><p> Regards</p></div>";
        $email_body .= "</div>";            

        // send email to each attendees
        $subj= "Meeting invite: My Meeting";
        $email = trim($inv);
        $body = $email_body;
        $this->meeting_model->send_mail($email, $body, $subj);

        redirect("meeting/index");
    }

    public function invites()
    {
        // Get the current logged in user
        // get logged in user
        $uid = $this->session->userdata('id');
        $invites = $this->meeting_model->getInvites($uid);

        $data['main_content'] = 'meeting/invites';
        $data['title'] = "Meeting Invites";
        $data['links'] = array(
            'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
            'address book' => site_url("people/index"),
            'logout' => site_url("home/logout"),
        );
        $data['meeting_invites'] = $invites;

        // load view of meetings agenda
        $this->load->view('includes/template',$data);

    }

    public function accept()
    {
        // get meeting id & ensure integer
        $meeting_id = (int)$this->uri->segment(3);

        $deleted = $this->meeting_model->delete($meeting_id);

        if($deleted==false) {
            $this->session->set_flashdata('error', 'Meeting invite accepted');
        } else {
            $this->session->set_flashdata('success', 'Meeting declined');
        }
        
        redirect("meeting/invites");
    }

    public function decline()
    {
        // get meeting id & ensure integer
        $meeting_id = (int)$this->uri->segment(3);

        $data['main_content'] = 'meeting/view';
        $data['title'] = "Meetings";
        $data['links'] = array(
            'meeting' => site_url('meeting/index'),
            'invites' => site_url('meeting/invites'),
            'address book' => site_url("people/index"),
            'logout' => site_url("home/logout"),
        );

        // get meeting actions
        $meeting = $this->meeting_model->get_meeting($meeting_id);
        $agenda = $this->meeting_model->getMeetingAgenda($meeting_id);
        $agenda_items = $this->meeting_model->getMeetingAgendaItems($meeting_id);
        $attendees = $this->meeting_model->getAttendees($meeting_id);

        $data['meeting_agenda'] = $agenda;
        $data['meeting_agenda_items'] = $agenda_items;
        $data['meeting_details'] = $meeting[0];
        $data['attendees'] = $attendees;

        // load view
        $this->load->view('includes/template',$data);
    }
}