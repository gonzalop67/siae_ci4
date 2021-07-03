<?php 
    namespace App\Models\Admin;

    use CodeIgniter\Model;
    
    class Institucion_model extends Model {

        public function obtenerDatos()
        {
            $nombreInstitucion = $this->db->query('
            SELECT *
              FROM sw_institucion 
             WHERE id_institucion = 1
            ');
            
            return $nombreInstitucion->getResultObject();
        }

    }