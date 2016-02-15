<?php

/**
 * Data access wrapper for "menu" table.
 *
 * @author jim
 */
class Piece extends MY_Model {
    // constructor
    function __construct() {
        parent::__construct('collections','Token');
    }
    
    function pieceList(){
        $pieceList = array('11a-0'=>0,'11a-1'=>0,'11a-2'=>0,'11b-0'=>0,'11b-1'=>0,'11b-2'=>0,
            '11c-0'=>0,'11c-1'=>0,'11c-2'=>0,'13c-0'=>0,'13c-1'=>0,'13c-2'=>0,'13d-0'=>0,'13d-1'=>0,
            '13d-2'=>0,'26h-0'=>0,'26h-1'=>0,'26h-2'=>0);
        return $pieceList;
    }
    function getPieceByPlayer($playerName){
        $pieces = $this->piece->all();
        $pieceList = $this->piece->pieceList();
        // Build a multi-dimensional array for reporting
        $pis = array();
        //count how many of each piece we have
        foreach ($pieces as $pi) {
            if ($pi->Player != $playerName){
                continue;
            }else{
            $pieceList[$pi->Piece]++;
            }
        }
        foreach ($pieceList as $key => $value) {
            $this1 = array(
                'piece' => $key,
                'quantity' => $value,
            );
            $pis[] = $this1;
        }
        
        return $pis;   
    }
    function linkpiece($link){
        $query = $this->db->query("SELECT piece, count(piece) FROM `collections` where player like '$link' group by piece");
        return $query->result();
    }
}
