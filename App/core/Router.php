<?

namespace app\core; 
use app\core\View; 

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct() {
        $arr = require 'app/config/routes.php';
        foreach ($arr as $key => $value) {
            $this->add($key, $value);
        }
    }

    public function add($route, $params) {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;

    }

    public function match() {
        $url = explode("?", trim($_SERVER['REQUEST_URI'], '/'))[0];
        foreach ($this->routes as $route => $params) {
            if(Preg_match($route, $url, $matches)) {     
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run() {
        if($this->match()){
            $path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                if(method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                }
                else {
                    View::erroreCode(404);
                }
            } else {
                View::erroreCode(404);
            }
        } else {
            View::erroreCode(404);
        }
    }
}
    