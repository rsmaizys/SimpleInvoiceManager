<?php
$this->load->view('header');
if($this->session->flashdata('msg'))
{
    echo '<div class="success">'.$this->session->flashdata('msg').'</div><br />';
} else if($this->session->flashdata('error'))
    {
        echo '<div class="error">'.$this->session->flashdata('error').'</div><br />';
    }
$this->load->view('templates/'.$template);
$this->load->view('footer');
?>