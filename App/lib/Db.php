<?

namespace app\lib;

use PDO;

class Db
{
    protected $db;
    public function __construct() {
        $config = require 'app/config/db.php';
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['user'], $config['pass']);
    }

    public function query($sql, $param=[]) {
        $statement = $this->db->prepare($sql);
        if (!empty($param)) {
            foreach ($param as $key => $value) {
                $statement->bindValue(':'.$key, $value);
            }
        }
        $statement->execute();
        return $statement;
    }

    public function row($sql, $param=[]) {
        $result = $this->query($sql, $param);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $param=[]) {
        $result = $this->query($sql, $param);
        return $result->fetchColumn();
    }

    public function set($sql, $param=[]) {
        $statement = $this->db->prepare($sql);
        if (!empty($param)) {
            foreach ($param as $key => $value) {
                $statement->bindValue(':'.$key, $value);
            }
        }
        $statement->execute();
    }

}
