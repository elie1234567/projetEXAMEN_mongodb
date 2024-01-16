<?php
require_once __DIR__ . '/vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->mongotest;

// Use the correct collection names
$collections = $database->mpampiasa;
$collection = $database->commentaire;

// Récupérer les tâches depuis Mongo
function chercherParId($id, $collections)
  {
    $result = $collections->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
     return $result;
  }

// Traiter le formulaire d'ajout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $activite = isset($_POST['activite']) ? $_POST['activite'] : '';
    $datedebut = isset($_POST['datedebut']) ? $_POST['datedebut'] : '';
    $datefin = isset($_POST['datefin']) ? $_POST['datefin'] : '';
    $task = isset($_POST['task']) ? $_POST['task'] : '';
    $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
    $nouvelleColonn = isset($_POST['commentar']) ? $_POST['commentar'] : '';
    $etudiant = chercherParId($numero, $collections);
    $collection->insertOne([
        'nom' => $nom,
        'activite' => $activite,
        'dateDebut' => $datedebut,
        'dateFin' => $datefin,
        'task' => $task,
        'numericalId' => $numero,
        'nouvelleColonne' => $nouvelleColonn,
    ]);
    // Récupérer les tâches depuis MongoDB
    header('location:afficheticket.php');
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>utilisateur CRUD App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
           background-image: url(img/a.jpg);
            position: relative;
             background-repeat: no-repeat;
            background-size:100% ;
                
            font-size: 25px;
            text-decoration: double;

        }

        .container {
            max-width: 800px; /* Increased max-width for better layout */
            margin: 20px auto;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>😁😁 CREATONS DU TICKET😁😀</h1>

        <form method="post">

            <label for="nom">Nom:</label>
            <input type="text" name="nom" value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collections)->nomM; ?>"required>

            <label for="activite">activite:</label>
            <input type="text" name="activite" required>

            <label for="datedebut">date debut:</label>
            <input type="date" name="datedebut" required>
            
            <label for="datefin">date fin:</label>
            <input type="date" name="datefin" required>
            
          <label for="task">task:</label>
            <input type="text" name="task" required>

            <label for="numero"></label>
            <input type="text" name="numero" value="<?php if (isset($_GET['id'])) echo $_GET['id']; ?>" class="form-control" placeholder="id utilisateurs" required>
            <label for="commentar"></label>
            <input class="form-control" name="commentar" style="height:150px" placeholder="mets ici votre commentaire?">
            <button type="submit">Ajouter</button>
        </form>
       
</body>
</html>
