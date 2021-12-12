<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">

    <title>Inscription</title>
</head>
<body>
    <div class="block-form">
        <form action="" class="center-div" method="post" >
            <div>    
                <label for="name">Nom :</label><br>
                <input type="text" id="name" class="intern-form" name="user_name" required>
            </div>
            <br>
            <div> 
                <label for="surname">Prenom :</label><br>
                <input type="text" id="surname" class="intern-form" name="user_surname" required>
            </div>
            <br>
            <div > 
                <label for="date">Date de naissance :</label><br>
                <input type="date" id="date" class="intern-form" name="user_date" required>
            </div>
            <br>
            <div> 
                <!-- faire un selection de genre -->
                <label for="gender">Sexe :</label><br>
                <input type="radio" id="gender" name="user_gender" value="homme" checked>
                <label for="gender">Homme</label>
                <input type="radio" id="gender" name="user_gender" value="femme" >
                <label for="gender">Femme</label>
            </div>
            <br>
            <div>
                <label for="mail">e-mail :</label><br>
                <input type="email" id="mail" class="intern-form" name="user_mail" pattern="+@+." required>
            </div>
            <br>
            <div> 
                <!-- chercher pour les num tel -->
                <label for="phone">telephone :</label><br>
                <input type="tel" id="phone"  class="intern-form"name="user_phone" pattern="+33[0-5]{1} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" maxlenght="17" minlenght="17" placeholder="+33 1 23 45 67 89">
            </div>
            <br>
            <div> 
                <!-- pareil -->
                <label for="phone">Portable :</label><br>
                <input type="tel" id="portable" class="intern-form" name="user_portable" pattern="+33[6-7]{1} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" maxlenght="17" minlenght="17" placeholder="+33 6 12 34 57 89" required>
            </div>
            <br>
            <button type="submit" id="button" name="button" value="envoyer">Inscription</button>
        </form>
    </div>

</body>
</html>


<?php
    require ('model.php');
    $newco = ConnectDB();
    if (isset($_POST)){
        $nom = $_POST['user_name'];
        $prenom = $_POST['user_surname'];
        $date = $_POST['user_date'];
        $sexe = $_POST['user_gender'];
        $mail = $_POST['user_mail'];
        $telephone = $_POST['user_phone'];
        $portable = $_POST['user_portable'];

        // var_dump($nom);
        $requete = "INSERT INTO utilisateur (nom,prenom,naissance,sexe,mail,telephone,portable) VALUES ('$nom','$prenom',' $date',' $sexe ','$mail',' $telephone ','$portable')";
        $tab = array();
        $reponse = exectuterRequete($newco,$requete,$tab);
        var_dump($_POST);

    if($_POST['button']=="envoyer"){
        $requete1 ="SELECT idutilisateur from utilisateur where mail = '$mail'";
        $reponse1 = exectuterRequete($newco,$requete1,$tab); 
        $idutilisateur = $reponse1[0]['idutilisateur'];
        // $requete2 = "INSERT INTO identifiant(idutilisateur) VALUES ($idutilisateur)";
        // $reponse2 = exectuterRequete($newco,$requete2,$tab); 
        // var_dump($reponse3);

        $requete3 ="SELECT identifiant from utilisateur where idutilisateur = '$idutilisateur'";
        $reponse3 = exectuterRequete($newco,$requete3,$tab); 
        $identifiant = $reponse3[0]['identifiant'];
        // var_dump($reponse4);

        header('location:http://localhost/projetSante/code_patient.php?identifiant='.$identifiant);
    }
}
    
?>