<?
namespace app\core;

use app\lib\Db;

abstract class Model {
    public $db;

    public function __construct() {
        $this->db = new Db;
    }

    public function checkCookie() {
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
            $idCookie = $_COOKIE['id'];
            $hashCookie = $_COOKIE['hash'];
            $sql = "SELECT * FROM user WHERE id = :id LIMIT 1";
            $param = [
                'id' => $idCookie,
            ];

            $result = $this->db->row($sql, $param);
            $hashSql = $result[0]["hash"];
            $idSql = $result[0]["id"];
            if(($hashSql !== $hashCookie) or ($idSql !== $idCookie)) {
                setcookie("id", "", time() - 3600*24*30*12, "/");
                setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true);
                return false;
            } else {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    public function getTasks($offset, $sizePage, $sortValue) {
        $result = $this->db->row("SELECT * FROM `tsak`");
        $totalPages = ceil(count($result) / $sizePage);
        $sql = "SELECT * FROM `tsak` $sortValue LIMIT $offset, $sizePage";
        $result = $this->db->row($sql);
        if(empty($result)) {
            return [
                'totalPages' => $totalPages,
                'result' => [
                    [
                        'name' => '',
                        'email' => '',
                        'content' => 'Страница пуста, вы попали не туда ;С ',
                        'state' => ''
                    ]
                ]
            ];
        }
        return [
            'totalPages' => $totalPages,
            'result' => $result
        ];
    }
}