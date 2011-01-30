<?php

class Settings_model extends Model {

    private $_table = 'settings';

    function Settings_model()
    {
        parent::Model();
        $this->load->model('model_model');

    }

    function get_settings()
    {
        return $this->model_model->get($this->_table);
    }

    function get_settings_ids()
    {
        $settings = $this->get_settings();
        foreach($settings as $setting)
        {
            $settings_ids[] = $setting['id_setting'];
        }
        return $settings_ids;
    }

    function update($id_setting, $value)
    {
        $data['value'] = $value;
        return $this->model_model->update($this->_table, $data, array('field'=>'id_setting',
                                                                      'value'=>$id_setting));
    }

}