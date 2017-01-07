<?php

namespace app\core;

use app\controllers\SiteController;

class Route
{
    static function run()
    {
        // Назначаем контреллер и действие по умолчанию.
        $controller = 'site';
        $action     = 'index';

        // Массив параметров из URI запроса.
        $params = [];
        if(isset($_GET['r'])) {
            $route = explode('/', $_GET['r']);
            $controller = $route[0];
            $action = isset($route[1]) && $route[1] != "" ? $route[1] : $action;
        }

        $controllerId = $controller;

        // добавляем префиксы
        $nameController = ucwords($controller). 'Controller';
        $nameAction = 'action' . ucwords($action);

        // подцепляем файл с классом контроллера
        $fileController = "./controllers/".$nameController.'.php';
        if(file_exists($fileController)) {
            include $fileController;
        } else {
            Route::ErrorPage();
        }

        // создаем контроллер

        if(class_exists("app\controllers\\$nameController")) {
            $controller = "app\controllers\\$nameController";
            $c = new $controller();
            $action = $nameAction;

            if(method_exists($c, $action)) {
                Route::renderPage($c, $action, $controllerId);
            } else {
                Route::ErrorPage();
            }
        } else {
            Route::ErrorPage();
        }

    }

    /*
     * @param Controller $controller.
     * @param string $action
     * @param string $name
     *
     */
    public static function renderPage($controller, $action, $controllerId) {
        $controller->id = $controllerId;
        $content = $controller->{ $action }();
        $title = $controller->title;
        include_once ("./views/layouts/$controller->layout.php");
    }

    public static function ErrorPage()
    {
        $c = new SiteController();
        self::renderPage($c, 'actionError', 'site');
    }
}