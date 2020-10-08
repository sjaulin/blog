<?php
class Database
{
    /**
     * Connect to database
     *
     * @return void
     */
    public function getConnection()
    {
        //Tentative de connexion à la base de données
        try{
            $connection = new PDO('mysql:host=mariadb;dbname=testdb;charset=utf8;port=3306', 'testuser', 'testpassword');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected succesfully";
        }
        //On lève une erreur si la connexion échoue
        catch(Exception $errorConnection)
        {
            die('Erreur de connection :'.$errorConnection->getMessage());
        }
    }
}