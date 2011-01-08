<?php

class Login_model extends Model {

    function Login_model()
    {
        parent::Model();
    }

    function try_login($user, $pass)
    {
        $pass = md5($pass);
        $this->db->select('password')->from('users')->where('email', $user)->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $result = $query->row_array();
            $confirm_pass = $result['password'];
            $query->free_result();
            if (strcmp($pass, $confirm_pass) == 0)
            {
                return 1;
            } else
            {
                return 0;
            }
        } 
        else
        {
            $query->free_result();
            return 0;
        }
    }

}
