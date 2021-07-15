<?php 
namespace App\Models\Admin;

use CodeIgniter\Model;

class Periodos_evaluacion_model extends Model{
    protected $table      = 'sw_periodo_evaluacion';
    protected $primaryKey = 'id_periodo_evaluacion';
    
    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = [
        'id_periodo_lectivo',
        'id_tipo_periodo',
        'pe_nombre',
        'pe_abreviatura'
    ];
}