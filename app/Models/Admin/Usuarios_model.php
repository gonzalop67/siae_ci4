<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Usuarios_model extends Model
{

    protected $table      = 'sw_usuario';
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = [
        'us_titulo',
        'us_apellidos',
        'us_nombres',
        'us_shortname',
        'us_fullname',
        'us_login',
        'us_password',
        'us_foto',
        'us_genero',
        'us_activo'
    ];

    public function login($login, $clave, $id_perfil)
    {

        $usuario = $this->db->query("
            SELECT up.id_usuario,
                   SUBSTRING_INDEX(us_apellidos, ' ', 1) AS primer_apellido, 
                   SUBSTRING_INDEX(us_nombres, ' ', 1) AS primer_nombre,
                   us_foto,
                   us_genero,
                   us_password,
                   p.id_perfil,
                   pe_nombre
              FROM sw_usuario_perfil up, 
                   sw_usuario u,
                   sw_perfil p
             WHERE u.id_usuario = up.id_usuario
               AND p.id_perfil = up.id_perfil
               AND us_login = '$login'
               AND p.id_perfil = $id_perfil
            ");

        $resultado = $usuario->getResultArray();
        return $resultado;
    }

}
