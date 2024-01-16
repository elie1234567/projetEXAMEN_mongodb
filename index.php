                    <?php
                    // Instructions pour se connecter
                    require_once __DIR__ . '/vendor/autoload.php';

                    $client = new MongoDB\Client('mongodb://localhost:27017');
                    $collection = $client->mongotest->commentaire;
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
              <title>elie</title>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <link rel="stylesheet" href="http://localhost/Projetmongodbmisemestre30170elie/elie/elie.css">
              <link rel="stylesheet" href="http://localhost/Projetmongodbmisemestre30170elie/bootstrap.min.css">
              <link rel="stylesheet" href="http://localhost/Projetmongodbmisemestre30170elie/css/bootstrap.min.css">
              <link rel="stylesheet" href="https://localhost/Projetmongodbmisemestre30170elie/fonts.googleapis.com/css?family=Amatic+SC"><style>
              html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif}
              .w3-bar-block .w3-bar-item {padding: 16px};

              </style>
              </head>
              <body>
              
              <!-- Side Navigation -->
              <nav class="w3-sidebar w3-bar-block w3-collapse w3-white w3-animate-left w3-card" style="z-index:3;width:320px;" id="mySidebar">
                <a href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom w3-large"><img src="http://localhost/Projetmongodbmisemestre30170elie/img/d.jpg" style="width:60%;"></a>
                <a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" 
                class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>
                <a href="javascript:void(0)" class="w3-bar-item w3-button w3-dark-grey w3-button w3-hover-black w3-left-align" onclick="document.getElementById('id01').style.display='block'">Listes des dickets <i class="w3-padding fa fa-pencil"></i></a>
                <a id="myBtn" onclick="myFunc('Demo1')" href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-inbox w3-margin-right"></i>voir mon tickets😁<i class="fa fa-caret-down w3-margin-left"></i></a>
                <div id="Demo1" class="w3-hide w3-animate-left">
                  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onclick="openMail('Borge');w3_close();" id="firstTab">
                    <div class="w3-container">
                      <img class="w3-round w3-margin-right" src="a.jpg" style="width:15%;"><span class="w3-opacity w3-large">Borge Refsnes</span>
                      <h6>Salutation:bonjours !</h6>
                      <p>cliquez ici pour voir le details avec commentaire.</p>
                    </div>
                  
                </div>
                <a href="" class="w3-bar-item w3-button"><i class="fa fa-paper-plane w3-margin-right"></i>Evoyer commentaire</a>
                <a href="afficheutilisateur.php" class="w3-bar-item w3-button"><i class="fa fa-hourglass-end w3-margin-right"></i>retour</a>
                 <a href="#" class="w3-bar-item w3-button"><i class="fa fa-trash w3-margin-right"href="afficheutilisateur.php"></i>deconnexion</a>
              </nav>

              <!-- Modal that pops up when you click on "New Message" -->
             <div id="id01" class="w3-modal" style="z-index:4">
                <div class="w3-modal-content w3-animate-zoom">
                  <div class="w3-container w3-padding w3-red">
                    <span onclick="document.('id01').style.display='none'"
                    class="w3-button w3-red w3-right w3-xxlarge"><i class="fa fa-remove"></i></span>
                    <h2>Listes de tous les tickets</h2>
                  </div>
                  <div class="w3-panel">
                  
                       <div class="w3-section">
                      <a class="w3-button w3-red" onclick="document.getElementById('id01').style.display='none'">Cancel  <i class="fa fa-remove"></i></a>

                     </div>
                     </div>
                     </div>
                        
                    
                     
                    </div>    
                  </div>
                </div>
              </div>

              <!-- Overlay effect when opening the side navigation on small screens -->
              <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

              <!-- Page content -->
              <div class="w3-main" style="margin-left:320px;">
              <i class="fa fa-bars w3-button w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>
              <a href="javascript:void(0)" class="w3-hide-large w3-red w3-button w3-right w3-margin-top w3-margin-right" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil"></i></a>

              <div id="Borge" class="w3-container person">
                <br>
                <img class="w3-round  w3-animate-top" src="http://localhost/Projetmongodbmisemestre30170elie/img/d.jpg" style="width:20%;">
                <h5 class="w3-opacity">id:<?php if (isset($_GET['id'])) echo ($_GET['id']);?></h5>
                <h4><i class="fa fa-clock-o"></i> From Fianarantsoa, aujourd'hui 16/01/2024.</h4>
                <a class="w3-button w3-light-grey" href="#">modifier <i class="w3-margin-left fa fa-mail-reply"></i></a>
                <a class="w3-button w3-light-grey" href="#">suprimer<i class="w3-margin-left fa fa-arrow-right"></i></a>
               <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                   <p> <table class="table table-striped table-inverse table-responsive">
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
                            foreach ($result as $e) {
                                echo "<tr>";
                                echo "<tr>";
                                echo "<td>" . $e->_id . "</td>";
                                echo "<td>" . $e->nom . "</td>";
                                echo "<td>" . $e->activite . "</td>";
                                echo "<td>" . $e->dateDebut ."</td>";
                                echo "<td>" . $e->dateFin . "</td>";
                                echo "<td>" . $e->task . "</td>";
                                echo "<td>" . $e->numericalId . "</td>";
                                ?>
                                 <form method="post" style="display: inline;">
                                    <input type="hidden" name="taskId" value="<?= $value->_id ?>">
                                    <?php
                                    echo '<td><button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>';
                                    echo '<td><a type="button" name="voir"class="btn btn-warning" href="http://localhost/Projetmongodbmisemestre30170elie/modificationT.php/?id=' . $e->_id . '">Modification</a></td>';
                              
                                echo "</tr>";
                                echo "<p><u>Commentaire:</u></p>";
                                echo "<h1>" .$e->nouvelleColonne . "</h1></td>";
                            }
                        }

                        // Appeler la fonction pour afficher les résultats
                        if (isset($_GET['id'])) echo getTCom($_GET['id']);
                        ?>
                    </tbody>
                </table>
                <
                 
                <?php
             
                ?>
                </p>
                
              
               <p>301<br>Mankasitraka tompoko😂😂😂</p>
       
              </div>
                  
              </div>

              <script>
              var openInbox = document.getElementById("myBtn");
              openInbox.click();

              function w3_open() {
                document.getElementById("mySidebar").style.display = "block";
                document.getElementById("myOverlay").style.display = "block";
              }

              function w3_close() {
                document.getElementById("mySidebar").style.display = "none";
                document.getElementById("myOverlay").style.display = "none";
              }

              function myFunc(id) {
                var x = document.getElementById(id);
                if (x.className.indexOf("w3-show") == -1) {
                  x.className += " w3-show"; 
                  x.previousElementSibling.className += " w3-red";
                } else { 
                  x.className = x.className.replace(" w3-show", "");
                  x.previousElementSibling.className = 
                  x.previousElementSibling.className.replace(" w3-red", "");
                }
              }

              openMail("Borge")
              function openMail(personName) {
                var i;
                var x = document.getElementsByClassName("person");
                for (i = 0; i < x.length; i++) {
                  x[i].style.display = "none";
                }
                x = document.getElementsByClassName("test");
                for (i = 0; i < x.length; i++) {
                  x[i].className = x[i].className.replace(" w3-light-grey", "");
                }
                document.getElementById(personName).style.display = "block";
                event.currentTarget.className += " w3-light-grey";
              }
              </script>

              <script>
              var openTab = document.getElementById("firstTab");
              openTab.click();
              </script>

              </body>
              </html> 
