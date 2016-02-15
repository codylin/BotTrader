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
    
    //get all players table entry
    function players()
    {
        $query = $this->db->get('players');
        return $query->result_array();
    }
    
    //get all series table entry
    function series()
    {
        $query = $this->db->get('series');
        return $query->result_array();
    }
    
    //get all collections table entry
    function collections()
    {
        $query = $this->db->get('collecctions');
        return $query->result_array();
    }
    
    //get all transaction table items
    function transactions()
    {
        $this->db->order_by('DateTime','desc');
        $query = $this->db->get('transactions');
        return $query->result_array();
    }
    
    //get functions for main page from database
    //get the player/peanuts/equity table
    function getplayerdatatable(){
        $query = $this->db->query("select a.player as Player, a.peanuts as Peanuts, (a.peanuts+count(b.Piece)) as Equity from players a inner join collections b on a.Player = b.Player group by a.Player");
        return $query->result();
    }
            
    //get equity row
    function getequity(){
        $query = $this->db->query("select (a.Peanuts+sum(b.Piece)) as equity from players a inner join collections b on a.Player = b.Player group by a.Player");
        return $query->result_array();
    }
    
    //get player row
    function getplayer(){
        $query = $this->db->query("select player from players");
        return $query->result();
    }
    
    //get peanuts per player
    function getpeanuts(){
        $query = $this->db->query("select peanuts from players");
        return $query->result_array();
    }
    
    //game stats
    //get the known pieces
    function getknownpiece(){
        $query = $this->db->query("SELECT piece FROM `collections` group by piece");
        return $query->result();
    }
    
    //count the number 11 seriess sold
    function count11(){
        $query = $this->db->query("select count(series) FROM transactions where series = '11'");
        return $query->result();
    }
    
    //count the number 11 seriess sold
    function count13(){
        $query = $this->db->query("select count(series) FROM transactions where series = '13'");
        return $query->result();
    }
    
    //count the number 11 seriess sold
    function count22(){
        $query = $this->db->query("select count(series) FROM transactions where series = '22'");
        return $query->result();
    }
    
    //count the total parts for series 11
    function parts11(){
        $query = $this->db->query("select (count(a.piece) + ((select count(b.Series) from transactions as b where a.Player = b.Player and b.Series = 11)*3)) as part11 from collections as a WHERE piece like '11%-%'");
        return $query->result();
    }
    
    //count the total parts for series 11
    function parts13(){
        $query = $this->db->query("select (count(a.piece) + ((select count(b.Series) from transactions as b where a.Player = b.Player and b.Series = 13)*3)) as part13 from collections as a WHERE piece like '13%-%'");
        return $query->result();
    }
    
    //count the total parts for series 11
    function parts22(){
        $query = $this->db->query("select (count(a.piece) + ((select count(b.Series) from transactions as b where a.Player = b.Player and b.Series = 22)*3)) as part22 from collections as a WHERE piece like '22%-%'");
        return $query->result();
    }
    //count the amount of packs needed
    function packsold(){
        $query = $this->db->query("select count(series) as pack from transactions where Series like 'x'");
        return $query->result();
    }
    
    //get functions for assembly page
    //list of tops for a player
    function gettop($top){
        $query = $this->db->query("SELECT piece FROM `collections` WHERE piece like '%%%-0' and Player like '$top'");
        return $query->result();
    }
    //list of mids for a player
    function getmid($mid){
        $query = $this->db->query("SELECT piece FROM `collections` WHERE piece like '%%%-1' and Player like '$mid'");
        return $query->result();
    }
    //list of bot for a player
    function getbot($bot){
        $query = $this->db->query("SELECT piece FROM `collections` WHERE piece like '%%%-2' and Player like '$bot'");
        return $query->result();
    }
    
    //get functions for play
    
}

$autoload['model'] = array('access');


