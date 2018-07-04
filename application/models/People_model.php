<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class People_model extends CI_Model 
{
    var $tbl_person = "users";

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();

            // Load the library
    }
    
	/**
    * Validate the meeting's data with the database
    *
    * @return Object
    */
	public function get_users()
	{
		$query = $this->db->get('users', 10);
        return $query->result();
	}

    /**
     * Get user by his/her id
     *
     * @param int $mid
     * @return boolean
     */
	public function get_user($mid)
	{
		$this->db->where('id', $mid);
		$query = $this->db->get('users');

		return $query->result();
	}

    public function delete_user($id)
    {
        //$deleted = $this->db->delete('users', array('id' => $id));
        $tables = array('users', 'membership');
        $this->db->where('id', $id);
        $this->db->delete($tables);
    }

	// get number of persons in database
    function count_all(){
        return $this->db->count_all($this->tbl_person);
    }
    // get persons with paging
    function get_paged_list($limit = 10, $offset = 0){
        $this->db->order_by('id','asc');
        return $this->db->get($this->tbl_person, $limit, $offset);
    }
    // get person by id
    function get_by_id($id){
        $this->db->where('id', $id);
        return $this->db->get($this->tbl_person);
    }
    // add new person
    function save($person){
        $this->db->insert($this->tbl_person, $person);
        return $this->db->insert_id();
    }
    // update person by id
    function update($id, $person){
        $this->db->where('id', $id);
        $this->db->update($this->tbl_person, $person);
    }
    // delete person by id
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete($this->tbl_person);
    }

    /**
     * Insert user into database 
     *
     * @return void
     */
	public function insert_entry()
    {
        $user['first_name'] = $this->input->first_name; // please read the below note
        $user['last_name']  = $this->input->last_name;
        $user['email'] = $this->input->email;
        $user['username'] = $this->input->username;
        $access = $this->input->access_level;
        
        $date     = time();

        $this->db->insert('users', $user);
    }


}

