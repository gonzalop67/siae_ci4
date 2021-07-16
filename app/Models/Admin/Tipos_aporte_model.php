<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Tipos_aporte_model extends Model
{

    protected $table      = 'sw_tipo_aporte';
    protected $primaryKey = 'id_tipo_aporte';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['ta_descripcion'];

}
