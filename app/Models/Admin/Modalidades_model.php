<?php
    namespace App\Models\Admin;

    use CodeIgniter\Model;

    class Modalidades_model extends Model
    {
        protected $table      = 'sw_modalidad';
        protected $primaryKey = 'id_modalidad';

        protected $useAutoIncrement = true;

        protected $returnType     = 'object';

        protected $allowedFields = ['mo_nombre', 'mo_activo'];
    }
