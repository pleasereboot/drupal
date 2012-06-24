<?php

namespace Drupal\system\Tests\Routing;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Utility methods to generate sample data, database configuration, etc.
 */
class RoutingFixtures {

  /**
   * Returns a standard set of routes for testing.
   *
   * @return \Symfony\Component\Routing\RouteCollection
   */
  public function sampleRouteCollection() {
    $collection = new RouteCollection();

    $route = new Route('path/one');
    $route->setRequirement('_method', 'GET');
    $collection->add('route_a', $route);

    $route = new Route('path/one');
    $route->setRequirement('_method', 'PUT');
    $collection->add('route_b', $route);

    $route = new Route('path/two');
    $route->setRequirement('_method', 'GET');
    $collection->add('route_c', $route);

    $route = new Route('path/three');
    $collection->add('route_d', $route);

    $route = new Route('path/two');
    $route->setRequirement('_method', 'GET|HEAD');
    $collection->add('route_e', $route);

    return $collection;
  }

  public function routingTableDefinition() {

    $tables['test_routes'] = array(
      'description' => 'Maps paths to various callbacks (access, page and title)',
      'fields' => array(
        'name' => array(
          'description' => 'Primary Key: Machine name of this route',
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => '',
        ),
        'pattern' => array(
          'description' => 'The path pattern for this URI',
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => '',
        ),
        'pattern_outline' => array(
          'description' => 'The pattern',
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => '',
        ),
        'route_set' => array(
          'description' => 'The route set grouping to which a route belongs.',
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => '',
        ),
        'access_callback' => array(
          'description' => 'The callback which determines the access to this router path. Defaults to user_access.',
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => '',
        ),
        'access_arguments' => array(
          'description' => 'A serialized array of arguments for the access callback.',
          'type' => 'blob',
          'not null' => FALSE,
        ),
        'fit' => array(
          'description' => 'A numeric representation of how specific the path is.',
          'type' => 'int',
          'not null' => TRUE,
          'default' => 0,
        ),
        'number_parts' => array(
          'description' => 'Number of parts in this router path.',
          'type' => 'int',
          'not null' => TRUE,
          'default' => 0,
          'size' => 'small',
        ),
        'route' => array(
          'description' => 'A serialized Route object',
          'type' => 'text',
        ),
      ),
      'indexes' => array(
        'fit' => array('fit'),
        'pattern_outline' => array('pattern_outline'),
        'route_set' => array('route_set'),
      ),
      'primary key' => array('name'),
    );

    return $tables;
  }
}
