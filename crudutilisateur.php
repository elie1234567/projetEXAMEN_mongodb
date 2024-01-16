<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new MongoDB\Client('mongodb://localhost:27017');
$collection = $client->mongotest->mpampiasa;

// Récupérer les tâches depuis MongoDB
$data = $collection->find();
$tasks = iterator_to_array($data);

// Traiter le formulaire d'ajout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['Prenom']) ? $_POST['Prenom'] : '';
    $numero = isset($_POST['Telephone']) ? $_POST['Telephone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $collection->insertOne([
        'nomM' => $nom,
        'prenomM' => $prenom,
        'numeroM' => $numero,
        'emailM' => $email,
    ]);
    // Récupérer les tâches depuis MongoDB
    header('location:afficheutilisateur.php');
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
        <h1>😁😁Utilisateur Inscription😁😀</h1>

        <form method="post">
            
            <label for="nom">Nom:</label>
            <input type="text" name="nom" required>

            <label for="Prenom">Prenom:</label>
            <input type="text" name="Prenom" required>

            <label for="Telephone">Telephone:</label>
            <input type="text" name="Telephone" required>

            <label for="email">email utilisateur</label>
            <input type="text" name="email" required>
        
            <button type="submit">Ajouter</button>
        </form>
       
</body>
</html>
