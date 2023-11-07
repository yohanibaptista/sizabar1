<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
// $routes->get('/jasa', 'Jasa::index');
// $routes->get('/jasa/create', 'Jasa::create');
// $routes->post('/jasa/create', 'Jasa::save');
// $routes->post('/jasa/edit/(:any)', 'Jasa::edit/$1');
// $routes->get('/jasa/(:any)', 'Jasa::detail/$1');
$routes->group('jasa', function ($r) {
    $r->get('/', 'Jasa::index');
    $r->get('create', 'Jasa::create');
    $r->post('create', 'Jasa::save');
    $r->get('edit/(:any)', 'Jasa::edit/$1');
    $r->post('edit/(:any)', 'Jasa::update/$1');
    $r->delete('(:num)', 'Jasa::delete/$1');
    $r->get(
        '(:any)',
        'Jasa::detail/$1'
    );
});

$routes->group('barang', function ($r) {
    $r->get('/', 'Barang::index');
    $r->get('create', 'Barang::create');
    $r->post('create', 'Barang::save');
    $r->get('edit/(:any)', 'Barang::edit/$1');
    $r->post('edit/(:any)', 'Barang::update/$1');
    $r->delete('(:num)', 'Barang::delete/$1');
    $r->get(
        '(:any)',
        'Barang::detail/$1'
    );
});

$routes->get('/login', 'Auth::indexlogin');
$routes->post('/login/auth', 'Auth::auth');
$routes->get('/register', 'Auth::indexregister');
$routes->post('/login/save', 'Auth::saveRegister');
$routes->get('/logout', 'Auth::logout');
