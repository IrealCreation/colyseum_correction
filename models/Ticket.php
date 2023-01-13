<?php

require_once("conf.php");

class Ticket {
    public int $id;
    public int $price;

    public static function readAllFromClient(int $clientId): array {
        // Récupération de la connexion en PDO
        global $pdo;

        // Ecriture de la requête SQL
        $sql = "SELECT id, price 
            FROM tickets 
            WHERE clientsId = :clientId";

        // Préparation de la requête
        $statement = $pdo->prepare($sql);

        // Jonction entre le paramètre nommé :clientId et $clientId
        $statement->bindParam(":clientId", $clientId, PDO::PARAM_INT);

        // Exécution de la requête
        $statement->execute();

        // Récupération du tableau de résultats
        $liste = $statement->fetchAll(PDO::FETCH_CLASS, "Ticket");

        // Renvoi des résultats
        return $liste;
    }
}

?>