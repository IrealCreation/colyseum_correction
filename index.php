<?php

require_once("models/Client.php");
require_once("models/Show.php");

$clients = Client::readAll(20);

$clientsWithCard = Client::readAllWithCard();

$shows = Show::readAll();

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
    <h1>Tous les clients</h1>
    <table class="table table-hover table-striped table-primary">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Numéro de carte</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($clients as $client) { ?>
                    <tr>
                        <td><?= $client->lastName ?></td>
                        <td><?= $client->firstName ?></td>
                        <td><?= $client->displayBirthDate() ?></td>
                        <td><?= $client->cardNumber ?></td>
                        <td>
                            <a href="clientDetail.php?id=<?= $client->id ?>">
                                <button class="btn btn-success">Afficher</button>
                            </a>
                        </td>
                    </tr>
                <?php }
            ?>
        </tbody>
    </table>

    <h1>Clients avec une carte de fidélité</h1>
    <table class="table table-hover table-striped table-secondary">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Numéro de carte</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($clientsWithCard as $client) { ?>
                    <tr>
                        <td><?= $client->lastName ?></td>
                        <td><?= $client->firstName ?></td>
                        <td><?= $client->displayBirthDate() ?></td>
                        <td><?= $client->cardNumber ?></td>
                    </tr>
                <?php }
            ?>
        </tbody>
    </table>

    <h1>Liste des shows</h1>
    <table class="table table-hover table-striped table-warning">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Artiste</th>
                <th>Date</th>
                <th>Type du show</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($shows as $show) { ?>
                <tr>
                    <td><?= $show->title ?></td>
                    <td><?= $show->performer ?></td>
                    <td><?= $show->date ?></td>
                    <td><?= $show->showType ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>