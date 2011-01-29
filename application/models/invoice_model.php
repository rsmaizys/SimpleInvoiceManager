<?php

class Invoice_model extends Model {

    public $table = 'invoices';

    function Invoice_model()
    {
        parent::Model();
        $this->load->model('model_model');
        // This is called in other to call another model in this models method
        // -- it's a walk away to the problem for now.
        $this->ci = & get_instance();
    }

    function add_invoice($data)
    {
        return $this->model_model->insert($this->table, $data);
    }

    function get_invoice($id_invoice)
    {
        return $this->model_model->get_row($this->table, array('field'=>'id_invoice',
                                                             'value'=>$id_invoice));
    }

    function get_invoices()
    {
        return $this->model_model->get($this->table,
                                       array('field'=>'id_status', 'value'=>'1'),
                                       array('field'=>'id_invoice','how'=>'DESC'));
    }

    function close_invoice($id_invoice)
    {
        return $this->model_model->update($this->table,
                                          array('id_status'=>'2'),
                                          array('field'=>'id_invoice', 'value'=>$id_invoice));
    }

    function delete($id_invoice)
    {
        return $this->model_model->delete($this->table,
                                          array('field'=>'id_invoice', 'value'=>$id_invoice));
    }

    function get_human_status($id_status)
    {
        $status_info = $this->model_model->get_row('status', array('field'=>'id_status',
                                                                   'value'=>$id_status));

        return $status_info['name'];
    }

    function update($data, $id_invoice)
    {
        return $this->model_model->update($this->table, $data, array('field'=>'id_invoice',
                                                                   'value'=>$id_invoice));
    }

    function calculate_current_amount()
    {
        $data = $this->get_invoices();
        $sum = (int) 0;
        foreach($data as $item)
        {
            $sum += $item['cost'];
        }
        return $sum;
    }

    function calculate_done_amount()
    {
        $data = $this->model_model->get($this->table,
                                       array('field'=>'id_status', 'value'=>'2'),
                                       array('field'=>'id_invoice','how'=>'DESC'));
        $sum = (int) 0;
        foreach($data as $item)
        {
            $sum += $item['cost'];
        }
        return $sum;
    }

    function get_open_invoices()
    {
        $this->load->model('clients_model');
        $data['invoices'] = $this->get_invoices();
        foreach($data['invoices'] as &$invoice)
        {
           $invoice['id_status'] = $this->get_human_status($invoice['id_status']);
           $invoice['id_client'] = $this->ci->clients_model->get_client_name($invoice['id_client']);
        }
        return $data;
    }

}