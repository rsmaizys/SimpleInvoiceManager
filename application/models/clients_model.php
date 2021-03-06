<?php

class Clients_model extends Model {

    private $_table = 'clients';
    private $_comments_table = 'clients_comments';

    function Clients_model()
    {
        parent::Model();
        $this->load->model('model_model');
    }

    function get_clients()
    {
        return $this->model_model->get($this->_table);
    }
    
    function get_client($id_client)
    {
        $result =  $this->model_model->get($this->_table, array('field'=>'id_client', 'value'=>$id_client));
        return $result[0];
    }
    
    function get_client_comments($id_client)
    {
        return $this->model_model->get($this->_comments_table, array('field'=>'id_client', 'value'=>$id_client));        
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
    
    function add_new_comment($data)
    {
        return $this->model_model->insert($this->_comments_table, $data);
    }
    
    function delete_comment($id_comment)
    {
        return $this->model_model->delete($this->_comments_table,
                                          array('field'=>'id_client_comment', 'value'=>$id_comment));
    }

}