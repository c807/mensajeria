<?php
    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Ruta_model extends CI_Model
    {
        public function rutas()
        {
            $query = $this->db->select('*')
               ->where('estado',1)
               ->get('ruta')
               ->result();
            return $query;
        }

     
        public function ver_ruta($id)
        {
            return $this->db->where('idruta', $id)
                        ->get('ruta')
                        ->row();
        }

        public function guardar($id, $data)
        {
            if ($id) {
                $this->db->where('idruta', $id);
                $this->db->update('ruta', $data);
                return $id['ruta'];
            } else {
                $this->db->insert('ruta', $data);
                return $this->db->insert_id();
            }
        }
        public function eliminar_ruta($id)
        {
            $this->db
            ->set('estado', 0)
            ->where('idruta', $id)
            ->update('ruta');
        }
    }
    /* End of file ModelName.php */
