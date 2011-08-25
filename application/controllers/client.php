<?php
class Client extends Controller {

    function Client()
    {
        parent::Controller();
        check_is_loggedin();
        $this->load->model('clients_model');
        $this->load->model('invoice_model');
    }

    function index()
    {
        $data['template'] = 'clients_add';
        $data['clients'] = $this->clients_model->get_clients();
        $data['current_amount'] = $this->invoice_model->calculate_current_amount();
        $data['done_amount'] = $this->invoice_model->calculate_done_amount();
        $data['settings'] = $this->settings_model->get_settings();
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
    
    function view($id_client)
    {
        if(isset($id_client) && $id_client != "")
        {
            $data['template'] = 'client_view';
            $data['client'] = $this->clients_model->get_client($id_client);
            $data['client']['comments'] = $this->clients_model->get_client_comments($id_client);
                        
            $client_invoices = $this->invoice_model->get_client_invoices($id_client);
            $data['client']['income'] = $this->_get_invoices_income($client_invoices, '2');           
            $data['client']['ongoing'] = $this->_get_invoices_income($client_invoices, '1');            
            
            $data['current_amount'] = $this->invoice_model->calculate_current_amount();
            $data['done_amount'] = $this->invoice_model->calculate_done_amount();
            $data['settings'] = $this->settings_model->get_settings();
            $this->load->view('template', $data);            
        } else { redirect('/client'); }
    }
    
    function addcomment()
    {
        if($this->input->post('ajax'))
        {
            $fields = array("id_client", "comment");
            foreach($fields as $field)
            {
                if($this->input->post($field))
                {
                    $data[$field] = $this->input->post($field);
                }
            }
            if($this->clients_model->add_new_comment($data))
            {
                echo "TRUE";
            }
            else
            {
                echo "FALSE";
            }
        } else { redirect('/', 'refresh'); }

    }
    
    function _get_invoices_income($invoices, $status)
    {
        $result = (int) 0;
        foreach($invoices as $invoice)
        {
            if($invoice['id_status'] == $status)
            {
                $result = $result + $invoice['cost'];
            }
        }
        return $result;
    }
    

}
