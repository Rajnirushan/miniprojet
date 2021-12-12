         
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
    <title>Carnet de Santé</title>
</head>
<body>
<!-- fatu du js pour faire les onglets -->
<nav>
    <a href="#vaccin"></a>
    <a href="#maladie"></a>
    <a href="#prescription"></a>
</nav>
<!-- a gauche profil du patient  -->

<div class="block">
    <div class = "case">
        <!-- les info du patients -->
        <?php
            require ('model.php');
            $newco = ConnectDB();
           //  $tableau = array();
           // $req_type = $_SERVER['REQUEST_METHOD'];
           // $req_path = $_SERVER['PATH_INFO'];
           // $req_data = explode("/",$req_path);
           if (isset($_GET) && isset($_GET['identifiant'])){
                $requete = "SELECT * FROM utilisateur where identifiant = $_GET[identifiant] ";
                $tableau = array();
                $reponse = exectuterRequete($newco,$requete,$tableau);
                // var_dump($reponse);
                //  echo $reponse[0]['idutilisateur'];
                echo  "<h1>" .$reponse[0]['nom']. " " .$reponse[0]['prenom']." </h1>";
                echo "<p>".$reponse [0]['naissance']."</p>";
                echo "<p>".$reponse [0]['sexe']."</p>";
                echo "<p>mail: ".$reponse [0]['mail']."</p>";
                echo "<p>telephone: ".$reponse [0]['telephone']."</p>";
                echo "<p>portable: ".$reponse [0]['portable']."</p>";


           }
         ?>
    </div>
    <!-- derniere visite du patient -->
    <div class="case">
    <p>Dernière visite du patient :</p>
    </div>
    <div class="case2">
    <a href="code_inscription.php">Deconnexion</a>

    </div>
</div>


<img src="test3.png" alt="logo_sante" class = "logo">

<!-- à droite les données du patient -->
<div class="table " id="vaccin">
    <!-- vaccin  -->
    <div>
    <h2>Vaccination obligatoire</h2><button type='submit'>Ajouter</button></div>
    <?php 
        //     $requete2 = "INSERT INTO vaccin (date,vaccin,nom) VALUES ()";
        //     $reponse3 = exectuterRequete($newco,$requete3,$tab); 
        //     $identifiant = $reponse3[0]['identifiant'];
        // echo"<button type='submit'>Insérer</button>";
        ?>
    <!-- tableau --><!-- afficher en php -->
    <div>
        <table>
            <tr>
                <th>Date</th>
                <th>Vaccin</th>
                <th>nom et signature du vaccineur</th>

            </tr>
                <?php
                    
                    if (isset($_GET) && isset($_GET['identifiant'])){
                        $requete = "SELECT idutilisateur FROM utilisateur where identifiant = $_GET[identifiant]" ;
                        $tableau = array();
                        $reponse = exectuterRequete($newco,$requete,$tableau);
                        // var_dump($reponse);
                        $idutilisateur = $reponse [0]['idutilisateur'];
                        $requete2 = "SELECT * FROM vaccin where idutilisateur = $idutilisateur" ;
                        $reponse2 = exectuterRequete($newco,$requete2,$tableau);
                        // var_dump($reponse2);
                        // for($j = 0;$j<count($reponse2);$j++){
                        //     $idnom = $reponse2[0]['idnom'];
                        // }
                           
            
                        // echo  "<h1>" .$reponse[0]['nom']. " " .$reponse[0]['prenom']." </h1>";
                        // echo  $reponse[]['idvaccin'] ;

                        for($i = 0;$i<count($reponse2);$i++){
                            echo "<tr>";
                            echo  "<td><p>" .$reponse2[$i]['date']."</p></td>";
                            echo  "<td><p>" .$reponse2[$i]['vaccin']."</p></td>";
                            echo  "<td><p>" .$reponse2[$i]['nom']."</p></td>";
                            echo "</tr>";
                        }


                    }
                ?>           
        </table>
    </div>
</div>
<div class="table " id="maladie">
    <!-- maladie  -->
    <div>
    <h2>Maladie</h2><button type='submit'>Ajouter</button>
    </div>
        <!-- tableau -->
    <div>
        <table>
        <tr>
            <th>Date</th>
            <th>Maladie</th>
        </tr>
            <?php
               if (isset($_GET) && isset($_GET['identifiant'])){
                $requete = "SELECT idutilisateur FROM utilisateur where identifiant = $_GET[identifiant]" ;
                $tableau = array();
                $reponse = exectuterRequete($newco,$requete,$tableau);
                // var_dump($reponse);
                $idutilisateur = $reponse [0]['idutilisateur'];
                $requete2 = "SELECT * FROM maladie where idutilisateur = $idutilisateur" ;
                $reponse2 = exectuterRequete($newco,$requete2,$tableau);
                // var_dump($reponse2);
                // for($j = 0;$j<count($reponse2);$j++){
                //     $idnom = $reponse2[0]['idnom'];
                // }
                   
    
                // echo  "<h1>" .$reponse[0]['nom']. " " .$reponse[0]['prenom']." </h1>";
                // echo  $reponse[]['idvaccin'] ;

                for($i = 0;$i<count($reponse2);$i++){
                    echo "<tr>";
                    echo  "<td><p>" .$reponse2[$i]['date']."</p></td>";
                    echo  "<td><p>" .$reponse2[$i]['maladie']."</p></td>";
                    echo "</tr>";
                }
            }
            ?>        
        </table>
    </div>
    <!-- afficher en php -->
</div>
<div class="table " id="prescription">
    <!-- Prescription  -->
    <div>
    <h2>Prescription</h2><button type='submit'>Ajouter</button></div>
        <!-- tableau -->
    <div>
        <table>
        <tr>
            <th>Date</th>
            <th>Prescription</th>
            <th>Durée</th>
        </tr>
       <?php
            if (isset($_GET) && isset($_GET['identifiant'])){
                $requete = "SELECT idutilisateur FROM utilisateur where identifiant = $_GET[identifiant]" ;
                $tableau = array();
                $reponse = exectuterRequete($newco,$requete,$tableau);
                // var_dump($reponse);
                $idutilisateur = $reponse [0]['idutilisateur'];
                $requete2 = "SELECT * FROM prescription where idutilisateur = $idutilisateur" ;
                $reponse2 = exectuterRequete($newco,$requete2,$tableau);
                // var_dump($reponse2);
                // for($j = 0;$j<count($reponse2);$j++){
                //     $idnom = $reponse2[0]['idnom'];
                // }
                   
    
                // echo  "<h1>" .$reponse[0]['nom']. " " .$reponse[0]['prenom']." </h1>";
                // echo  $reponse[]['idvaccin'] ;

                for($i = 0;$i<count($reponse2);$i++){
                    echo "<tr>";
                    echo  "<td><p>" .$reponse2[$i]['date']."</p></td>";
                    echo  "<td><p>" .$reponse2[$i]['prescription']."</p></td>";
                    echo  "<td><p>" .$reponse2[$i]['duree']."</p></td>";
                    echo "</tr>";
                }


            }

       ?>
    </table>
    </div>
</div>



</body>
</html>


