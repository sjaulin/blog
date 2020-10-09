<?php
/**
 * Database class
 */
// https://www.php.net/manual/fr/language.oop5.abstract.php
abstract class Database
{
    const DB_HOST = 'mysql:host=mariadb;dbname=testdb;charset=utf8';
    const DB_USER = 'testuser';
    const DB_PASS = 'testpassword';

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

    //Méthode de connexion à notre base de données
    private function getConnection()
    {
        //Tentative de connexion à la base de données
        try {
            $this->connection = new PDO(self::DB_HOST, self::DB_USER, self::DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //On renvoie la connexion
            return $this->connection;
        }
        //On lève une erreur si la connexion échoue
        catch (Exception $errorConnection) {
            die('Erreur de connection :'.$errorConnection->getMessage());
        }
    }

    protected function createQuery($sql, $parameters = null)
    {
        if ($parameters) {
            $result = $this->checkConnection()->prepare($sql);
            // pour retourner sous forme d'objet non pas de tableau
            // Pour passer le nom de la classe qui a appelée la méthode dynamiquement, on utilise static::class
            $result->setFetchMode(PDO::FETCH_CLASS, static::class);
            $result->execute($parameters);
            return $result;
        }
        $result = $this->checkConnection()->query($sql);
        $result->setFetchMode(PDO::FETCH_CLASS, static::class);
        return $result;
    }
}
