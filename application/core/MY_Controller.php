<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		Kelly Liu
 * @copyright           2015-2016
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();

        // load parser library
        $this->load->library('parser');

        // Create data
        $this->data = array();
        $this->data['title'] = 'BotTrader WebApp';

        // Create error arrays
        $this->errors = array();
        // login and logout function
        $this->login();
    }

    /**
     * Render this page
     */
    function render() {
        // create the menu bar based on if an user is logged in or not
        $this->build_menubar();
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

        // finally, build the browser page!
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }

    function login() {
        // Set welcome message to null so nothing will be displayed
        $this->data['welcome_txt'] = NULL;
        // Set login message to null so nothing will be displayed when no one is logged in
        $this->data['login_msg'] = NULL;
        // get the login and action from get/post
        $username = $this->input->get_post('username');
        $action = $this->input->get_post('action');
        $this->data['debug'] = print_r($username, TRUE);

        if ($this->session->userdata('username') && $action === 'logout') {
            // if someone is logged in and wants to logout, remove login session data
            $this->session->unset_userdata('username');
            $this->data['logout_msg'] = 'Logout successful!';
        } else if (!empty($username) && $action === 'login') {
            // if an user is log in, check against users       
            $this->load->model('player');

            // if user exists, log in by adding session data  
            $this->session->set_userdata('username', $username);
            $this->data['login_msg'] = 'Log in successful!';
        }
    }

    /**
     * Create the menu bar, including the login box
     */
    function build_menubar() {
        // get the menu bar data from config
        $i = $this->config->item('menu_choices');
        $t = $i['menudata'];
        $this->data['menudata'] = $t;

        // check if anyone is logged in
        if ($this->session->userdata('username')) {
            // if so, display logout button
            $this->data['welcome_txt'] = 'Welcome, ' . $this->session->userdata('username');
            $this->data['login_submit_txt'] = 'Logout';
            $this->data['login_btn_appear'] = 'none';
            $this->data['login_action'] = 'logout';
        } else {
            // if no one is logged in, display the login box
            $this->data['welcome_text'] = '';
            $this->data['login_submit_txt'] = 'Login';
            $this->data['login_btn_appear'] = 'initial';
            $this->data['login_action'] = 'login';
        }

        // parse the menu bar
        $this->data['menubar'] = $this->parser->parse('_menubar', $this->data, true); //$this->config->item('menu_choices')
    }
}
