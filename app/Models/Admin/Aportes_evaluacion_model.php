<?php 
namespace App\Models\Admin;

use CodeIgniter\Model;

class Aportes_evaluacion_model extends Model{
    protected $table      = 'sw_aporte_evaluacion';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_aporte_evaluacion';
    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['id_periodo_evaluacion', 'id_tipo_aporte', 'ap_nombre', 'ap_abreviatura', 'ap_shortname', 'ap_fecha_apertura', 'ap_fecha_cierre'];
}