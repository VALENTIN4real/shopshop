<?php

    function accueilControleur($twig){
        echo $twig->render('accueil.html.twig', array());
    }

    function contactControleur($twig){
        mail('vmairessevmairesse@gmail.com', "Contact", $_POST['message'], $_POST['email']);
        
        echo $twig->render('contact.html.twig', array());
    }

    function inscriptionControleur($twig, $db){
        $form = array();

        if(isset($_POST['btInscription'])){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $role = $_POST['role'];
            $form['valide'] = true;

            if($password!=$password2){
                $form['valide'] = false;
                $form['message'] = 'Les mots de passes ne sont pas identiques, réessayez.';
            } else {
                $utilisateur = new Utilisateur($db);
                $exec = $utilisateur->insert($email, password_hash($password,PASSWORD_DEFAULT), $role, $nom, $prenom);
                
                if(!$exec){
                    $form['valide'] = false;
                    $form['message'] = 'Problème d\'insertion dans la table utilisateur';
                }
            }

            $form['email'] = $email;
            $form['nom'] = $nom;
            $form['prenom'] = $prenom;
        }
        echo $twig->render('inscription.html.twig', array('form'=>$form));
    }

    function connexionControleur($twig, $db){
        $form = array();

        if(isset($_POST['btConnexion'])){
            $form['valide'] = true;
            $email = $_POST['email'];
            $password = $_POST['password'];
            $utilisateur = new Utilisateur($db);

            $unUtilisateur = $utilisateur->connect($email);
            
            if($unUtilisateur!=null){
                if(!password_verify($password,$unUtilisateur['mdp'])){
                    $form['valide'] = false;
                    $form['message'] = 'Login ou mot de passe incorrect';
                } else {
                    $_SESSION['login'] = $email;
                    $_SESSION['role'] = $unUtilisateur['idRole'];
                    header("Location:index.php");
                }
            } else {
                $form['valide'] = false;
                $form['message'] = 'Login ou mot de passe incorrect';
            }
        }
        
        echo $twig->render('connexion.html.twig', array('form'=>$form));
    }

    function deconnexionControleur($twig, $db){
        session_unset();
        session_destroy();
        header("Location:index.php");
    }

    function mentionsControleur($twig){
        echo $twig->render('mentions.html.twig', array());
    }

    function maintenanceControleur($twig){
        echo $twig->render('maintenance.html.twig', array());
    }
?>