<?php

    /**
     * Routing
     */
    class Router {

        public static function start(){
            $routes = self::getURI();

            $controllerName = 'main';
            $actionName = CONFIG['routing']['defaultAction'];

            if(!empty($routes)) {

                $controllerName = strtolower($routes[0]);
                $actionName = $routes[1] ?? $actionName;

            }

            $modelName = $controllerName;
            if(self::isForbidden($modelName))
                die(HTTP::error404());

            $actionName = strtolower($actionName);

            $pathToFile = CONFIG['routing'][$modelName]['file'];
            $controllerClass = CONFIG['routing'][$modelName]['class'];

            if(!$pathToFile) HTTP::error404();

            $modelFile = ROOT.'/app/middleware/models/'.$pathToFile . '.php';
            $controllerFile = ROOT.'/app/middleware/controllers/'.$pathToFile . '.php';
            # TODO: реализовать ошибку 404

            if(file_exists($modelFile)) include($modelFile);
            // print_r($controllerFile);
            if(file_exists($controllerFile)) {

                if(CONFIG['requirements']['includingRequirements'])
                    self::includeRequirements($modelName);

                include($controllerFile);

                $Controller = new $controllerClass();
                $Controller->$actionName();
            }


        }
        private static function isForbidden($q) {
            for ($i = 0; $i < count(CONFIG['AccessDenied']); $i++) {
                if($q == CONFIG['AccessDenied'][$i] && !CheckUser::isAccess()) return 1;
            };
            return 0;
        }
        private static function getURI(){
            $result = array();

            if(!empty($_SERVER['REQUEST_URI'])) {
                $uri = parse_url($_SERVER['REQUEST_URI']);
                $result = self::parseURI($uri['path']);
            }

            return $result;
        }
        private static function includeRequirements($name){
            $path = ROOT.'/app/requirements/';

            if(!file_exists($path.$name)) return false;

            $dir = scandir($path.$name);

            if(count($dir) >= 3) {
                for($i = 2; $i < count($dir); $i++) {
                    include($path.$name.'/'.$dir[$i]);
                }
            }

        }

        private static function parseURI($uri){

            $uri = explode('/', $uri);
            $result = array();

            if(count($uri) > 0) {
                for($i = 0; $i < count($uri); $i++){
                    if(!empty($uri[$i])) {
                        $result[] = $uri[$i];
                    }
                }
            }
            return $result;
        }
    }


?>
