<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Periodos_lectivos_model extends Model
{

    protected $table      = 'sw_periodo_lectivo';
    protected $primaryKey = 'id_periodo_lectivo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_periodo_estado', 
        'id_modalidad',
        'pe_anio_inicio',
        'pe_anio_fin',
        'pe_fecha_inicio',
        'pe_fecha_fin'
    ];

    public function listarPeriodosLectivos()
    {
        $Periodos_lectivos = $this->db->query('
            SELECT p.*, 
                   pe_descripcion 
              FROM sw_periodo_lectivo p, 
                   sw_periodo_estado pe 
             WHERE pe.id_periodo_estado = p.id_periodo_estado 
             ORDER BY pe_anio_inicio DESC
            ');

        return $Periodos_lectivos->getResult();
    }

    public function getPeriodName($id_periodo)
    {
        $Periodos_lectivos = $this->db->query("
            SELECT pe_anio_inicio,
                   pe_anio_fin 
              FROM sw_periodo_lectivo 
             WHERE id_periodo_lectivo = $id_periodo
            ");

        return $Periodos_lectivos->getResultObject();
    }
}
