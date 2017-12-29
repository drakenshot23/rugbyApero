<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
 * Date: 29/12/2017
 * Time: 13:00
 */
    include 'connect.php';
    setcookie("erreur", "Votre inscription à echoué!", time() + 5);



    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $ville = $_POST["ville"];
    $mail = $_POST["CP"];
    $adresse = $_POST["adresse"];
    $CP = $_POST["CP"];
    $mdp = $_POST["mdp"];

    setcookie("nom", "$nom", time()+60);
    setcookie("prenom", "$prenom", time()+60);
    setcookie("mail", "$mail", time()+60);
    setcookie("mdp", "$mdp", time()+60);
    setcookie("ville", "$ville", time()+60);
    setcookie("adresse", "$adresse", time()+60);
    setcookie("cp", "$cp", time()+60);


    if (empty($nom) || empty($prenom) || empty($ville)|| empty($mail) || empty($adresse) || empty($CP) || empty($mdp)){
        echo "Remplir tous les champs merci";
        header("Location: ../vue/formulaire_inscription.php");
    }
        else if (!preg_match("#^[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]{2,3}$#",$mail )){
            echo "Le format de mail ne corespond pas";
            header("Location: ../vue/formulaire_inscription.php");
        }

            else if (!preg_match("#^[a-zA-Z0-9]{1,}[a-zA-Z0-9]{11,}$#",$mdp)){
                echo "Respecter le format du mot de passe";
                header("Location: ../vue/formulaire_inscription.php");
            }
                else if (!preg_match("#^[a-zA-Z]{1,}$#",$nom)){
                    echo "Entrer un nom valide ";
                    header("Location: ../vue/formulaire_inscription.php");
                }
                    else if (!preg_match("#^[a-zA-Z]{1,}$#",$prenom)){
                         echo "Entrer un prénom valide ";
                         header("Location: ../vue/formulaire_inscription.php");
                    }
                        else if (!preg_match("#^[0-9]{5}$#",$CP)){
                            echo "Entrer un code postal valide ";
                            header("Location: ../vue/formulaire_inscription.php");
                         }

                            else {
                                mysqli_query($co, "Insert into Utilisateur VALUES ('')")
                            }
?>