<?php

class Application {
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {

        if(strpos($_SERVER['REQUEST_URI'], "&") !== false) {
            $url = $this->parseUrl();

            if(file_exists('../app/controllers/'. $url[0] . '.php')) {
                unset($url[0]);
            }

            if(isset($url[1])) {
                if(method_exists($this->controller, $url[1])) {
                    unset($url[1]);
                }
            }
            header("Location: " . implode("/",$url));
        }
        else {
            $included = false;
            $url = $this->parseUrl();
            if(count($url) > 0) {
                if(file_exists('../app/controllers/'. $url[0] . '.php')) {
                    $this->controller = $url[0];
                    unset($url[0]);
                    if(count($url) > 0) {
                        if(isset($url[1])) {
                            require_once '../app/controllers/' . $this->controller . '.php';
                            $this->controller = new $this->controller;
                            $included = true;
                            if(method_exists($this->controller, $url[1])) {
                                $this->method = $url[1];
                                unset($url[1]);
                            }
                        }
                    }
                }
            }
            if($included == false) {
                require_once '../app/controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;
            }
            
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller, $this->method], array($this->params));
        }
    }

    public function parseUrl() {
        $url = explode("/", $_SERVER['REQUEST_URI']);
        if($url[0] == "")
            unset($url[0]);
        if(isset($url[1]) && $url[1] == "public")
            unset($url[1]);
        $urls = "";
        foreach($url as $slash) {
            foreach(explode("&", $slash) as $item) {
                if(substr($item,-1) != "=")
                    $urls = $urls . "/" . $item;
            }
        }
        $url = explode('/', rtrim($urls, '/'));
        for($i=0;$i<count($url); $i++) {
            if($url[$i] == "")
                unset($url[$i]);
        }
        return array_values($url);
    }
}

?>