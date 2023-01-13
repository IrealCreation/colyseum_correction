<?php

require_once("conf.php");

require_once("models/Ticket.php");

class Client {
    public int $id;
    public string $lastName;
    public string $firstName;
    public string $birthDate;
    public bool $card;

    // On ajoute le "?" avant "int" pour dire qu'il est nullable : il peut recevoir la valeur NULL
    public ?int $cardNumber;
    public ?string $cardType;
    public ?int $cardDiscount;
    public ?array $tickets;

    public static function readAll(int $limite): array {
        global $pdo;

        // Ecriture de la requête SQL dans une chaîne de caractères avec un paramètre nommé :limite
        $sql = "SELECT * FROM clients LIMIT :limite";

        // Préparation de la requête SQL par PDO
        $statement = $pdo->prepare($sql);

        // Jonction entre le paramètre nommé :limite et la variable PHP $limite (de type INT)
        $statement->bindParam(":limite", $limite, PDO::PARAM_INT);

        // Exécution de la requête
        $statement->execute();

        // Récupération des résultats de la requête, sous forme de tableau associatif ici
        $liste = $statement->fetchAll(PDO::FETCH_CLASS, "Client");

        return $liste;
    }

    public static function readAllWithCard(): array {
        global $pdo;

        // Ecriture de la requête SQL dans une chaîne de caractères
        $sql = "SELECT * FROM clients WHERE cardNumber IS NOT NULL";

        // Préparation de la requête SQL par PDO
        $statement = $pdo->prepare($sql);

        // Exécution de la requête
        $statement->execute();

        // Récupération des résultats de la requête, sous forme de tableau associatif ici
        $liste = $statement->fetchAll(PDO::FETCH_CLASS, "Client");

        return $liste;
    }

    public static function readOne(int $id): Client {
        global $pdo;

        // Ecriture de la requête SQL dans une chaîne de caractères avec un paramètre nommé :id
        $sql = "SELECT 
                clients.id, 
                clients.lastName, 
                clients.firstName, 
                clients.birthDate, 
                clients.cardNumber, 
                cardTypes.type AS cardType, 
                cardTypes.discount AS cardDiscount 
            FROM clients 
            LEFT JOIN cards ON clients.cardNumber = cards.cardNumber
            LEFT JOIN cardTypes ON cards.cardTypesId = cardTypes.id
            WHERE clients.id = :id";

        // Préparation de la requête SQL par PDO
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":id", $id, PDO::PARAM_INT);

        // Exécution de la requête
        $statement->execute();

        // Récupération d'UN object de classe client grâce à fetch() et à setFetchMode()
        $statement->setFetchMode(PDO::FETCH_CLASS, "Client");
        $client = $statement->fetch();

        // Récupérer les informations de ses tickets
        $client->tickets = Ticket::readAllFromClient($id);

        return $client;
    }

    public function displayBirthDate(): string {
        // "1992-12-02";
        // "02 / 12 / 1992";
        $date = new DateTime($this->birthDate);
        $dateOutput = $date->format("d / m / Y");
        return $dateOutput;
    }
}

?>