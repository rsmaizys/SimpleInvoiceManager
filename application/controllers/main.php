<?php

class Main extends Controller {

    function Main()
    {
        parent::Controller();
        check_is_loggedin();
        $this->load->model('invoice_model');
        $this->load->model('clients_model');
    }

    function index()
    {
        $data = $this->invoice_model->get_open_invoices();
        if(!is_array($data))
        {
            $data['invoices'] = false;
        }
        $data['template'] = 'main';
        $data['current_amount'] = $this->invoice_model->calculate_current_amount();
        $data['done_amount'] = $this->invoice_model->calculate_done_amount();
        $data['clients'] = $this->clients_model->get_clients();
        $data['settings'] = $this->settings_model->get_settings();
        $this->load->view('template', $data);
    }

}