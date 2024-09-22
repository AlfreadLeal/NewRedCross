<?php
class Dbh
{

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'red_cross_db';

    protected function connect()
    {

        try {

            $dbh = "mysql:host={$this->host};dbname={$this->dbname}";

            $pdo = new PDO($dbh, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {
            echo 'Disconnected: ' . $e->getMessage();
        }
    }
}
    