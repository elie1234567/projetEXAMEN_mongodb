<?php
require_once __DIR__ . '/vendor/autoload.php';
// require_once 'Etudiant.php';

$client = new MongoDB\Client('mongodb://localhost:27017');
$collection = $client->mongotest->mpampiasa;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['ietudiant']) ? $_POST['ietudiant'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['Prenom']) ? $_POST['Prenom'] : '';
    $numero = isset($_POST['Telephone']) ? $_POST['Telephone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Retrieve the MongoDB document
    $document = chercherParId($id, $collection);

    // Modify the array directly
    $document['nomM'] = $nom;
    $document['prenomM'] = $prenom;
    $document['numeroM'] = $numero;
    $document['emailM'] = $email;

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
        <h1>😁😁Modofication etudiant😁😀</h1>

            <form method="post">
            <label for="ietudiant">id</label>
            <input type="text" name="ietudiant" value="<?php if (isset($_GET['id'])) echo $_GET['id']; ?>" class="form-control" placeholder="ietudiant" required>
            <label for="nom">Nom:</label>
            <input type="text" name="nom" value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)->nomM; ?>" required>

            <label for="Prenom">Prenom:</label>
            <input type="text" name="Prenom" value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)->prenomM; ?>" required>

            <label for="Telephone">Telephone:</label>
            <input type="text" name="Telephone" value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)->numeroM; ?>" required>

            <label for="email">email utilisateur</label>
            <input type="text" name="email" value="<?php if (isset($_GET['id'])) echo chercherParId($_GET['id'], $collection)->emailM; ?>" required>
        
            <button type="submit">modification</button>
            <a type="button" href="afficheetudiant.php" name="addetudiant" id="addetudiant" class="btn btn-primary btn-lg btn-block">voir les Etudiants</a>
        </form>
       
</body>
</html>
