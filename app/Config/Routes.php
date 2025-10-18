<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('listar/clientes', 'AveriasController::listarClientes');
$routes->get('listar/tecnicos', 'AveriasController::listarTecnicos');
$routes->get('averias/solucionar/(:num)', 'AveriasController::solucionar/$1');
$routes->post('guardar', 'AveriasController::guardar');
$routes->get('registrar', 'AveriasController::registrar');



