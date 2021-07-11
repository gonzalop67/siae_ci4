<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Cursos_model extends Model
{
    protected $table      = 'sw_curso';
    protected $primaryKey = 'id_curso';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['id_curso', 'id_especialidad', 'id_curso_superior', 'cu_nombre', 'cu_shortname', 'cu_abreviatura', 'cu_orden', 'quien_inserta_comp'];

    public function actualizarOrden($id_curso, $cu_orden)
    {
      $this->db->query("UPDATE sw_curso SET cu_orden = $cu_orden WHERE id_curso = $id_curso");
    }
}