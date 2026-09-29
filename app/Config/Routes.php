<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Tasks::index');
$routes->get('tasks', 'Tasks::taskList');
$routes->get('profile', 'Tasks::profile');
$routes->get('about', 'Tasks::about');