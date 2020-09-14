<?php
class database {

        private static function connect() {
                $pdo = new PDO('mysql:host=127.0.0.1;dbname=austinswork;charset=utf8', 'root', 'edward1997');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
        }

        public static function query($query, $params = array()) {
                $statement = self::connect()->prepare($query);
                $statement->execute($params);

                if (explode(' ', $query)[0] == 'SELECT') {
                $data = $statement->fetchAll();
                return $data;
                }
        }

}
?>