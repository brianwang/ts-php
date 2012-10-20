<?php

class Dispatcher {

    public static function dispatch($router) {
        ob_start();
        $controller = $router->getController();
        $moduleName = $router->getModuleName();
        $action = $router->getAction();
        $params = $router->getParams();
        $controllerfile = "app/controllers/{$controller}.php";

        if ($moduleName != '') {
            $controllerfile = 'modules/' . $moduleName . '/controllers/' . $controller . '.php';
        }

        if (file_exists($controllerfile)) {
            try {
                require_once ($controllerfile);
                $app = new $controller();
                $app->setRouter($router);
                call_user_func_array(array($app, $action), $params);
                $app->output();
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        } else {
            echo "controller file does not found!";
        }
        ob_end_flush();
    }

}

?>