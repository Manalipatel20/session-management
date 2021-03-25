<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome1 extends MY_Controller {

    public function index() {
      //  $this->load->view('header');
        $this->load->view('message');
      //  $this->load->view('footer');
    }

}