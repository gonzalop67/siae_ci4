<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Jornadas_model extends Model
{
    protected $table      = 'sw_jornada';
    protected $primaryKey = 'id_jornada';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['jo_nombre'];
}