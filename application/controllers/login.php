<?php

class Login extends Controller {

    function Login()
    {
        parent::Controller();
        $this->load->model('login_model');
    }

    function index()
    {
        $data['template'] = 'login';
        $this->load->view('template', $data);
    }

    function enter()
    {
        if($this->input->post('submit_login'))
        {
            $username = $this->input->xss_clean($this->input->post('username'));
            $password = $this->input->xss_clean($this->input->post('password'));
            if($this->login_model->try_login($username, $password))
            {
                $this->session->set_userdata('status', md5('true'));
            }
        }
        redirect('/', 'refresh');
    }

    function logout()
    {
       $this->session->sess_destroy();
       redirect('/', 'refresh');
    }
}
