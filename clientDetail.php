<?php

require_once("models/Client.php");

// Récupération du paramètre d'URL "id" avec GET
$id = $_GET["id"];

$client = Client::readOne($id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colyseum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" defer crossorigin="anonymous"></script>

</head>
<body>
    <h1>Informations du client</h1>
    <table class="table table-hover table-striped table-primary">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Numéro de carte</th>
                <th>Type de carte</th>
                <th>Promotion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $client->lastName ?></td>
                <td><?= $client->firstName ?></td>
                <td><?= $client->displayBirthDate() ?></td>
                <td><?= $client->cardNumber ?></td>
                <td><?= $client->cardType ?></td>
                <td><?= $client->cardDiscount ?></td>
            </tr>
        </tbody>
    </table>
    <h1>Liste des tickets</h1>
    <table class="table table-hover table-striped table-success">
        <thead>
            <tr>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalPrice = 0;
            foreach($client->tickets as $ticket) {
                $totalPrice += $ticket->price; ?>
                <tr>
                    <td><?= $ticket->price ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <td>
                Prix total : <?= $totalPrice ?>
            </td>
        </tfoot>
    </table>
    
</body>
</html>