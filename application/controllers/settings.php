<?php

class Settings extends Controller {

    function Settings()
    {
        parent::Controller();
        check_is_loggedin();
        $this->load->model('settings_model');
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
            $errors = array();
            foreach($settings_ids as $id_setting)
            {
                $newValue = $this->input->xss_clean($this->input->post($id_setting));
                if(!$this->settings_model->update($id_setting, $newValue))
                {
                    $errors[] = $id_setting;
                } 
            }
            if(is_array($errors) AND (count($errors) >= 1))
            {
                $errors_ids = (string) '';
                foreach($errors as $error_id)
                {
                    $errors_ids .= $error_id.', ';
                }
                $this->session->set_flashdata('error', 'Could not save settings: '.$errors_ids);
                $this->session->set_flashdata('msg', 'All settings updated');
            }
            else
            {
                $this->session->set_flashdata('msg', 'All settings updated');
            }
            redirect('/settings', 'refresh');
        }
        redirect('/', 'refresh');
    }

}
