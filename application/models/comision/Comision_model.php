<?php
    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Comision_model extends CI_Model
    {

        public function listado_comisiones($desde, $hasta, $mensajero)
        {
            
            if ($mensajero==0) {
                $query = $this->db
                ->select('so.*, co.usuario, co.nombre solicitado_por, co.nombre recibidopor,co.nombre solicitado_por, co.nombre liquidadapor,  po.nombre proceso, pr.descripcion nombre_prioridad, es.descripcion nombre_estatus, ac.descripcion nombre_actividad, me.nombre nombre_mensajero')
                ->join('csd.usuario co', 'co.usuario = so.usuario', 'inner')
                ->join('csd.departamento po', 'po.departamento = so.idproceso', 'inner')
                ->join('prioridad pr', 'pr.prioridad = so.prioridad', 'inner')
                ->join('estatus es', 'es.estatus = so.estatus', 'inner')
                ->join('actividad ac', 'ac.actividad = so.actividad', 'inner')
                ->join('mensajero me', 'me.mensajero = so.mensajero', 'inner')
                ->where("creacion BETWEEN '{$desde}' AND '{$hasta}'")
                ->order_by('so.mensajero', 'ASC')
                ->get('solicitud so')
                ->result();
                return $query;
            }else{
                $query = $this->db
                ->select('so.*, co.usuario, co.nombre solicitado_por, co.nombre recibidopor,co.nombre solicitado_por, co.nombre liquidadapor,  po.nombre proceso, pr.descripcion nombre_prioridad, es.descripcion nombre_estatus, ac.descripcion nombre_actividad, me.nombre nombre_mensajero')
                ->join('csd.usuario co', 'co.usuario = so.usuario', 'inner')
                ->join('csd.departamento po', 'po.departamento = so.idproceso', 'inner')
                ->join('prioridad pr', 'pr.prioridad = so.prioridad', 'inner')
                ->join('estatus es', 'es.estatus = so.estatus', 'inner')
                ->join('actividad ac', 'ac.actividad = so.actividad', 'inner')
                ->join('mensajero me', 'me.mensajero = so.mensajero', 'inner')
                ->where('so.mensajero', $mensajero)
                ->where("creacion BETWEEN '{$desde}' AND '{$hasta}'")
                ->order_by('so.mensajero', 'ASC')
                ->get('solicitud so')
                ->result();
                return $query;
            }
          
        }

        public function listadomensajero($desde, $hasta, $mensajero){
            
            if ($mensajero==0) {
                $query = $this->db
                ->select('so.mensajero,me.nombre nombre_mensajero')
                ->join('mensajero me', 'me.mensajero = so.mensajero', 'inner')
                ->where("creacion BETWEEN '{$desde}' AND '{$hasta}'")
                ->group_by('so.mensajero')
                ->order_by('so.mensajero', 'ASC')
                ->get('solicitud so')
                ->result();
                return $query;
            }else{
                $query = $this->db
                ->select('so.mensajero,me.nombre nombre_mensajero')
                ->join('mensajero me', 'me.mensajero = so.mensajero', 'inner')
                ->where("creacion BETWEEN '{$desde}' AND '{$hasta}'")
                ->where("so.mensajero",$mensajero)
                ->group_by('so.mensajero')
                ->order_by('so.mensajero', 'ASC')
                ->get('solicitud so')
                ->result();
                return $query;
            }
           
        }

        public function autoriza_pago($data)
        {
            $this->db
            ->set('valor_comision', $data['valor_comision'])
            ->set('aplica_comision', $data['aplica_comision'])
            ->where('solicitud', $data['solicitud'])
            ->update('solicitud');
            return ($this->db->affected_rows() > 0);
        }
        public function agregar_detalle($data)
        {
            $this->db
            ->set('valor_comision', $data['valor_comision'])
            ->set('aplica_comision', $data['aplica_comision'])
            ->set('detalle', $data['detalle'])
            ->where('solicitud', $data['solicitud'])
            ->update('solicitud');
            return ($this->db->affected_rows() > 0);
        }

        
        


       
    }
    /* End of file ModelName.php */
