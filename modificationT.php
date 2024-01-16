<?php
require_once __DIR__ . '/vendor/autoload.php';


$client = new MongoDB\Client('mongodb://localhost:27017');
$collection = $client->mongotest->commentaire;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['ietudiant']) ? $_POST['ietudiant'] : '';
            $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
            $activite = isset($_POST['activite']) ? $_POST['activite'] : '';
            $datedebut = isset($_POST['datedebut']) ? $_POST['datedebut'] : '';
            $datefin = isset($_POST['datefin']) ? $_POST['datefin'] : '';
            $task = isset($_POST['task']) ? $_POST['task'] : '';
            $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
            $nouvelleColonn = isset($_POST['commentar']) ? $_POST['commentar'] : '';
        

            // Retrieve the MongoDB document
            $document = chercherParId($id, $collection);

            // Modify the array directly
            $document['nom'] = $nom;
            $document['activite'] = $activite;
            $document['dateDebut'] = $datedebut;
            $document['dateFin'] = $datefin;
            $document['task'] = $task;
            $document['numericalId'] = $numero;
            $document['nouvelleColonne'] = $nouvelleColonn;

            // Use updateOne to update the document in MongoDB
            $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)],
                ['$set' => $document]
            );

            // Redirect to the display page after modification
            header('location:afficheetudiant.php');
            exit();
        }


    ?>


<?php
function chercherParId($id, $collection)
{
    $result = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Etudiant CRUD App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(img/b.jpg);
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
        <h1>😁😁Modification etudiant😁😀</h1>

            <form method="post">
            <label for="ietudiant">id</label>
            <input type="text" name="ietudiant" value="<?php if (isset($_GET['id'])) echo $_GET['id']; ?>" class="form-control" placeholder="ietudiant" required>
            <label for="nom">Nom:</label>
            <input type="text" name="nom" value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)->nom; ?>" required>
            <label for="activite">activite:</label>
            <input type="text" name="activite" value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)->activite; ?>" required>

            <label for="datedebut">date debut:</label>
            <input type="date" name="datedebut"  value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)->dateDebut; ?>" required>
            
            <label for="datefin">date fin:</label>
            <input type="date" name="datefin"  value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)-> dateFin; ?>" required>
            
          <label for="task">task:</label>
            <input type="text" name="task"  value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)->task; ?>" required>

            <label for="numero"></label>
            <input type="text" name="numero"  value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)-> numericalId; ?>" required>
            <label for="commentar"></label>
            <input class="form-control" name="commentar" style="height:150px" placeholder="mets ici votre commentaire?" value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)->nouvelleColonne; ?>" required>
        
            <button type="submit">modification</button>
            <a type="button" href="afficheetudiant.php" name="addetudiant" id="addetudiant" class="btn btn-primary btn-lg btn-block">voir les Etudiants</a>
        </form>
       
</body>
</html>
