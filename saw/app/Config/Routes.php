<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

$routes->get('login', 'Login::index');
$routes->post('login/cek', 'Login::cek');
$routes->get('logout', 'Login::logout');

$routes->get('register', 'Register::index');
$routes->post('register', 'Register::index');

$routes->group('kriteria', ['filter' => 'loginfilter'], function ($routes) {
    $routes->get('/', 'Kriteria::index');
    $routes->add('tambah', 'Kriteria::tambah');
    $routes->add('ubah/(:num)', 'Kriteria::ubah/$1');
    $routes->get('hapus/(:num)', 'Kriteria::hapus/$1');
});

$routes->group('subkriteria', ['filter' => 'loginfilter'], function ($routes) {
    $routes->get('(:num)', 'Subkriteria::index/$1');
    $routes->add('tambah/(:num)', 'Subkriteria::tambah/$1');
    $routes->add('ubah/(:num)/(:num)', 'Subkriteria::ubah/$1/$2');
    $routes->get('hapus/(:num)/(:num)', 'Subkriteria::hapus/$1/$2');
});

$routes->group('alternatif', ['filter' => 'loginfilter'], function ($routes) {
    $routes->get('/', 'Alternatif::index');
    $routes->add('tambah', 'Alternatif::tambah');
    $routes->add('ubah/(:num)', 'Alternatif::ubah/$1');
    $routes->get('hapus/(:num)', 'Alternatif::hapus/$1');
    $routes->get('detail/(:num)', 'Alternatif::detail/$1');
});

$routes->group('pengguna', ['filter' => 'loginfilter'], function ($routes) {
    $routes->get('/', 'Pengguna::index');
    $routes->add('tambah', 'Pengguna::tambah');
    $routes->add('ubah/(:num)', 'Pengguna::ubah/$1');
    $routes->get('hapus/(:num)', 'Pengguna::hapus/$1');
});

$routes->add('password', 'Pengguna::password', ['filter' => 'loginfilter']);

$routes->get('penilaian', 'Penilaian::index', ['filter' => 'loginfilter']);

$routes->get('laporan', 'Laporan::index', ['filter' => 'loginfilter']);
$routes->get('laporan/pdf', 'Laporan::pdf', ['filter' => 'loginfilter']);

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
