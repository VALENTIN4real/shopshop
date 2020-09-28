<?php

    function getPage($db){
        
        $lesPages['accueil'] = "accueilControleur";
        $lesPages['contact'] = "contactControleur";
        $lesPages['inscription'] = "inscriptionControleur";
        $lesPages['connexion'] = "connexionControleur";
        $lesPages['mentions'] = "mentionsControleur";
        $lesPages['maintenance'] = "maintenanceControleur";
        $lesPages['deconnexion'] = "deconnexionControleur";
        $lesPages['utilisateur'] = "utilisateurControleur";
        
        if ($db!=null){
            if (isset($_GET['page'])){
                $page = $_GET['page'];
            }
            else{
                $page = 'accueil';
            }
        
            if (!isset($lesPages[$page])){
                $page = 'accueil';
            }
            $contenu = $lesPages[$page];
        } else {
            $contenu = $lesPages['maintenance'];
        }

        return $contenu;
    }
        
?>