<?php

class Database
{

    public $data = "";

    static $DB_SERVER = "localhost";
    static $DB_USER = "root";
    static $DB_PASSWORD = "";
    static $DB_NAME = "apis";

    static $db = NULL;


    public static function getConnection()
    {
        Database::$DB_SERVER = get_config('server');
        Database::$DB_USER = get_config('username');
        Database::$DB_PASSWORD = get_config('password');
        Database::$DB_NAME = get_config('database');

        if (Database::$db != NULL) {
            //-------- Returning existing established ---------//
            return Database::$db;
        } else {
            //-------- Create Connection --------//
            Database::$db = mysqli_connect(Database::$DB_SERVER, Database::$DB_USER, Database::$DB_PASSWORD, Database::$DB_NAME);
            if (!Database::$db) {
                //------- Connected Failed -------//
                die("Connection failed: " . mysqli_connect_error());
            } else {
                //--------- New connection established ---------//
                return Database::$db;
            }
        }
    }
}
