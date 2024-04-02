<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\ProdukController;

/**
 * @var RouteCollection $routes
 */
//PRODUK
$routes->resource('produk', ['controller' => 'ProdukController']);
$routes->match(['post', 'options'], 'create/produk', 'ProdukController::create');
$routes->match(['put', 'options'], 'update/produk/(:segment)', 'ProdukController::edit/$1');
$routes->match(['delete', 'options'], 'delete/produk/(:segment)', 'ProdukController::delete/$1');

//TAMBAH ANGGOTA


$routes->resource('tambah_anggota', ['controller' => 'AnggotaController']);

$routes->match(['post', 'options'], 'create/anggota', 'AnggotaController::create');
$routes->match(['put', 'options'], 'update/anggota/(:segment)', 'AnggotaController::edit/$1');
$routes->match(['delete', 'options'], 'delete/anggota/(:segment)', 'AnggotaController::delete/$1');





