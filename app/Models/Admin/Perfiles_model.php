<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Perfiles_model extends Model
{

    protected $table      = 'sw_perfil';
    protected $primaryKey = 'id_perfil';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['pe_nombre'];

    public function listarPerfiles()
    {
        $Perfiles = $this->db->query('
            SELECT *
              FROM sw_perfil 
             ORDER BY pe_nombre
            ');
        return $Perfiles->getResult();
    }
}
