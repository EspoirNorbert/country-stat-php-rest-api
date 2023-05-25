<?php

namespace Core;

class Application
{

    public function run()
    {
        $this->routes();
    }

    public function routes()
    {
        $route = new Route();
        require_once dirname(__DIR__) . '/routes/api.php';
        $route->run();
    }
    
}
