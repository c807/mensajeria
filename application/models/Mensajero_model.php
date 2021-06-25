<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mensajero_model extends CI_Model
{
    public function mensajeros()
    {
        $query = $this->db->select('*')
            ->where('estado', 1)
            ->get('mensajero')
            ->result();
        return $query;
    }


    public function vermensajero($id)
    {
        return $this->db->where('mensajero', $id)
            ->get('mensajero')
            ->row();
    }

    public function guardar($id, $data)
    {
        if ($id) {
            $this->db->where('mensajero', $id);
            $this->db->update('mensajero', $data);
            return $id['mensajero'];
        } else {
            $this->db->insert('mensajero', $data);
            return $this->db->insert_id();
        }
    }
    public function eliminar_mensajero($id)
    {
        $this->db
            ->set('estado', 0)
            ->where('mensajero', $id)
            ->update('mensajero');
    }
}
    /* End of file ModelName.php */
