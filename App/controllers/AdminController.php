<?

namespace app\controllers;

use app\core\Controller;
use app\core\View;

class AdminController extends Controller  {

    public function loginAction() {
        $masseg = '';
        if(!empty($_POST)) {
            $check = $this->model->loginAdmin($_POST['login'], $_POST['password']);
            if ($check) {
                $this->view->redirectUrl('/admin/panel=1');
            } else {
                $masseg = 'Введены неверные данные';
            }
        }
        $param = [
            'masseg' => $masseg,
        ];
        $this->view->render('Страница входа', $param, $this->checkCookie);
    }

    public function logoutAction() {
        $this->model->logoutAdmin();
        $this->view->redirectUrl('/');
    }

    public function panelAction() {
        $cookie = $this->model->checkCookie();
        if ($cookie) {
            $arrElements = $this->pagenation();
            $this->view->render('Админ панель', $arrElements, $this->checkCookie);
        } else {
            View::erroreCode(403);
        }

    }

    public function editAction() {
        $cookie = $this->model->checkCookie();
        if ($cookie) {
            if(!empty($_POST)) {
                $this->model->editTask($_POST['name'], $_POST['email'], htmlspecialchars($_POST['content']), $_POST['state'], $_POST['id']);
                $this->view->redirectURL('/admin/panel=1');
            }
        } else {
            View::erroreCode(403);
        }
    }

}


