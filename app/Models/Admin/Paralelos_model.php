<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Paralelos_model extends Model
{
    protected $table      = 'sw_paralelo';
    protected $primaryKey = 'id_paralelo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['id_periodo_lectivo', 'id_curso', 'id_jornada', 'pa_nombre', 'pa_orden'];

    public function actualizarOrden($id_paralelo, $pa_orden)
    {
      $this->db->query("UPDATE sw_paralelo SET pa_orden = $pa_orden WHERE id_paralelo = $id_paralelo");
    }
}