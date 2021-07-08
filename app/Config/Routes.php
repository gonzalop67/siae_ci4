<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('/', function($routes){
	$routes->get('', 'Auth\Login::index', ['as' => 'home']);
});

$routes->group('auth',['namespace' => 'App\Controllers\Auth'], function($routes){
	$routes->post('check', 'Login::signin', ['as' => 'signin']);
	$routes->get('logout', 'Login::signout', ['as' => 'signout']);
	$routes->get('dashboard', 'Login::dashboard', ['as' => 'dashboard']);
});

$routes->group('admin',['namespace' => 'App\Controllers\Admin'], function($routes){
	//RUTAS PARA MODALIDADES
	$routes->get('modalidades', 'Modalidades::index', ['as' => 'modalidades']);
	$routes->get('modalidades/crear', 'Modalidades::create', ['as' => 'modalidades_create']);
	$routes->post('modalidades/guardar', 'Modalidades::store', ['as' => 'modalidades_store']);
	$routes->get('modalidades/editar/(:any)', 'Modalidades::edit/$1', ['as' => 'modalidades_edit']);
	$routes->post('modalidades/actualizar', 'Modalidades::update', ['as' => 'modalidades_update']);
	$routes->get('modalidades/eliminar/(:any)', 'Modalidades::delete/$1', ['as' => 'modalidades_delete']);
	//RUTAS PARA PERIODOS LECTIVOS
	$routes->get('periodos_lectivos', 'Periodos_lectivos::index', ['as' => 'periodos_lectivos']);
	$routes->get('periodos_lectivos/crear', 'Periodos_lectivos::create', ['as' => 'periodos_lectivos_create']);
	//RUTAS PARA PERFILES
	$routes->get('perfiles', 'Perfiles::index', ['as' => 'perfiles']);
	$routes->get('perfiles/crear', 'Perfiles::create', ['as' => 'perfiles_create']);
	$routes->post('perfiles/guardar', 'Perfiles::store', ['as' => 'perfiles_store']);
	$routes->get('perfiles/editar/(:any)', 'Perfiles::edit/$1', ['as' => 'perfiles_edit']);
	$routes->post('perfiles/actualizar', 'Perfiles::update', ['as' => 'perfiles_update']);
	$routes->get('perfiles/eliminar/(:any)', 'Perfiles::delete/$1', ['as' => 'perfiles_delete']);
	//RUTAS PARA MENUS
	$routes->get('menus', 'Menus::index', ['as' => 'menus']);
	$routes->get('menus/crear', 'Menus::create', ['as' => 'menus_create']);
	$routes->post('menus/guardar', 'Menus::store', ['as' => 'menus_store']);
	$routes->post('menus/getMenusByRoleId', 'Menus::getMenusByRoleId', ['as' => 'menus_getByRoleId']);
	$routes->post('menus/getMenusByParentId', 'Menus::getMenusByParentId', ['as' => 'menus_getByParentId']);
	$routes->post('menus/getMenusById', 'Menus::getMenusById', ['as' => 'menus_getById']);
	$routes->post('menus/actualizar', 'Menus::update', ['as' => 'menus_update']);
	$routes->post('menus/saveNewPositions', 'Menus::saveNewPositions', ['as' => 'menus_saveNewPositions']);
	$routes->get('menus/crearSubmenu/(:any)', 'Menus::crearSubmenu/$1', ['as' => 'menus_crearSubmenus']);
	//RUTAS PARA USUARIOS
	$routes->get('usuarios', 'Usuarios::index', ['as' => 'usuarios']);
	$routes->get('usuarios/crear', 'Usuarios::create', ['as' => 'usuarios_create']);
	$routes->post('usuarios/guardar', 'Usuarios::store', ['as' => 'usuarios_store']);
	$routes->get('usuarios/editar/(:any)', 'Usuarios::edit/$1', ['as' => 'usuarios_edit']);
	$routes->post('usuarios/actualizar', 'Usuarios::update', ['as' => 'usuarios_update']);
	$routes->get('usuarios/eliminar/(:any)', 'Usuarios::delete/$1', ['as' => 'usuarios_delete']);
	//RUTAS PARA NIVELES (TIPOS) DE EDUCACION
	$routes->get('tipos_educacion', 'Tipos_educacion::index', ['as' => 'tipos_educacion']);
	$routes->get('tipos_educacion/crear', 'Tipos_educacion::create', ['as' => 'tipos_educacion_create']);
	$routes->post('tipos_educacion/guardar', 'Tipos_educacion::store', ['as' => 'tipos_educacion_store']);
	$routes->get('tipos_educacion/editar/(:any)', 'Tipos_educacion::edit/$1', ['as' => 'tipos_educacion_edit']);
	$routes->post('tipos_educacion/actualizar', 'Tipos_educacion::update', ['as' => 'tipos_educacion_update']);
	$routes->get('tipos_educacion/eliminar/(:any)', 'Tipos_educacion::delete/$1', ['as' => 'tipos_educacion_delete']);
	$routes->post('tipos_educacion/saveNewPositions', 'Tipos_educacion::saveNewPositions', ['as' => 'tipos_educacion_saveNewPositions']);
	//RUTAS PARA ESPECIALIDADES
	$routes->get('especialidades', 'Especialidades::index', ['as' => 'especialidades']);
	$routes->get('especialidades/crear', 'Especialidades::create', ['as' => 'especialidades_create']);
	$routes->post('especialidades/guardar', 'Especialidades::store', ['as' => 'especialidades_store']);
	$routes->get('especialidades/editar/(:any)', 'Especialidades::edit/$1', ['as' => 'especialidades_edit']);
	$routes->post('especialidades/actualizar', 'Especialidades::update', ['as' => 'especialidades_update']);
	$routes->get('especialidades/eliminar/(:any)', 'Especialidades::delete/$1', ['as' => 'especialidades_delete']);
	$routes->post('especialidades/saveNewPositions', 'Especialidades::saveNewPositions', ['as' => 'especialidades_saveNewPositions']);
	//RUTAS PARA CURSOS
	$routes->get('cursos', 'Cursos::index', ['as' => 'cursos']);
	$routes->get('cursos/crear', 'Cursos::create', ['as' => 'cursos_create']);
	$routes->post('cursos/guardar', 'Cursos::store', ['as' => 'cursos_store']);
	$routes->get('cursos/editar/(:any)', 'Cursos::edit/$1', ['as' => 'cursos_edit']);
	$routes->post('cursos/actualizar', 'Cursos::update', ['as' => 'cursos_update']);
	$routes->get('cursos/eliminar/(:any)', 'Cursos::delete/$1', ['as' => 'cursos_delete']);
	$routes->post('cursos/saveNewPositions', 'Cursos::saveNewPositions', ['as' => 'cursos_saveNewPositions']);
	//RUTAS PARA PARALELOS
	$routes->get('paralelos', 'Paralelos::index', ['as' => 'paralelos']);
	$routes->get('paralelos/crear', 'Paralelos::create', ['as' => 'paralelos_create']);
	$routes->post('paralelos/guardar', 'Paralelos::store', ['as' => 'paralelos_store']);
	$routes->get('paralelos/editar/(:any)', 'Paralelos::edit/$1', ['as' => 'paralelos_edit']);
	$routes->post('paralelos/actualizar', 'Paralelos::update', ['as' => 'paralelos_update']);
	$routes->get('paralelos/eliminar/(:any)', 'Paralelos::delete/$1', ['as' => 'paralelos_delete']);
	$routes->post('paralelos/saveNewPositions', 'Paralelos::saveNewPositions', ['as' => 'paralelos_saveNewPositions']);
	//RUTAS PARA AREAS
	$routes->get('areas', 'Areas::index', ['as' => 'areas']);
	$routes->get('areas/crear', 'Areas::create', ['as' => 'areas_create']);
	$routes->post('areas/guardar', 'Areas::store', ['as' => 'areas_store']);
	$routes->get('areas/editar/(:any)', 'Areas::edit/$1', ['as' => 'areas_edit']);
	$routes->post('areas/actualizar', 'Areas::update', ['as' => 'areas_update']);
	$routes->get('areas/eliminar/(:any)', 'Areas::delete/$1', ['as' => 'areas_delete']);
	//RUTAS PARA ASIGNATURAS
	$routes->get('asignaturas', 'Asignaturas::index', ['as' => 'asignaturas']);
	$routes->get('asignaturas/crear', 'Asignaturas::create', ['as' => 'asignaturas_create']);
	$routes->post('asignaturas/guardar', 'Asignaturas::store', ['as' => 'asignaturas_store']);
	$routes->get('asignaturas/editar/(:any)', 'Asignaturas::edit/$1', ['as' => 'asignaturas_edit']);
	$routes->post('asignaturas/actualizar', 'Asignaturas::update', ['as' => 'asignaturas_update']);
	$routes->get('asignaturas/eliminar/(:any)', 'Asignaturas::delete/$1', ['as' => 'asignaturas_delete']);
	//RUTAS PARA PERIODOS DE EVALUACION
	$routes->get('periodos_evaluacion', 'Periodos_evaluacion::index', ['as' => 'periodos_evaluacion']);
	$routes->get('periodos_evaluacion/crear', 'Periodos_evaluacion::create', ['as' => 'periodos_evaluacion_create']);
	$routes->post('periodos_evaluacion/guardar', 'Periodos_evaluacion::store', ['as' => 'periodos_evaluacion_store']);
	$routes->get('periodos_evaluacion/editar/(:any)', 'Periodos_evaluacion::edit/$1', ['as' => 'periodos_evaluacion_edit']);
	$routes->post('periodos_evaluacion/actualizar', 'Periodos_evaluacion::update', ['as' => 'periodos_evaluacion_update']);
	$routes->get('periodos_evaluacion/eliminar/(:any)', 'Periodos_evaluacion::delete/$1', ['as' => 'periodos_evaluacion_delete']);
	//RUTAS PARA APORTES DE EVALUACION
	$routes->get('aportes_evaluacion', 'aportes_evaluacion::index', ['as' => 'aportes_evaluacion']);
	$routes->get('aportes_evaluacion/crear', 'aportes_evaluacion::create', ['as' => 'aportes_evaluacion_create']);
	$routes->post('aportes_evaluacion/guardar', 'aportes_evaluacion::store', ['as' => 'aportes_evaluacion_store']);
	$routes->get('aportes_evaluacion/editar/(:any)', 'aportes_evaluacion::edit/$1', ['as' => 'aportes_evaluacion_edit']);
	$routes->post('aportes_evaluacion/actualizar', 'aportes_evaluacion::update', ['as' => 'aportes_evaluacion_update']);
	$routes->get('aportes_evaluacion/eliminar/(:any)', 'aportes_evaluacion::delete/$1', ['as' => 'aportes_evaluacion_delete']);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
