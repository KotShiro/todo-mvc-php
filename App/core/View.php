<?

namespace app\core;

class View {

    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $vars = [], $checkCookie = false) {
        extract($vars);

        if(file_exists('app/views/' . $this->path . '.php')) {
            ob_start();
            require_once 'app/views/' . $this->path . '.php';
            $content = ob_get_clean();
            require_once 'app/views/layouts/' . $this->layout . '.php';
        } else {
            echo 'Ошибка файл "path" не найден: ' .$this->path ;
        }
    }

    public static function erroreCode($code) {
        http_response_code($code);
        require_once 'app/views/errors/' . $code . '.php';
        exit;
    }

    public function redirectUrl($url) {
        header('location:'.$url);
        exit;
    }

}

