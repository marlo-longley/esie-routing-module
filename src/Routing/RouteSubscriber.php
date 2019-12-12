<?php

namespace Drupal\esie\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class RouteSubscriber.
 *
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Testing with one route for now: http://localhost:8001/admin/structure/views/add
    // Will add more and maybe select by substr so don't add every single route, once working.
    $admin_routes = ['views_ui.add'];
    
    foreach ($collection->all() as $name => $route) {
      if (in_array($name, $admin_routes)) {
        $route->setOption('_admin_route', TRUE);
        $route->setOption('_fake_marlo_option', TRUE);
        
        // Log the route info for this particular $name for testing
        // This does print as _admin_route true, _fake_marlo_option: true. Options are added correctly.
        error_log(var_export($collection->get($name), true));
        
        
        // Test code; remove below once working.
        // Setting access is obviously not what we are trying to do, but as an example (this is the  example given at https://www.drupal.org/node/2187643 , it works to target the route correctly
        // route->setRequirement('_access', 'FALSE');
      }
    }
    
  }

} 
