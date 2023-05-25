<?php
namespace Models;

use Exception;

class SQLitePDO extends \PDO {
    
    private const FILENAME = "countries_db.sqlite";
    private const DSN="sqlite:".self::FILENAME;

    private static $instance;

    protected function __clone(){
        return new \Exception('Le clonage est interdit');
    }

    /***
     * Return unique instance PDO
     * 
     *@return PDO
    */
    public static function getInstance(): \PDO
    {
        if(!self::$instance){
            try {
                self::$instance= new \PDO(self::DSN);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                throw New Exception("Database connexion: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}