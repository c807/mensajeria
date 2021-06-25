<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Conf_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
      
        if (isset($_SESSION['pais_id'])) {
            $this->pais = $_SESSION['pais_id'];
        } else {
            $this->pais = 0;
        }
    }

    public function proceso()
    {
        $query = $this->db->select('id,nombre')
            ->get('gacela.proceso')
            ->result();
        return $query;
    }

    public function colaborador()
    {
        $query = $this->db->select('usuario,nombre')
            ->where('pais_empresa_id', $this->pais)
            ->where('inactivo', 0)
            ->get('csd.usuario')
            ->result();
        return $query;
    }

    public function prioridad()
    {
        $query = $this->db->select('*')
            ->get('prioridad')
            ->result();
        return $query;
    }

    public function actividad()
    {
        $query = $this->db->select('*')
            ->where('estado', 1)
            ->get('actividad')
            ->result();
        return $query;
    }

    public function mensajero()
    {
        $query = $this->db->select('*')
            ->where('estado', 1)
            ->get('mensajero')
            ->result();
        return $query;
    }

    public function tipo()
    {
        $query = $this->db->select('*')
            ->get('tipo')
            ->result();
        return $query;
    }

    public function ruta()
    {
        $query = $this->db->select('*')
            ->where('estado', 1)
            ->get('ruta')
            ->result();
        return $query;
    }

    public function turno()
    {
        $query = $this->db->select('*')
            ->get('turno')
            ->result();
        return $query;
    }

    public function dtusuario($id)
    {
        $user = $this->db->select("usuario,	nombre,	mail")
            ->where('usuario', $id)
            ->get('csd.usuario')
            ->row();

        return $user;
    }

    public function zona()
    {
        $query = $this->db->select('*')
            ->get('zona')
            ->result();
        return $query;
    }

    public function estatus()
    {
        $query = $this->db->select('*')
            ->where('mostrar', 1)
            ->get('estatus')
            ->result();
        return $query;
    }

    
    public function mensajero_all()
    {
        $query = $this->db->select('*')
            ->get('mensajero')
            ->result();
        return $query;
    }
}
    
    /* End of file Conf_model.php */
