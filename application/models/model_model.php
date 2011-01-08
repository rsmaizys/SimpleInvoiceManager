<?php

class Model_model extends Model {

    function Model_model()
    {
        parent::Model();
    }

   function insert($table, $data)
    {
        $this->db->insert($this->db->escape_str($table), $data);
        return $this->db->affected_rows();
    }

    function update($table, $data, $where)
    {
        $this->db->where($where['field'], $where['value']);
        $this->db->update($this->db->escape_str($table), $data);
        return $this->db->affected_rows();
    }

    function delete($table, $where)
    {
        $this->db->delete($table, array($where['field']=>$where['value']));
        return $this->db->affected_rows();
    }
    
    function get($table, $where = '', $order_by = '', $limit = '', $offset = '')
    {
        if($order_by != '')
        {
            $this->db->orderby($order_by['field'], $order_by['how']);
        }
        if($limit != '' && $offset != '' && $where != '')
        {
            $query = $this->db->get_where($table, array($where['field']=>$where['value']), $limit, $offset);
        }
        else if($where != '')
            {
                $query = $this->db->get_where($table, array($where['field']=>$where['value']));
            }
            else
            {
                $query = $this->db->get($table);
            }
       if($query->num_rows() > 0)
       {
           foreach($query->result_array() as $row)
           {
               $data[] = $row;
           }
           $query->free_result();
           return $data;
       }
       else
       {
            $query->free_result();
            return 0;
       }
    }

    function get_row($table, $where)
    {
        $query = $this->db->get_where($table, array($where['field']=>$where['value']));
        if($query->num_rows() > 0)
        {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        else
        {
            $query->free_result();
            return 0;
        }
    }
    

}