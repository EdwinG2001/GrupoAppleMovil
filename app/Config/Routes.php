<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// =============================================
// RUTAS WEB (Vistas HTML)
// =============================================

// Dashboard
$routes->get('/', 'Home::index');

// Género
$routes->get('genero', 'Web\Genero::index');
$routes->post('genero/crear', 'Web\Genero::crear');
$routes->post('genero/actualizar/(:num)', 'Web\Genero::actualizar/$1');
$routes->get('genero/eliminar/(:num)', 'Web\Genero::eliminar/$1');

// Sexo
$routes->get('sexo', 'Web\Sexo::index');
$routes->post('sexo/crear', 'Web\Sexo::crear');
$routes->post('sexo/actualizar/(:num)', 'Web\Sexo::actualizar/$1');
$routes->get('sexo/eliminar/(:num)', 'Web\Sexo::eliminar/$1');

// Estado Civil
$routes->get('estadocivil', 'Web\EstadoCivil::index');
$routes->post('estadocivil/crear', 'Web\EstadoCivil::crear');
$routes->post('estadocivil/actualizar/(:num)', 'Web\EstadoCivil::actualizar/$1');
$routes->get('estadocivil/eliminar/(:num)', 'Web\EstadoCivil::eliminar/$1');

// Persona
$routes->get('persona', 'Web\Persona::index');
$routes->post('persona/crear', 'Web\Persona::crear');
$routes->post('persona/actualizar/(:num)', 'Web\Persona::actualizar/$1');
$routes->get('persona/eliminar/(:num)', 'Web\Persona::eliminar/$1');

// Teléfono
$routes->get('telefono', 'Web\Telefono::index');
$routes->post('telefono/crear', 'Web\Telefono::crear');
$routes->post('telefono/actualizar/(:num)', 'Web\Telefono::actualizar/$1');
$routes->get('telefono/eliminar/(:num)', 'Web\Telefono::eliminar/$1');

// Dirección
$routes->get('direccion', 'Web\Direccion::index');
$routes->post('direccion/crear', 'Web\Direccion::crear');
$routes->post('direccion/actualizar/(:num)', 'Web\Direccion::actualizar/$1');
$routes->get('direccion/eliminar/(:num)', 'Web\Direccion::eliminar/$1');

// Correo
$routes->get('correo', 'Web\Correo::index');
$routes->post('correo/crear', 'Web\Correo::crear');
$routes->post('correo/actualizar/(:num)', 'Web\Correo::actualizar/$1');
$routes->get('correo/eliminar/(:num)', 'Web\Correo::eliminar/$1');


// =============================================
// RUTAS API REST (JSON) - Para Flutter
// =============================================

$routes->group('api', ['filter' => 'cors'], function ($routes) {
    // OPTIONS Preflight para Flutter Web
    $routes->options('(:any)', static function () {
        $response = response();
        $response->setHeader('Access-Control-Allow-Origin', '*');
        $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept, Origin');
        $response->setStatusCode(200);
        return $response;
    });

    // Género API
    $routes->get('genero', 'Api\Genero::index');
    $routes->get('genero/(:num)', 'Api\Genero::show/$1');
    $routes->post('genero', 'Api\Genero::create');
    $routes->put('genero/(:num)', 'Api\Genero::update/$1');
    $routes->delete('genero/(:num)', 'Api\Genero::delete/$1');

    // Sexo API
    $routes->get('sexo', 'Api\Sexo::index');
    $routes->get('sexo/(:num)', 'Api\Sexo::show/$1');
    $routes->post('sexo', 'Api\Sexo::create');
    $routes->put('sexo/(:num)', 'Api\Sexo::update/$1');
    $routes->delete('sexo/(:num)', 'Api\Sexo::delete/$1');

    // Estado Civil API
    $routes->get('estadocivil', 'Api\EstadoCivil::index');
    $routes->get('estadocivil/(:num)', 'Api\EstadoCivil::show/$1');
    $routes->post('estadocivil', 'Api\EstadoCivil::create');
    $routes->put('estadocivil/(:num)', 'Api\EstadoCivil::update/$1');
    $routes->delete('estadocivil/(:num)', 'Api\EstadoCivil::delete/$1');

    // Persona API
    $routes->get('persona', 'Api\Persona::index');
    $routes->get('persona/(:num)', 'Api\Persona::show/$1');
    $routes->post('persona', 'Api\Persona::create');
    $routes->put('persona/(:num)', 'Api\Persona::update/$1');
    $routes->delete('persona/(:num)', 'Api\Persona::delete/$1');

    // Teléfono API
    $routes->get('telefono', 'Api\Telefono::index');
    $routes->get('telefono/(:num)', 'Api\Telefono::show/$1');
    $routes->get('telefono/persona/(:num)', 'Api\Telefono::byPersona/$1');
    $routes->post('telefono', 'Api\Telefono::create');
    $routes->put('telefono/(:num)', 'Api\Telefono::update/$1');
    $routes->delete('telefono/(:num)', 'Api\Telefono::delete/$1');

    // Dirección API
    $routes->get('direccion', 'Api\Direccion::index');
    $routes->get('direccion/(:num)', 'Api\Direccion::show/$1');
    $routes->get('direccion/persona/(:num)', 'Api\Direccion::byPersona/$1');
    $routes->post('direccion', 'Api\Direccion::create');
    $routes->put('direccion/(:num)', 'Api\Direccion::update/$1');
    $routes->delete('direccion/(:num)', 'Api\Direccion::delete/$1');

    // Correo API
    $routes->get('correo', 'Api\Correo::index');
    $routes->get('correo/(:num)', 'Api\Correo::show/$1');
    $routes->get('correo/persona/(:num)', 'Api\Correo::byPersona/$1');
    $routes->post('correo', 'Api\Correo::create');
    $routes->put('correo/(:num)', 'Api\Correo::update/$1');
    $routes->delete('correo/(:num)', 'Api\Correo::delete/$1');
});
