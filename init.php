<?php defined('SYSPATH') or die('No direct script access.');
if (Kohana::DEVELOPMENT == Kohana::$environment) {
    // Static file serving (CSS, JS, images)
    Route::set('developerbar/media', 'developerbar/media(/<file>)', array('file' => '.+'))
        ->defaults(array(
            'controller' => 'developerbar',
            'file' => NULL,
        ));

    $objDeveloperBar = Developerbar::factory();
    register_shutdown_function(array(&$objDeveloperBar, 'render'));
}