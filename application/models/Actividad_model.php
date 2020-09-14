<?php
    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Actividad_model extends CI_Model
    {
        public function actividad()
        {
            $query = $this->db->select('*')
               ->get('actividad')
               ->result();
            return $query;
        }

     
        public function veractividad($id)
        {
            return $this->db->where('actividad', $id)
                        ->get('actividad')
                        ->row();
        }

        public function guardar($id, $data)
        {
            if ($id) {
                $this->db->where('actividad', $id);
                $this->db->update('actividad', $data);
                return $id['actividad'];
            } else {
                $this->db->insert('actividad', $data);
                return $this->db->insert_id();
            }
        }
        public function eliminar_actividad($id)
        {
            $this->db->where('actividad', $id);
            $this->db->delete('actividad');
        }
    }
    /* End of file ModelName.php */
