<?php
class Invoice extends Controller {

    function Invoice()
    {
        parent::Controller();
        check_is_loggedin();
        $this->load->model('invoice_model');
    }

    function index()
    {
        $data['current_amount'] = $this->invoice_model->calculate_current_amount();
        $data['done_amount'] = $this->invoice_model->calculate_done_amount();
        $data['settings'] = $this->settings_model->get_settings();
        $data['template'] = 'invoice_edit';
        $this->load->view('template', $data);
    }

    function create()
    {
        if($this->input->post('ajax') == '1')
        {
            $newInvoice['id_client'] = $this->input->xss_clean($this->input->post('id_client'));
            $newInvoice['subject'] = $this->input->xss_clean($this->input->post('subject'));
            $newInvoice['cost'] = $this->input->xss_clean($this->input->post('cost'));
            $newInvoice['date'] = date("Y-m-d");
            if($this->invoice_model->add_invoice($newInvoice))
            {
                $this->_get_open_invoices();
            }
            else
            {
                echo "FALSE";
            }
        } else { redirect('/', 'refresh'); }
    }

    function close()
    {
        if($this->input->post('ajax') == '1')
        {
            $id_invoice = $this->input->xss_clean($this->input->post('id_invoice'));
            if($this->invoice_model->close_invoice($id_invoice))
            {
                $this->_get_open_invoices();
            }
            else
            {
                "FALSE";
            }
        } else { redirect('/', 'refresh'); }
    }

    function delete()
    {
        if($this->input->post('ajax'))
        {
            $id_invoice = $this->input->xss_clean($this->input->post('id_invoice'));
            if($this->invoice_model->delete($id_invoice))
            {
                $this->_get_open_invoices();
            }
            else
            {
                echo "FALSE";
            }
        } else { redirect('/', 'refresh'); }
    }

    function edit($id_invoice)
    {
        if(isset($id_invoice))
        {
            $data['invoice'] = $this->invoice_model->get_invoice($id_invoice);
            if(is_array($data['invoice']))
            {
                $this->load->model('clients_model');
                $data['clients'] = $this->clients_model->get_clients();
                // - 
                $data['status'] = $this->invoice_model->get_human_status($data['invoice']['id_status']);
                $data['current_amount'] = $this->invoice_model->calculate_current_amount();
                $data['done_amount'] = $this->invoice_model->calculate_done_amount();
                $data['settings'] = $this->settings_model->get_settings();
                $data['template'] = 'invoice_edit';
                $this->load->view('template', $data);
            }
            else
            {
                $this->session->set_flashdata('error', 'Can not edit invoice');
                redirect('/', 'refresh');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'Can not edit invoice');
            redirect('/', 'refresh');
        }
    }

    function update()
    {
        if($this->input->post('submit_invoice_edit'))
        {
            $data['id_invoice'] = $this->input->post('id_invoice');
            $data['cost'] = $this->input->post('cost');
            $data['subject'] = $this->input->post('subject');
            $data['id_client'] = $this->input->post('id_client');
            if($this->invoice_model->update($data, $data['id_invoice']))
            {
                $this->session->set_flashdata('msg','Invoice updated.');
            }
            else
            {
                $this->session->set_flashdata('error','Can not update.');
            }
        }
        redirect('/');
    }

    function _get_open_invoices()
    {
        $data = $this->invoice_model->get_open_invoices();
        if(is_array($data))
        {
           $this->load->view('templates/invoices_open_table', $data);
        }
    }

}