<?php

class Clients_model extends Model {

    private $_table = 'clients';

    function Clients_model()
    {
        parent::Model();
        $this->load->model('model_model');
    }

    function get_clients()
    {
        return $this->model_model->get($this->_table);
    }

    function add_new($data)
    {
        return $this->model_model->insert($this->_table, $data);
    }

    function delete($id_client)
    {
        return $this->model_model->delete($this->_table,
                                          array('field'=>'id_client', 'value'=>$id_client));
    }

    function get_client_name($id_client)
    {
        $client_info = $this->model_model->get_row($this->_table, array('field'=>'id_client',
                                                                    'value'=>$id_client));

        return $client_info['name'];
    }

}