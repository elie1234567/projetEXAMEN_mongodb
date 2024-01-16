
<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';

class User
{
    private $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function loginUser($username, $password)
    {
        $user = $this->collection->findOne(['nom' => $username, 'code' => $password]);
        return $user;
    }
}

$client = new MongoDB\Client('mongodb://localhost:27017');
$collection = $client->mongotest->user;

$userObj = new User($collection);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $userObj->loginUser($username, $password);

        if ($user) {
            header("Location:afficheutilisateur.php");
            exit();
        } else {
            echo "<p>Invalid credentials</p>";
        }
    } else {
        echo "<p>Invalid request</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="log.css">

    
    
    <title>Login</title>
    <style type="text/css">
        .animateuse {
            animation: leelaanimate 0.5s infinite;
        }

        @keyframes leelaanimate {
            10% { color: blue; }
            40% { color: red; }
            20% { color: blue; }
            40% { color: green; }
            50% { color: pink; }
            60% { color: orange; }
            80% { color: black; }
            100% { color: brown; };
        }
        body{
            font-family: Arial, sans-serif;
            background-image: url(img/a.jpg);
            position: relative;
             background-repeat: no-repeat;
            background-size:100% ;
                
            font-size: 25px;
            text-decoration: double; 
        }body {
                        font-family: Arial, sans-serif;
                        background-color: hsl(0, 6%, 87%);
                        margin: 0;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                    }

                    form {
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }

                    input {
                        width: 100%;
                        padding: 10px;
                        margin-bottom: 10px;
                        box-sizing: border-box;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                    }

                    button {
                        background-color: #4caf50;
                        color: #fff;
                        padding: 10px 15px;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                    }

                    button:hover {
                        background-color: #45a049;
                    }

                    .error-message {
                        color: red;
                        margin-bottom: 10px;
                    }
                
    </style>
</head>
<body>
   
    <div class="container">
        <h1 class="text-center text-success text-uppercase animateuse">Welcome student!</h1>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">                             
                    <form action="" method="POST"> <!-- L'action est vide pour soumettre le formulaire à la même page -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</body>
</html>
