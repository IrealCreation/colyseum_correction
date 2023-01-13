<?php

require_once("conf.php");

class Show {
    public int $id;
    public string $title;
    public string $performer;
    public string $date;
    public string $showType;

    public static function readAll(): array {
        global $pdo;

        // Ecriture de la requête SQL dans une chaîne de caractères avec un paramètre nommé :limite
        $sql = "SELECT shows.id, title, performer, `date`, `showtypes`.`type` AS `showType` FROM shows INNER JOIN showtypes ON shows.showtypesId = showtypes.id";

        // Préparation de la requête SQL par PDO
        $statement = $pdo->prepare($sql);

        // Exécution de la requête
        $statement->execute();

        // Récupération des résultats de la requête, sous forme de tableau associatif ici
        $liste = $statement->fetchAll(PDO::FETCH_CLASS, "Show");

        return $liste;
    }
}

?>