<?php

class Settings extends Controller {

    function Settings()
    {
        parent::Controller();
        $this->load->model('settings_model');
        check_is_loggedin();
    }

    function index()
    {
        $data['template'] = 'settings';
        $data['settings'] = $this->settings_model->get_settings();
        $this->load->view('template', $data);
    }

    function update()
    {
        if($this->input->post('submit_settings_update'))
        {
            $settings_ids = $this->settings_model->get_settings_ids();
            foreach($settings_ids as $id_setting)
            {
                $newValue = $this->input->xss_clean($this->input->post($id_setting));
                $errors = array();
                if(!$this->settings_model->update($id_setting, $newValue))
                {
                    $errors[] = $id_setting;
                } 
            }
            if(is_array($errors) && count($errors) > 0)
            {
                $this->session->set_flashdata('msg', 'All settings updated');
            }
            else
            {
                $errors_ids = (string) '';
                foreach($errors as $error_id)
                {
                    $errors_ids .= $error_id.', ';
                }
                $this->session->set_flashdata('error', 'Could not save settings: '.$errors_ids);
            }
            redirect('/settings', 'refresh');
        }
        redirect('/', 'refresh');
    }

}
