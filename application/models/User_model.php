<?php

class User_model extends CI_Model
{
    public function getUser($id = null)
    {
        if ($id === null) {
            return $this->db->get('user')->result_array();
        } else {
            return $this->db->get_where('user', ['id' => $id])->result_array();
        }
    }

    public function createUser($data)
    {
        $this->db->insert('user', $data);
        return $this->db->affected_rows();
    }
}
