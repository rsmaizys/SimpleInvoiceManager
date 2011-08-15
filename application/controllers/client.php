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

}
