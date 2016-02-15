<?php

/**
 * Data access wrapper for "menu" table.
 *
 * @author jim
 */
class Transaction extends MY_Model2 {
    // constructor
    function __construct() {
        parent::__construct('transactions','DateTime', 'Player');
    }
    function getHistoryByPlayer($playerName){
    $history = $this->transaction->all();
        // Build a multi-dimensional array for reporting
        $trans = array();
        foreach ($history as $activity) {
            if ($activity->Player != $playerName){
                continue;
            }else{
            $this1 = array(
                'time' => $activity->DateTime,
                'act' => $activity->Trans,
                'series' => $activity->Series,
            );
            $trans[] = $this1;
            }
        }
        return $trans;
    }
    
    function linktrans($link)
    {
         $query = $this->db->query("SELECT DateTime, Series,Trans FROM transactions where Player like '$link'");
         return $query->result();
    }
}
