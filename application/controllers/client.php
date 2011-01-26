<?php

class Client extends Controller {


    function Client()
    {
        parent::Controller();
        $this->load->model('clients_model');
        if(!$this->session->userdata('status'))
        {
            redirect('/login');
        }
    }

    function index()
    {
        $data['template'] = 'clients_add';
        $data['clients'] = $this->clients_model->get_clients();
        $data['current_amount'] = $this->invoice_model->calculate_current_amount();
        $data['done_amount'] = $this->invoice_model->calculate_done_amount();
        $this->load->view('template', $data);
    }

    function add()
    {
        if($this->input->post('submit_clients'))
        {
            $data['name'] = $this->input->xss_clean($this->input->post('client_name'));
            if($this->clients_model->add_new($data))
            {
                $this->session->set_flashdata('msg', 'Done');
            }
            else
            {
                $this->session->set_flashdata('error', 'Can not create client');
            }
        }
        redirect('/client');
    }

    function delete($id)
    {
        if(isset($id))
        {
            if($this->clients_model->delete($id))
            {
                $this->session->set_flashdata('msg', 'Done');
            }
            else
            {
                $this->session->set_flashdata('error', 'Can not delete client');
            }
        }
        redirect('/client');
    }

}
