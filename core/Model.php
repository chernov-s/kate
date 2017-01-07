<?php

namespace app\core;

use PDO;
/**
 * Base model
 *
 * PHP version 7.0
 */
class Model
{
    private static $instance = NULL;
    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getInstance() {
        if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                DB_USER, DB_PASSWORD,
                $pdo_options
            );
        }
        return self::$instance;
    }

}