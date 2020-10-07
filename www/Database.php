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
            $connection = new PDO('mysql:host=db;dbname=myDb;charset=utf8;port=3306', 'root', 'test');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        //On lève une erreur si la connexion échoue
        catch(Exception $errorConnection)
        {
            die('Erreur de connection :'.$errorConnection->getMessage());
        }
    }
}