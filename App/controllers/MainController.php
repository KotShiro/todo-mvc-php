<?

namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class MainController extends Controller  {

    public function indexAction() {
        $arrElements = $this->pagenation();
        $this->view->render('Главная странийца', $arrElements, $arrElements, $this->checkCookie);
    }

    public function addAction() {
        $alert = '';
        if(!empty($_POST)) {
            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['content'])) {
                $alert = 'Все поля являются обязательными';
            } else {
                $email = $_POST['email'];
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->model->addTask($_POST['name'], $_POST['email'], htmlspecialchars($_POST['content']));
                    $alert = 'Запись успешно добавлена';
                } else {
                    $alert = "E-mail адрес '$email' указан неверно.";
                }
            }
        }
        $arrElements = [
            'alert' => $alert,
        ];
        $this->view->render('Добавить задачу', $arrElements, $this->checkCookie);
    }

    public function redirectAction() {
        $this->view->redirectUrl('/page=1');
    }

}


