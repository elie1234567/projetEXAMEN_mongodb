<?php
// Instructions pour se connecter
require_once __DIR__ . '/vendor/autoload.php';

$client = new MongoDB\Client('mongodb://localhost:27017');
$collection = $client->mongotest->commentaire;


// Récupérer les tâches depuis MongoDB
$data = $collection->find();
$tasks = iterator_to_array($data);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="client.css">
    <title>Liste des ticket</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 id="ewa" style="text">🤷‍♂️😁liste des tickets😁</h1>

                <table id="lek" class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID</th>
                            <th>nom</th>
                            <th>activite</th>
                            <th>datedebut</th>
                            <th>datefin</th>
                            <th>task</th>
                            <th>numero</th>
                            <th><h2>COMMENTAIRE!</h2></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        function recherche($search = "")
                        {
                            global $collection;

                            $filter = [
                                '$or' => [
                                   
                                    ['_id' => new MongoDB\BSON\Regex($search, 'i')],
                                    ['nom' => new MongoDB\BSON\Regex($search, 'i')],
                                    ['activite' => new MongoDB\BSON\Regex($search, 'i')],
                                    ['dateDebut' => new MongoDB\BSON\Regex($search, 'i')],
                                    ['dateFin' => new MongoDB\BSON\Regex($search, 'i')],
                                    ['task' => new MongoDB\BSON\Regex($search, 'i')],
                                    ['numericalId' => new MongoDB\BSON\Regex($search, 'i')],
                                    ['nouvelleColonne' => new MongoDB\BSON\Regex($search, 'i')],
                                ],
                            ];

                            $result = $collection->find($filter);

                            foreach ($result as $value) {
                                echo "<tr>";
                                echo "<td>" . $value->_id . "</td>";
                                echo "<td>" . $value->nom . "</td>";
                                echo "<td>" . $value->activite . "</td>";
                                echo "<td>" . $value->dateDebut ."</td>";
                                echo "<td>" . $value->dateFin . "</td>";
                                echo "<td>" . $value->task . "</td>";
                                echo "<td>" . $value->numericalId . "</td>";
                                echo "<td><i>" .$value->nouvelleColonne . "</i></td>";
                                echo '<td> <a class="btn btn-primary btn-lg btn-block" href="afficheutilisateur.php">retour</a></td>';

                                ?>
                                
                                <?php
                                echo "</tr>";
                            }
                        }

                        if (isset($_POST['textRecherche'])) {
                            $search = $_POST['textRecherche'];
                            recherche($search);
                        } else {
                            recherche();
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>
</html>
