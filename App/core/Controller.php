<?

namespace app\core;

use app\core\View;

class Controller {

    public $route;
    public $view;
    public $model;
    public $checkCookie;

    public function __construct($route) {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel(ucfirst($route['controller']));
        $this->checkCookie = $this->model->checkCookie();
    }

    public function loadModel($name) {
        $path = 'app\models\\'.$name;
        if(class_exists($path)) {
            return  new  $path;
        }
    }

    public function pagenation(){
        $valuForSort = "";
        if( !empty($_GET['name']) || !empty($_GET['email']) || !empty($_GET['state']) ) {
            $valuForSort = "ORDER BY ";
            foreach ($_GET as $key => $value) {
                if($value) {
                    $valuForSort .= $key . ' ' . $value . ', ';
                }
            }
            $valuForSort = mb_substr($valuForSort, 0, -2);
        } else {
            $valuForSort = "ORDER BY `task`.`id` DESC";
        }
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $pattern = '/[^0-9]/';
        $page = preg_replace($pattern, '', $url);
        $sizePage = 3;
        $offset = ($page-1) * $sizePage;
        $result = $this->model->getTasks($offset, $sizePage, $valuForSort);
        if(1 < ($page+0)) {
            $back = ($page - 1);
        } else {
            $back = 1;
        }
        if(($page+0) < ($result['totalPages'] + 0)) {
            $next = ($page + 1);
        } else {
            $next = ($result['totalPages'] + 0);
        }
        $paramSelect = '';
        $getName = '';
        $getEmail = '';
        $getState = '';
        if(!empty($_GET)) {
            $paramSelect = !empty($_GET['name']) || !empty($_GET['email']) || !empty($_GET['state']) ? '?'.$_SERVER["argv"][0] : '';
            $getName = $_GET['name'];
            $getEmail = $_GET['email'];
            $getState = $_GET['state'];
        }

        $arrElements = [
            'checkCookie' => $this->checkCookie,
            'tasks' => $result['result'],
            'page' => $page,
            'next' => $next,
            'back' => $back,
            'totalPages' => $result['totalPages'],
            'paramSelect' => $paramSelect,
            'getName' => $getName,
            'getEmail' => $getEmail,
            'getState' => $getState,
        ];
        return $arrElements;
    }

}
