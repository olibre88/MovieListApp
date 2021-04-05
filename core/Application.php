<?php

namespace app\core;

/**
 * Class Application
 * @package app\core
 */
class Application
{
    /** @var Router  */
    public Router $router;

    /** @var Request  */
    public Request $request;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
       echo $this->router->resolve();
    }

}