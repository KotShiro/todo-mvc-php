<?
namespace app\models;

use app\core\Model;

class Main extends Model {

    public function addTask($name, $email, $content) {
        $sql = "INSERT INTO `task` (`id`, `name`, `email`, `content`, `state`, `edit`) VALUES (NULL, :name, :email, :content, '0', '0')";
        $param = [
            'name' => $name,
            'email' => $email,
            'content' => $content,
        ];
        $this->db->set($sql, $param);
    }

}