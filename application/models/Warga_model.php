<?php

class Warga_model extends CI_Model
{
    public function getWarga($id = null)
    {
        if ($id === null) {
            return $this->db->get('warga')->result_array();
        } else {
            return $this->db->get_where('warga', ['id' => $id])->result_array();
        }
    }

    public function createWarga($data)
    {
        $this->db->insert('warga', $data);
        return $this->db->affected_rows();
    }

    public function updateWarga($data, $id)
    {
        $this->db->update('warga', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteWarga($id)
    {
        $this->db->delete('warga', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
