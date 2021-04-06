<?php

namespace app\controller;

use app\core\Application;

/**
 * Class AppController
 * @package app\controller
 */
class AppController
{
    public  function  page()
    {
        $app = new Application();
        $allMovies = self::getJsonData();
        $recommendedMovies = [];

        foreach ($allMovies as $data){
            if ($data['imdbRating'] >= 7){
                $recommendedMovies[] = $data;
            }
        }

        return  $app->router->renderView(
            'page',
            [
                'allMovies' => $allMovies,
                'recommendedMovies' => $recommendedMovies
            ]
        );
    }

    public function action()
    {
        $movieId = $_POST['movieId'];
        $params = self::getJsonData();
        foreach ($params as $data){
            if ($data['id'] == $movieId){
                $returnData = $data;
            }
        }

        return json_encode($returnData);
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