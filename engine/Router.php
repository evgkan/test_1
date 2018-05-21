<?php

namespace engine;

use http\Exception\BadMethodCallException;

class Router
{

    private $appDirName = '';
    protected $routes = [];
    protected $params = [];

    public function __construct($config)
    {
        $this->appDirName = $config['appDirName'];
        $routes = $config['routes'];
        foreach ($routes as $route => $params) {
            $this->add($route, $params);
        }
    }


    private function add($route, $params)
    {
        $route = '#^' . $route . '\?.*$#';
        $this->routes[$route] = $params;
    }


    private function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return null;
    }


    //todo сделать передачу в контроллер GET параметров
    public function run()
    {
        // catching exceptions
        try {

            if (!$this->match()) {
                throw new \Exception('Route is not found');
            }

            $controllerName = ucfirst($this->params['controller']);
            $controllerPath = $this->appDirName . '\controllers\\' . $controllerName . 'Controller';
            if (!class_exists($controllerPath)) {
                throw new \Exception('Route is not found');
            }

            $actionName = $this->params['action'] . 'Action';
            if (!method_exists($controllerPath, $actionName)) {
                throw new \Exception('Route is not found');
            }

            $controller = new $controllerPath($_GET);
            $appResult = $controller->$actionName();
            $result = [
                'status' => 'ok',
                'result' => $appResult,
            ];
            http_response_code(200);

        } catch (\Exception $e) {
            $result = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
            http_response_code(404);
        }

        header('Cache-Control: no-cache,max-age=0');
        header("Content-Type: application/json;charset=utf-8");
        header('Accept: application/test1.0+json');
        echo json_encode($result);

    }

}