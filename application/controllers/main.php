<?php

class Main extends Controller {

    function Main()
    {
        parent::Controller();
        $this->load->model('invoice_model');
        $this->load->model('clients_model');
        if($this->session->userdata('status') != md5('true'))
        {
            redirect('/login');
        }
    }

    function index()
    {
        $data = $this->invoice_model->get_open_invoices();
        $data['template'] = 'main';
        $data['current_amount'] = $this->invoice_model->calculate_current_amount();
        $data['done_amount'] = $this->invoice_model->calculate_done_amount();
        $data['clients'] = $this->clients_model->get_clients();

        $this->load->view('template', $data);
    }

}