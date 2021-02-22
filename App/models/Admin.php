<?
namespace app\models;

use app\core\Model;

class Admin extends Model {

    public function editTask($name, $email, $content, $state, $id) {
        $sql = "SELECT content, edit FROM`tsak` WHERE id = :id LIMIT 1";

        $param = [
            'id' => $id,
        ];

        $task = $this->db->row($sql, $param);
        if( ($task[0]['content'] === $content) && ($task[0]['edit'] == '0') ) {
            $edit = '0';
        } else {
            $edit = '1';
        }

        $sql = "UPDATE `tsak` SET `name` = :name, `email` = :email, `content` = :content, `state` = :state, `edit` = :edit WHERE `tsak`.`id` = :id";
        $param = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'content' => $content,
            'state' => $state,
            'edit' => $edit,
        ];
        $result = $this->db->set($sql, $param);
    }

    public function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
                $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }

    public function loginAdmin($name, $password) {
        $sql = "SELECT id, name, password FROM `user` WHERE user.name = :name LIMIT 1";

        $param = [
            'name' => $name,
        ];

        $result = $this->db->row($sql, $param);
        if (!empty($result)) {
            $password = md5($password);

            if( $password === $result[0]['password']) {
                $hash = md5($this->generateCode(10));
                $id = $result[0]['id'];
                $sql = "UPDATE `user` SET `hash` = :hash WHERE `user`.`id` = :id";
                $param = [
                    'hash' => $hash,
                    'id' => $id,
                ];

                $this->db->set($sql, $param);

                setcookie("id", $id, time()+60*60*24*30, "/");
                setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function logoutAdmin() {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true);
    }





}