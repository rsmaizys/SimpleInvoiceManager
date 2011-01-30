<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function check_is_loggedin()
    {
        $ci =& get_instance();
        if(!$ci->session->userdata('status'))
        {
            redirect('/login');
        }
    }
}
?>