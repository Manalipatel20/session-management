<?php

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
      $this->load->model('RegisterModel', 'register');
    }

 
    public function index() {
       
        if ($this->session->userdata('logged_in')) {
            redirect(base_url() . 'welcome');
        }
   
        $this->load->view('register_page');

    }


    public function doRegister() {
     
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
        $this->form_validation->set_message('is_unique', 'Email already exists.');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

    
        if ($this->form_validation->run() == FALSE) {
     
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'register');
        } else {
        
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = sha1($this->input->post('password'));

            $data = [
                'name' => $name, 'email' => $email, 'password' => $password, 'date_time' => date('Y-m-d H:i:s')
            ];

          
            $insert_data = $this->register->add_user($data);

        
            if ($insert_data) {
                $this->session->set_flashdata('msg', 'Successfully Register, Login now!');
                redirect(base_url() . 'login');
            }
        }
    }
}
