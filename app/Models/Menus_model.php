<?php

namespace App\Models;

use CodeIgniter\Model;

class Menus_model extends Model
{

  protected $table      = 'sw_menu';
  protected $primaryKey = 'id_menu';

  protected $useAutoIncrement = true;

  protected $allowedFields = ['mnu_texto', 'mnu_link', 'mnu_nivel', 'mnu_orden', 'mnu_padre', 'mnu_publicado', 'mnu_icono'];

  public function listarMenusNivel1($id_perfil)
  {
    $menus = $this->db->query("
    SELECT m.*
      FROM sw_menu m,
           sw_menu_perfil mp 
     WHERE m.id_menu = mp.id_menu
       AND mp.id_perfil = $id_perfil 
       AND mnu_padre = 0
     ORDER BY mnu_orden              
    ");

    return $menus->getResultObject();
  }

  public function listarMenusHijos($mnu_padre)
  {
    $menus = $this->db->query("
    SELECT *
      FROM sw_menu
     WHERE mnu_padre = $mnu_padre
     ORDER BY mnu_orden
    ");

    return $menus->getResult();
  }

  public function getMenusById($id_menu)
  {
    $menus = $this->db->query("
    SELECT *
      FROM sw_menu
     WHERE id_menu = $id_menu
    ");

    return $menus->getRow();
  }

  public function actualizarOrden($id_menu, $mnu_orden)
  {
    $this->db->query("UPDATE sw_menu SET mnu_orden = $mnu_orden WHERE id_menu = $id_menu");
  }

  public function crearMenu($data, $id_perfil)
  {
    try {
      $this->insert($data);
      $id_menu = $this->insertID();
      $menu_perfil_model = model('Menus_perfiles_model');
      $menu_perfil_model->save([
        'id_menu'   => $id_menu,
        'id_perfil' => $id_perfil
      ]);
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

}