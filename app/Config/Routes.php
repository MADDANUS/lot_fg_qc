<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PrintForm::index');

// Form Print QR Code Label
$routes->get('print-form', 'PrintForm::index');
$routes->post('print-form/search-doc', 'PrintForm::searchDoc');
$routes->post('print-form/store', 'PrintForm::store');
$routes->get('print-form/preview/(:segment)', 'PrintForm::preview/$1');
$routes->get('print-form/print/(:segment)', 'PrintForm::printLabel/$1');
$routes->get('print-form/download/(:segment)', 'PrintForm::download/$1');

// Master Data (Shift, Line, Mold, Cavity)
$routes->get('master', 'Master::index');
$routes->get('master/list/(:alpha)', 'Master::list/$1');
$routes->post('master/save/(:alpha)', 'Master::save/$1');
$routes->post('master/delete/(:alpha)/(:any)', 'Master::delete/$1/$2');
