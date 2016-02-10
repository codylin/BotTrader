<?php

/**
 * core/MY_Model.php
 *
 * Generic domain model.
 *
 * Intended to model both a single domain entity as well as a table.
 * This is consistent with CodeIgniter's interpretation of the Active Record
 * pattern, even though some of the functions are at the table level
 * while others are at the record level :-/
 *
 * Each such model is bound to a specific database table, using a designated
 * key field as the associative array index internally.
 */
class Access extends CI_Model {



    // Constructor

    function __construct()
    {
	parent::__construct();
	
    }
    
    function players()
    {
        $query = $this->db->get('players');
        return $query->result_array();
    }
    
    function series()
    {
        $query = $this->db->get('series');
        return $query->result_array();
    }

    function collections()
    {
        $query = $this->db->get('series');
        return $query->result_array();
    }
    
    function transactions()
    {
        $this->db->order_by('DateTime','desc');
        $query = $this->db->get('series');
        return $query->result_array();
    }
}

/*$autoload['model'] = array('images');

