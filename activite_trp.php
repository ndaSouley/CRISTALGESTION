<?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");
//$InputJsonString = file_get_contents('php://input');
//$data = json_decode($InputJsonString, true);
/**
 * Created by PhpStorm.
 * User: LEKAD
 * Date: 03/09/15
 * Time: 09:19
 */
require_once 'dbconfig.php';

//echo"11111111";
if(isset($_POST['type_quit'])) {

    //$data = array();
    $json = array();
    //echo"2222222 = ".$data['type_quit'];
    $id = $_POST['type_quit'];
	
	//echo"333333 = ".$id;
	
    // requête qui récupère les classes de navire selon le type
    $requete = "SELECT lib_type_service,code_type_service FROM type_service  WHERE IdType_quit = '".$id."'";

    // connexion à la base de données
   // try {
//        //$bdd = new PDO('mysql:host=localhost;dbname=france', 'root', '');
//        $bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//    } catch(Exception $e) {
//        exit('Impossible de se connecter à la base de données.');
//    }
    // exécution de la requête
    $resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        // je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
        $code_type_service = utf8_encode($donnees['code_type_service']);
					$lib_type_service = utf8_encode($donnees['lib_type_service']);

    }

      echo "{\"code_type_service\":\"$code_type_service\",
            \"lib_type_service\":\"$lib_type_service\"}";

}

?>