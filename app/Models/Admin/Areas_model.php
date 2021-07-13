<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Areas_model extends Model
{

    protected $table      = 'sw_area';
    protected $primaryKey = 'id_area';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['ar_nombre'];

}
