<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting_model extends CI_Model 
{
	public $title;
    public $organiser;
    public $when;

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();

            // Load the library
    }
    
	/**
    * Validate the meeting's data with the database
    * @return void
    */
	public function get_meetings_list()
	{   
		$query = $this->db->get('meetings', 10);
        return $query->result();
	}

	public function get_meeting($mid)
	{
		$this->db->where('id', $mid);
		$query = $this->db->get('meetings');
		
		return $query->result();
	}

    public function create_meeting()
    {
        // load user model 
        $this->load->model('user_model');

    	// init
		$meeting = array();
		$attendees = array();

        // get logged in user
        $uid = $this->session->userdata('id');

        // get minutes taker id
        $mt_email = $this->input->post('minutes_taker');
        $mt_id = $this->user_model->get_user_by_email($mt_email);

		$meeting['title'] = $this->input->post('title'); // please read the below note
        $meeting['organiser'] = $uid;
        $meeting['minutes_taker'] = $mt_id[0]->id;
        $meeting['when'] = $this->input->post('date'); 
        $meeting['location'] = $this->input->post('location');
        $meeting['description'] = $this->input->post('description');

        $this->db->insert('meetings', $meeting);
        $meeting_id = $this->db->insert_id(); // get last insert id of the newly created meeting

        // update meeting id for attendees
        $attendees['meeting_id'] = $meeting_id;


        $accept_url = site_url('meeting/accept');
        $declined_url = site_url('images/decline');

        // get the list of attendees
        $invitees = $this->input->post('attendees');

        // convert the string to array
        $arrAtt = explode(',', $invitees);

        foreach ($arrAtt as $inv) {

            // send email to each attendees
            $subj= "Meeting invite: ". $meeting['title'];
            $email = trim($inv);

            // get users id from email
            $attUserObj = $this->user_model->get_user_by_email($email);

        	$email_body = "<div>";
        	$email_body .= "<div>Meeting invite: ". $meeting['title'] ."</div>";
        	$email_body .= "<div><p></p></div>";
        	$email_body .= "<div>We would hereby like to invite you to a meeting:";
            $email_body .= "Located at ". $meeting['location'] ." on ". $meeting['when'] .".</div>";
            $email_body .= "<a href='". $accept_url ."/". $attUserObj[0]->id ."/". $meeting_id ."'>Accept</a>|<a href='". $declined_url ."/". $attUserObj[0]->id ."/". $meeting_id ."'>Decline</a>";
        	$email_body .= "<div><br/ ><p> Regards</p></div>";
			$email_body .= "</div>";        	

			$body = $email_body;
			$this->send_mail($email, $body, $subj);

            if($attUserObj) {
        	   $attendees['user_id'] = $attUserObj[0]->id;
        	   $this->db->insert('invitees', $attendees);
            }
        }

        return true;
    }

    public function invite_attendees() {

    }

    public function get_id_from_mail($email) {
    	$this->db->where('email', $email);
    	$query = $this->db->get('users');
		
		if($query->num_rows > 0)
		{
			return $query->result();
		}		

		return false;
    }

    public function send_mail($email, $body, $subject)
	{
    	//load email helper
   		$this->load->helper('email');
    	
    	//load email library
   	 	$this->load->library('email');
    
    
    	// check is email addrress valid or no
    	if (valid_email($email)){  
      	
	      	// compose email
	      	$this->email->from('skomfi@obrerosoft.com', 'Eminutes');
	      	$this->email->to($email); 
	      	$this->email->subject($subject);
	      	$this->email->message($body);  
      
	      	// send mail
	     	if ( ! $this->email->send())
	      	{
	        	$data['message'] ="Email not sent \n".$this->email->print_debugger();      
	        	return false;
	      	}

	        // successfull message
	        $data['message'] ="Email was successfully sent to $email";
	      	return true;
    	} else { 
    		$data['message'] = 'Invalid Email';
    		return false;
    	}
  	}

    public function get_meeting_agenda($id)
    {
    	$this->db->where('meeting_id', $id);
    	$query = $this->db->get('agenda');

		return $query->result();
    }

    public function getGraphData()
    {
        // first query
        $this->db->select("*");
        $whereCondition = array('LAST_NAME' =>$search);
        $this->db->where($whereCondition);
        $this->db->from('trn_employee');
        $query = $this->db->get();
        $first = $query->result();

        // second query
        $this->db->select("");
        $whereCondition = array('LAST_NAME' =>$search);
        $this->db->where($whereCondition);
        $this->db->from('trn_employee');
        $query = $this->db->get();
        $first = $query->result();

        // third query
        $this->db->select("");
        $whereCondition = array('LAST_NAME' =>$search);
        $this->db->where($whereCondition);
        $this->db->from('trn_employee');
        $query = $this->db->get();
        $first = $query->result();

        // init & format data neatly
        $arrGraphs = array('graph1' => array(), 'graph2' => array(), 'graph3' => array());
    }

    /**
     * Get the meeting agenda
     */
    function getMeetingAgenda($meeting_id)
    {
        $this->db->select('*');
        $this->db->from('agenda');
        $this->db->where('agenda.meeting_id', $meeting_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * Get the meeting agenda
     */
    function getMeetingAgendaItems($meeting_id)
    {
        $this->db->select('*');
        $this->db->from('agenda');
        $this->db->join('agenda_items', 'agenda.id = agenda_items.heading_id', 'left');
        $this->db->join('actions', 'actions.id = agenda_items.id', 'left');
        $this->db->where('agenda.meeting_id', $meeting_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    function getAttendees($meeting_id)
    {
        $this->db->select('users.id,users.email,users.first_name,users.last_name,invitees.meeting_id,invitees.user_id,invitees.declined,invitees.reasons');
        $this->db->from('invitees');
        $this->db->join('users', 'invitees.user_id = users.id', 'left');
        $this->db->where('invitees.meeting_id', $meeting_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    function getInvites($user_id)
    {
        $this->db->select('meetings.id,meetings.title,meetings.organiser,meetings.location,meetings.when,meetings.minutes_taker,invitees.id AS inv_id,invitees.meeting_id,invitees.user_id,invitees.declined,invitees.reasons');
        $this->db->from('invitees');
        $this->db->join('meetings', 'invitees.meeting_id = meetings.id', 'left');
        $this->db->where('invitees.user_id', $user_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    function delete($meeting_id)
    {
        $this->db->where('id', $meeting_id);
        $result = $this->db->delete('meetings');

        return $result;
    }
}

