<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
 * Date: 29/12/2017
 * Time: 13:00
 */
    include 'connect.php';


    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $ville = $_POST["ville"];
    $mail = $_POST["CP"];
    $adresse = $_POST["adresse"];
    $CP = $_POST["CP"];
    $mdp = $_POST["mdp"];

    setcookie("visite", "visite", time() + 60);

    if (empty($nom) || empty($prenom) || empty($ville)|| empty($mail) || empty($adresse) || empty($CP) || empty($mdp)){
        echo "Remplir tous les champs merci";
        setcookie("nom", "$nom", time()+60);
        setcookie("prenom", "$prenom", time()+60);
        setcookie("mail", "$mail", time()+60);
        setcookie("mdp", "$mdp", time()+60);
        setcookie("ville", "$ville", time()+60);
        setcookie("adresse", "$adresse", time()+60);
        setcookie("cp", "$cp", time()+60);
        header("Location: ../vue/formulaire_inscription.php");
    }
        else if (!preg_match("#^[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]{2,3}$#",$mail )){

            setcookie("nom", "$nom", time()+60);
            setcookie("prenom", "$prenom", time()+60);
            setcookie("mail", "Le format de mail ne corespond pas", time()+60);
            setcookie("mdp", "$mdp", time()+60);
            setcookie("ville", "$ville", time()+60);
            setcookie("adresse", "$adresse", time()+60);
            setcookie("cp", "$cp", time()+60);
            header("Location: ../vue/formulaire_inscription.php");
        }

            else if (!preg_match("#^[a-zA-Z0-9]{1,}[a-zA-Z0-9]{11,}$#",$mdp)){

                setcookie("nom", "$nom", time()+60);
                setcookie("prenom", "$prenom", time()+60);
                setcookie("mail", "$mail", time()+60);
                setcookie("mdp", "Respecter le format du mot de passe", time()+60);
                setcookie("ville", "$ville", time()+60);
                setcookie("adresse", "$adresse", time()+60);
                setcookie("cp", "$cp", time()+60);
                header("Location: ../vue/formulaire_inscription.php");
            }

                else if (!preg_match("#^[a-zA-Z]{1,}$#",$nom)){

                    setcookie("nom", "Entrer un nom valide ", time()+60);
                    setcookie("prenom", "$prenom", time()+60);
                    setcookie("mail", "$mail", time()+60);
                    setcookie("mdp", "$mdp", time()+60);
                    setcookie("ville", "$ville", time()+60);
                    setcookie("adresse", "$adresse", time()+60);
                    setcookie("cp", "$cp", time()+60);

                    header("Location: ../vue/formulaire_inscription.php");
                }

                    else if (!preg_match("#^[a-zA-Z]{1,}$#",$prenom)){

                        setcookie("nom", "$nom", time()+60);
                        setcookie("prenom", "Entrer un prénom valide ", time()+60);
                        setcookie("mail", "$mail", time()+60);
                        setcookie("mdp", "$mdp", time()+60);
                        setcookie("ville", "$ville", time()+60);
                        setcookie("adresse", "$adresse", time()+60);
                        setcookie("cp", "$cp", time()+60);
                        header("Location: ../vue/formulaire_inscription.php");
                    }

                        else if (!preg_match("#^[0-9]{5}$#",$CP)){

                            setcookie("nom", "$nom", time()+60);
                            setcookie("prenom", "$prenom", time()+60);
                            setcookie("mail", "$mail", time()+60);
                            setcookie("mdp", "$mdp", time()+60);
                            setcookie("ville", "$ville", time()+60);
                            setcookie("adresse", "$adresse", time()+60);
                            setcookie("cp", "Entrer un code postal valide ", time()+60);
                            header("Location: ../vue/formulaire_inscription.php");
                         }

                            else {
                                mysqli_query($co, "Insert into Utilisateur VALUES ('parent','$nom','$prenom','$mail','$mdp','$ville','$adresse','$cp')");
                                echo "Inscription bien validé";
                            }
?>