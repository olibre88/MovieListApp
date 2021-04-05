<?php

namespace app\core;

/**
 * Class Router
 */
class Router
{
    protected array $routes =[];

    public Request $request;

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * @return false|mixed|string|void
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback == false){
            return 'Not found';
        }
        if (is_string($callback)){
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    /**
     * @param $view
     * @param array $params
     */
    public function renderView($view, $params = [])
    {
        include_once __DIR__."/../views/$view.php";
    }

}