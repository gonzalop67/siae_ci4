<?php 
namespace App\Models\Admin;

use CodeIgniter\Model;

class Tipos_educacion_model extends Model{
    protected $table      = 'sw_tipo_educacion';
    protected $primaryKey = 'id_tipo_educacion';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['te_nombre', 'te_bachillerato', 'te_orden'];

    public function actualizarOrden($id_tipo_educacion, $te_orden)
    {
      $this->db->query("UPDATE sw_tipo_educacion SET te_orden = $te_orden WHERE id_tipo_educacion = $id_tipo_educacion");
    }
  
}