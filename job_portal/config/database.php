<?php
class Database {
    public static function getConnection() {
        $host = 'localhost';
        $db = 'job_portal';
        $user = 'root';
        $pass = '';
        return new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    }
}
