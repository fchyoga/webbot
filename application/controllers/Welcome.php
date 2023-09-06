<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    function __construct(){
        parent::__construct();
    }

    public function index()
    {
    	$this->load->view('bot/header');
    	$this->load->view('bot/index');
    	$this->load->view('bot/footer');
    }

}