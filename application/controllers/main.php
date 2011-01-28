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
        $data['template'] = 'main';
        $data['invoices'] = $this->invoice_model->get_invoices();
        foreach($data['invoices'] as &$invoice)
        {
           $invoice['id_status'] = $this->invoice_model->get_human_status($invoice['id_status']);
           $invoice['id_client'] = $this->clients_model->get_client_name($invoice['id_client']);
        }
        $data['clients'] = $this->clients_model->get_clients();
        $data['current_amount'] = $this->invoice_model->calculate_current_amount();
        $data['done_amount'] = $this->invoice_model->calculate_done_amount();
        $this->load->view('template', $data);
    }
}