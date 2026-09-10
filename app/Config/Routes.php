<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PrintForm::index');

// Form Print QR Code Label
$routes->get('print-form', 'PrintForm::index');
$routes->get('print-form/get-customers', 'PrintForm::getCustomers');
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

// Omron Saved Labels
$routes->get('omron', 'Omron::index');
$routes->get('omron/data/inner', 'Omron::dataInner');
$routes->post('omron/data/outer', 'Omron::dataOuter');
$routes->post('omron/delete-rows', 'Omron::deleteRows');
$routes->post('omron/batch-print', 'Omron::batchPrint');
$routes->get('omron/render-pdf/(:segment)', 'Omron::renderPdf/$1');

// Mitsuba Routes
$routes->get('mitsuba', 'Mitsuba::index');
$routes->post('mitsuba/data', 'Mitsuba::data');
$routes->post('mitsuba/delete-rows', 'Mitsuba::deleteRows');
$routes->post('mitsuba/batch-print', 'Mitsuba::batchPrint');
$routes->get('mitsuba/render-pdf/(:segment)', 'Mitsuba::renderPdf/$1');
