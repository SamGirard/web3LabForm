<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compte Usager</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>

        <?php
            $nom = $mdp = $confMdp = $courriel = $image = $date = $voiture = $radio = "";
            $nomErreur = $mdpErreur = $confMdpErreur = $courrielErreur = $imageErreur = $dateErreur = $voitErreur = $radioErreur = "";
            $erreur = false;


            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                
                if(empty($_POST['nom'])){
                    $nomErreur = "Le nom ne peut pas être vide";
                    $erreur  = true;
                } elseif ($_POST['nom'] == "SLAY"){
                    $nomErreur = "Le nom est déja utilisé";
                    $erreur  = true;
                }
                else{
                    $nom = trojan($_POST['nom']);
                }

                if(empty($_POST['mdp'])){
                    $mdpErreur = "Le mot de passe ne peut pas être vide";
                    $erreur  = true;
                }
                else{
                    $mdp = trojan($_POST['mdp']);
                }

                if($_POST['confMdp'] != $_POST['mdp']){
                    $confMdpErreur = "Le mot de passe n'est pas pareil";
                    $erreur  = true;
                }
                else{
                    $confMdp = trojan($_POST['confMdp']);
                }

                if(empty($_POST['courriel'])){
                    $courrielErreur = "Le courriel ne peut pas être vide";
                    $erreur  = true;
                } elseif(!filter_var($_POST['courriel'], FILTER_VALIDATE_EMAIL)) {
                    $courrielErreur = "Le courriel est invalide";
                    $erreur = true;
                } else{
                    $courriel = trojan($_POST['courriel']);
                }

                if(empty($_POST['image'])){
                    $imageErreur = "Veuillez choisir une image";
                    $erreur  = true;
                }
                else{
                    $image = trojan($_POST['image']);
                }

                if(empty($_POST['dates'])){
                    $dateErreur = "Veuillez entrer votre date de naissance";
                    $erreur  = true;
                }
                else{
                    $date = trojan($_POST['dates']);
                }


                if($_POST['transport'] != "A" && $_POST['transport'] != "B" && $_POST['transport'] != "M" && $_POST['transport'] != "V"){
                    $voitErreur = "Veuillez choisir un mode de transport";
                    $erreur  = true;
                }
                else{
                    $voiture = trojan($_POST['transport']);
                }

                if(empty($_POST['genre'])){
                    $radioErreur = "Veuillez choisir un genre";
                    $erreur  = true;
                } else{
                    $radio = trojan($_POST['genre']);
                }

                $nom = trojan($_POST['nom']);
                $mdp = trojan($_POST['mdp']);
                $confMdp = trojan($_POST['confMdp']);
                $courriel = trojan($_POST['courriel']);
                $image = trojan($_POST['image']);
                $date = trojan($_POST['dates']);

            }

            if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
        ?>

        <div class="container-fluid">
        <div class="row">
                <div class="col-md-4 offset-4 mb-3 text-center">
                    <h1>Création de l'usager</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-4 mb-3">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <input type="text" placeholder="Nom" class="form-control" name="nom" value="<?php echo $nom;?>">
                        <p class="error"><?php echo $nomErreur; ?></p><br>

                        <input type="password" placeholder="Mot de passe" class="form-control" name="mdp">
                        <p class="error"><?php echo $mdpErreur; ?></p><br>

                        <input type="password" placeholder="Confirmer le mot de passe" class="form-control" name="confMdp">
                        <p class="error"><?php echo $confMdpErreur; ?></p><br>

                        <input type="text" placeholder="Adresse courriel" class="form-control" name="courriel" value="<?php echo $courriel;?>">
                        <p class="error"><?php echo $courrielErreur; ?></p><br>

                        <input type="url" placeholder="Votre image (lien)" class="form-control" name="image" value="<?php echo $image;?>">
                        <p class="error"><?php echo $imageErreur; ?></p><br>

                        <input type="date" name="dates" class="form-control" value="<?php echo $date;?>">
                        <p class="error"><?php echo $dateErreur; ?></p><br>
                        
                        <select name="transport" class="form-control">
                            <option value="X">Faite un choix</option>
                            <option value="A">Auto</option>
                            <option value="B">Autobus</option>
                            <option value="M">Marche</option>
                            <option value="V">Vélo</option>
                        </select>
                        <p class="error"><?php echo $voitErreur; ?></p><br>

                        <input type="radio" name="genre" value="H">
                        <label class="choix">Homme</label><br>
                        <input type="radio" name="genre" value="F">
                        <label class="choix">Femme</label><br>                    
                        <input type="radio" name="genre" value="N">
                        <label class="choix">Non genré</label>
                        <p class="error"><?php echo $radioErreur; ?></p><br><br>

                        <input type="submit" class="form-control envoie">
                    </form>
                </div>
            </div>
        </div>

        <?php
        } else {
            ?>

                <div class= "container-fluid result">
                    <div class="row">
                        <div class = "col-md-12 text-center">
                            <img src="<?php echo $image; ?>" class="profil">
                        </div>
                    </div>
                    <div class="row">
                        <div class = "col-md-4 firstCol">
                            <h2>Nom : <?php echo $nom; ?></h2>
                        </div>
                        <div class = "col-md-4 firstCol">
                            <h2>Mot de passe : <?php echo $mdp; ?></h2>
                        </div>
                        <div class = "col-md-4 firstCol">
                            <h2>Courriel : <?php echo $courriel; ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class = "col-md-4 firstCol">
                            <h2>Sexe :
                                <?php 
                                    if($_POST['genre'] == "H"){
                                        echo "Homme";
                                    } elseif ($_POST['genre'] == "F") {
                                        echo "Femme";
                                    } else {
                                        echo "Non-genré";
                                    }
                                ?>
                            </h2>
                        </div>
                        <div class="col-md-4 firstCol">
                            <h2>Transport : 
                                <?php 
                                    if($_POST['transport'] == "A"){
                                        echo "Auto";
                                    } elseif ($_POST['transport'] == "B") {
                                        echo "Autobus";
                                    } elseif ($_POST['transport'] == "M") {
                                        echo "Marche";
                                    } else {
                                        echo "Vélo";
                                    }
                                ?>
                            </h2>
                        </div>
                        <div class = "col-md-4 firstCol">
                            <h2>Date : <?php echo $date; ?></h2> 
                        </div>
                    </div>
                    <div class="row boutton">
                        <div class="col-md-10 offset-1 text-center">
                            <a href="index.php" class="retour">Créer un nouvel usager</a>
                        </div>
                    </div>
                </div> 

        
            
            



            <?php
        }
            function trojan($data){
                $data = trim($data); //Enleve les caractères invisibles
                $data = addslashes($data); //Mets des backslashs devant les ' et les  "
                $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;
            
                return $data;
            }
        ?>

    </body>
</html>

