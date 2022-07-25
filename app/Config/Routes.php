<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

use App\Controllers\Api\V1\AuthController;

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
/* Ruta de loggin */

$routes->get('/Productos/selectExel', 'Producto::selectExel');

/** Rotas Administrativas logeadas */


    $routes->get('/administrador', 'Administrador::index');


    /** Caja */

    $routes->get('/Caja', 'Caja::index');

    /** Categoria */

    $routes->get('/Categorias', 'Categoria::index');
    $routes->get('/Categorias/selectApi', 'Categoria::selectCategoriasApi');
    $routes->get('/Categorias/select', 'Categoria::selectCategorias');
    $routes->get('/Categorias/update/(:num)', 'Categoria::selectCategoriaId/$1');
    $routes->get('/Categorias/updateApi/(:num)', 'Categoria::selectCategoriaIdApi/$1');
    $routes->post('/Categorias/store', 'Categoria::store');
    $routes->post('/Categorias/datoUpdate', 'Categoria::update');
    $routes->post('/Categorias/delete', 'Categoria::deleteCategoria');
    $routes->get('/Categorias/selectEstado1', 'Categoria::selectCategoriasEstado1');

    /** Productos */

    $routes->get('/Productos', 'Producto::index');
    $routes->get('/Productos/crearCodigo/(:num)', 'Producto::crearCodigoProducto/$1');
    $routes->get('/Productos/select', 'Producto::select');
    $routes->post('/Productos/store', 'Producto::store');
    $routes->post('/Productos/delete', 'Producto::deleteProducto');
    $routes->get('/Productos/update/(:num)', 'Producto::productoUpdate/$1');
    $routes->post('/Productos/updateDato', 'Producto::updateDatos');
    $routes->get('/Productos/productosActivos', 'Producto::productoActivos');

    /**Reportes  */


    $routes->get('/Reporte/ventas', 'Reporte::ventas');
    $routes->get('/Reporte/clientes', 'Reporte::clientes');
    $routes->get('/Reporte/productos', 'Reporte::productos');

    /*Cliente */
    $routes->post('/Clientes/store', 'Cliente::store');
    $routes->post('/Clientes/selectForCI', 'Cliente::selectForCI');
    $routes->get('/Clientes/select', 'Cliente::selectClientes');
    $routes->get('/Clientes/selectExel', 'Cliente::selectClientesExel');


    /*Factura Detalle*/

    $routes->post('/Fdetalles/store', 'Fdetalle::store');
    $routes->get('/Fdetalles/selectFacturaDetalle/(:num)', 'Fdetalle::selectFacturaDetalle/$1');
    $routes->get('/Fdetalles/selectFacturaEncabezado/(:num)', 'Fdetalle::selectEncabezadoID/$1');
    $routes->get('/Fdetalles/delete/(:num)', 'Fdetalle::deleteProducto/$1');
    $routes->post('/Fdetalles/updateCantidadProducto', 'Fdetalle::updateCantidadProducto');
    $routes->get('/Fdetalles/selectFdetalleForId/(:num)', 'Fdetalle::selectFdetalleForId/$1');

    /*Factura Encabezado */
    $routes->get('/Fencabezado/procesar/(:num)', 'Fencabezado::procesar/$1');
    $routes->get('/Fencabezado/anular/(:num)', 'Fencabezado::anular/$1');

    $routes->get('/Fencabezados/totalRealizado', 'Fencabezado::totalRealizadas');
    $routes->get('/Fencabezados/totalRealizadasMes', 'Fencabezado::totalRealizadasMes');
    $routes->get('/Fencabezado/selectClienteForIdFencabezado', 'Fencabezado::selectClienteForIdFencabezado');
    $routes->get('/Fencabezado/impresionFactura/(:num)', 'Fencabezado::impresionFactura/$1');

    $routes->get('/Fencabezados/selectRealizado', 'Fencabezado::selectFencabezadoRealizada');
    $routes->get('/Fencabezados/selectRealizadoExel', 'Fencabezado::selectFencabezadoRealizadaExel');




    $routes->get('/', 'Administrador::index');



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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
