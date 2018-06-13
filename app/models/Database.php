<?php
class Database{
    private static $dbServername = "localhost";
    private static $dbUsername = "root";
    private static $dbPassword ="";
    private static $dbName = "hmrt";
    public $conn;
    public static function getConection()
    {
        return mysqli_connect(self::$dbServername, self::$dbUsername, self::$dbPassword, self::$dbName);
    }
}
?>