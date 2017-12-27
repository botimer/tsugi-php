<?php

namespace Tsugi\Tool;

/**
 * Provide support for a Tsugi Tool
 */
class Tool {

    public $analytics = true;

    function __construct() {
        // TODO
    }

    public function run() {
        // Make PHP paths pretty .../install => install.php
        $router = new \Tsugi\Util\FileRouter();
        $file = $router->fileCheck();
        if ( $file ) {
            require_once($file);
            return;
        }

        // Make a Tsugi Application
        $launch = \Tsugi\Core\LTIX::requireData();
        $app = new \Tsugi\Silex\Application($launch);

        // Add some routes
        if ( $this->analytics ) {
            \Tsugi\Controllers\Analytics::routes($app);
        }

        $app->run();
    }
}
