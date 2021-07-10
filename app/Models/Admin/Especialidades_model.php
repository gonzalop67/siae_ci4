<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Especialidades_model extends Model
{
    protected $table      = 'sw_especialidad';
    protected $primaryKey = 'id_especialidad';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['id_tipo_educacion', 'es_nombre', 'es_figura', 'es_abreviatura', 'es_orden'];

    public function listarEspecialidades()
    {
        $especialidades = $this->db->query('
            SELECT e.*, te_nombre
              FROM sw_especialidad e,
                   sw_tipo_educacion t
             WHERE t.id_tipo_educacion = e.id_tipo_educacion
             ORDER BY es_orden
            ');
        return $especialidades->getResult();
    }
    
    public function actualizarOrden($id_especialidad, $es_orden)
    {
      $this->db->query("UPDATE sw_especialidad SET es_orden = $es_orden WHERE id_especialidad = $id_especialidad");
    }
}