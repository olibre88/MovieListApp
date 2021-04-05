<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;

/**
 * Class AppController
 * @package app\controller
 */
class AppController
{
    public  function  page()
    {
        $app = new Application();
        $params = self::getJsonData();

        return  $app->router->renderView('page', $params);
    }

    public function action()
    {
        return json_encode(self::getJsonData());
    }

    /**
     * @return array
     */
    protected static function getJsonData(): array
    {
        return json_decode(
            file_get_contents(__DIR__."/../model/movies-in-theaters.json"),
            true);
    }

}