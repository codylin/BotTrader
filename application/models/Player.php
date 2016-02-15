<?php

/**
 * Data access wrapper for "menu" table.
 *
 * @author jim
 */
class Player extends MY_Model {
    // constructor
    function __construct() {
        parent::__construct('players','player');
    }
    function getHoldings($playerName) {
    //--------------Player Holdings Section-----------------
        $players = $this->player->get($playerName);
        // Build a multi-dimensional array for reporting
        $ps = array();
        $p = array('name' => $players->Player, 'peanut' => $players->Peanuts);
        $ps[] = $p;
        return $ps;
    }
    function getPlayers(){
                
        $playerList = $this->player->all();
        $options = array();
        foreach ($playerList as $p) {
            $this1 = array(
                'name' => $p->Player,
            );
            $options[] = $this1;
        }
        return $options;
    }
    function linkplayer($link){
        $query = $this->db->query("select player from players where player like '$link'");
        return $query->result();
    }
}
