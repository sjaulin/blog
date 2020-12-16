<?php
namespace App\src\DAO;

use PDO;
use Exception;

/**
 * Abstract class Data Acces Object.
 */
abstract class DAO
{

    private $connection;

    private function checkConnection()
    {
        //Vérifie si la connexion est nulle et fait appel à getConnection() pour refaire une connexion
        if ($this->connection === null) {
            return $this->getConnection();
        }
        //Si la connexion existe, elle est renvoyée, inutile de refaire une connexion
        return $this->connection;
    }

    private function getConnection()
    {
        try {
            $this->connection = new PDO(DB_HOST, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (Exception $errorConnection) {
            die('Erreur de connection');
        }
    }

    protected function createQuery($sql, $parameters = null)
    {
        $this->checkConnection()->query('SET lc_time_names="fr_FR"');
        $this->checkConnection()->query('SET NAMES utf8');

        if ($parameters) {
            $result = $this->checkConnection()->prepare($sql);
            $result->execute($parameters);
            return $result;
        }
        $result = $this->checkConnection()->query($sql);
        return $result;
    }
}
