<?php
/**
 * Class Db
 * Component of working with database
 */
class Db
{
    /**
     * Set connection with database
     * @return \PDO <p>Object of class PDO for working with DB</p>
     */

    public static function getConnection()
    {
        //Establishing connections parameters from file
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        //Establishing connection
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        //Set encoding
        $db->exec("set names utf8");

        return $db;
    }
}