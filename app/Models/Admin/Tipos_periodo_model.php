<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Tipos_periodo_model extends Model
{

    protected $table      = 'sw_tipo_periodo';
    protected $primaryKey = 'id_tipo_periodo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['tp_descripcion'];

}
