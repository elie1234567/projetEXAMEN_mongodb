<?php
// Instructions pour se connecter
require_once __DIR__ . '/vendor/autoload.php';

$client = new MongoDB\Client('mongodb://localhost:27017');
$collection = $client->mongotest->mpampiasa;
if (isset($_POST['supprimer']) && isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];
    $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($taskId)]);
}

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
    <title>Liste des Utilisateurs</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 id="ewa" style="text">🤷‍♂️😁liste des Utilisateurs😁🤷‍♂️</h1>
                <br>
                <a type="button" href="crudutilisateur.php" name="addetudiant" id="addetudiant" class="btn btn-primary btn-lg btn-block">Inscription des Utilisateurs</a>
                <a type="button" href="afficheticket.php" name="ticket" id="ticket" class="btn btn-danger">Liste des tickets à chaque utilisateurs</a>
                <a type="button" href="loginuser.php" name="dec" id="dec" class="btn btn-warning">Deconnexion</a>
                <br>
                <br>
                <form action="" method="POST">
                    <div class="col">
                        <input name="textRecherche" id="textRecherche" class="form-control" type="text" placeholder="Rechercher...">
                    </div>
                    <br>
                    <div class="col">
                        <input type="submit" class="btn btn-success" name="rechercher" value="Rechercher">
                    </div>
                </form>

                <table id="lek" class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Action</th>
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
                                    ['nomM' => new MongoDB\BSON\Regex($search, 'i')],
                                    ['prenomM' => new MongoDB\BSON\Regex($search, 'i')],
                                    ['numeroM' => new MongoDB\BSON\Regex($search, 'i')],
                                    ['emailM' => new MongoDB\BSON\Regex($search, 'i')],
                                ],
                            ];

                            $result = $collection->find($filter);

                            foreach ($result as $value) {
                                echo "<tr>";
                                echo "<td>" . $value->_id . "</td>";
                                echo "<td>" . $value->nomM . "</td>";
                                echo "<td>" . $value->prenomM . "</td>";
                                echo "<td>" . $value->numeroM . "</td>";
                                echo "<td>" . $value->emailM . "</td>";
                                ?>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="taskId" value="<?= $value->_id ?>">
                                    <?php
                                    echo '<td><button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>';
                                    echo '<td><a type="button"name="ticket" class="btn btn-primary btn-lg btn-block" href="http://localhost/Projetmongodbmisemestre30170elie/ajjouttichet.php/?id=' . $value->_id . '">créations du tickets</a>';
                                    echo '<td> <a class="btn btn-danger" href="http://localhost/Projetmongodbmisemestre30170elie/index.php/?id=' . $value->_id . '">voir mes tickets</a></td>';
                                    echo '<td> <a class="btn btn-primary btn-lg btn-block" href="http://localhost/Projetmongodbmisemestre30170elie/modificationU.php/?id=' . $value->_id . '">Modification</a></td>';
                                    ?>
                                    ?>
                                </form> 
                                 
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
