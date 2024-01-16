<?php
// Instructions pour se connecter à MongoDB
require_once __DIR__ . '/vendor/autoload.php';

// Se connecter à MongoDB
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
    <link rel="stylesheet" href="http://localhost/Projetmongodbmisemestre30170elie/css/bootstrap.min.css">
    <title>historique</title>
    
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="col">
                <h1>HISTORIQUE!</h1>
                
                <?php if (isset($_GET['id'])) echo ($_GET['id']);?>
                
                <br>
           
                <br>
                <br>
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID</th>
                            <th>nom</th>
                            <th>activite</th>
                            <th>datedebut</th>
                            <th>datefin</th>
                            <th>task</th>
                            <th>numero etudiant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fonction pour récupérer le nombre d'heures
                        function getTCom($id)
                        {
                            global $collection;
                        
                            // Requête pour récupérer les données de MongoDB
                            $result = $collection->find(['_id' => $id]);
                        
                            $counter = 0;
                        
                            // Afficher les résultats
                            foreach ($result as $value) {
                                echo "<td>" . $value->numericalId . "</td>";
                                echo "</tr>";
                                $counter++;
                            }
                        
                            if($counter==0)
                            {
                                if (isset($_POST['textRecherche'])) {
                                    $id = $_POST['textRecherche'];
                                    recherche($id);
                                } else {
                                    recherche();
                                }
                            }
                            else {
                                echo "aaaaa";
                            }
                        }

                        // Afficher les résultats de la recherche
                        function recherche($aff = "")
                        {
                            global $collection;

                            // Requête pour récupérer les données de MongoDB
                            $result = $collection->find(['numericalId' => $_GET['id']]);
                        
                            // Afficher les résultats
                            foreach ($result as $value) {
                                echo "<tr>";
                                echo "<tr>";
                                echo "<td>" . $value->_id . "</td>";
                                echo "<td>" . $value->nom . "</td>";
                                echo "<td>" . $value->activite . "</td>";
                                echo "<td>" . $value->dateDebut ."</td>";
                                echo "<td>" . $value->dateFin . "</td>";
                                echo "<td>" . $value->task . "</td>";
                                echo "<td>" . $value->numericalId . "</td>";
                                echo "</tr>";
                            }
                        }

                        // Appeler la fonction pour afficher les résultats
                        if (isset($_GET['id'])) echo getTCom($_GET['id']);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
