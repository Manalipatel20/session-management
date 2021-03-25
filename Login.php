<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
    
        $this->load->model('LoginModel', 'login');
    }

    public function index() {
       
        $logged_in = $this->session->userdata('logged_in');
        if($logged_in){
         
            redirect(base_url().'welcome');
        }
      
        $this->load->view('login_page');
      
    }

    public function doLogin() {
       
        $email = $this->input->post('email');
        $password = sha1($this->input->post('password'));
        
    
        $check_login = $this->login->checkLogin($email, $password);

       
        if ($check_login) {
           
            $this->session->set_userdata('logged_in', true);
            redirect(base_url().'welcome');
        } else {
           
            $this->session->set_userdata('logged_in', false);
            
        
            $this->session->set_flashdata('msg', 'Username / Password Invalid');
            redirect(base_url().'login');            
        }
    }

    public function logout() {
       
        $this->session->unset_userdata('logged_in');
        redirect(base_url().'login');
    }

}