<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21/04/2015
 * Time: 22:53
 */

/* DataSource Functies om connecties te leggen met DB.

    Geef in de test gelukt weer als de connectie werkt
    of de Error als het misloopt.
    'array(\PDO::ATTR_PERSISTENT => true))' zorgt er voor dat de connecties gecached worden zodat er niet telkens een
    nieuwe connecties moet gelegd worden als andere scripts het nodig hebben. Als gevolg moeten de connecties ook niet
    gesloten worden.

*/

namespace ShoppingApp\Model;

class DataSource
{

    public function getConnection()
    {
        $conn = NULL;
        try {
            $conn = new \PDO("mysql:host=localhost;port=3306;dbname=shopping_db", "root", "root", array(\PDO::ATTR_PERSISTENT => true));
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {

        }
        if($conn != NULL) {

        }
        return $conn;
    }

    public function getSecurityConnection()
    {
        $conn = NULL;
        try {
            $conn = new \PDO("mysql:host=localhost;port=3306;dbname=shopping_security", "root", "root", array(\PDO::ATTR_PERSISTENT => true));
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {

        }
        if($conn != NULL) {

        }
        return $conn;
    }
}