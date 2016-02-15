<?php

/**
 * Our homepage.
 * 
 * Present a summary of the completed orders.
 * 
 * controllers/welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct() {
        parent::__construct();

    }
        function render_page($playerName){
        
        $holdings = $this->player->getHoldings($playerName);
        $pieceList = $this->piece->getPieceByPlayer($playerName);
        $history = $this->transaction->getHistoryByPlayer($playerName);
        $options = $this->player->getPlayers();
        // and pass these on to the view
        $this->data['options'] = $options;
        $this->data['peanuts'] = $holdings;
        $this->data['pieces'] = $pieceList;
        $this->data['history'] = $history;
        $this->data['money'] = $this->parser->parse('_money', $this->data, TRUE);
        $this->data['botpanel'] = $this->parser->parse('_botpanel', $this->data, TRUE);
        $this->data['plist'] = $this->parser->parse('_selectplayer', $this->data, TRUE);
        $this->data['activity'] = $this->parser->parse('_activity', $this->data, TRUE);
              $this->render();

    }
    
    function render_link($pn){
        
        $holdings = $this->player->linkplayer($pn);
        $pieceList = $this->piece->linkpiece($pn);
        $history = $this->transaction->linktrans($pn);
        $options = $this->player->getPlayers();
        // and pass these on to the view
        $this->data['options'] = $options;
        $this->data['peanuts'] = $holdings;
        $this->data['pieces'] = $pieceList;
        $this->data['history'] = $history;
        $this->data['money'] = $this->parser->parse('_money', $this->data, TRUE);
        $this->data['botpanel'] = $this->parser->parse('_botpanel', $this->data, TRUE);
        $this->data['plist'] = $this->parser->parse('_selectplayer', $this->data, TRUE);
        $this->data['activity'] = $this->parser->parse('_activity', $this->data, TRUE);
              $this->render();

    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        
        $this->data['title'] = 'Player Page';
        $this->data['pagebody'] = 'welcome';
        
        if($this->input->post('playerList')){
            $playerName = $this->input->post('playerList');
            } elseif($this->session->userdata('username')) {
                       //--------------Init------------------------------------
        
                
                $playerName = $this->session->userdata('username'); //If not specified use logged in user
        //------------------------------------------------------
            } else{
                
                $playerName = "Donald";
            }
            $this->render_page($playerName);
    }

    function name($p) {
        
        $this->data['title'] = 'Player Page';
        $this->data['pagebody'] = 'welcome';
            
            $this->render_page($p);
    }   
}