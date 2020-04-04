<?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

date_default_timezone_set('UTC');
$Retour = "";

$InputJsonString = file_get_contents('php://input');
$data = json_decode($InputJsonString, true);

$myLogin = $data['usrLogin'];
$myPwd = $data['usrPassword'];

include('dbconnexion.php');

if (mysqli_connect_errno())
{
    $Retour = "DB_ERROR";
}
else
{
         $query = "SELECT
						`user`.id_user,
						`user`.id_profil,
						`user`.Nom_user,
						`user`.prenoms_user,
						`user`.login,
						`user`.mot_passe,
						`user`.contact,
						`user`.e_mail,	
						`user`.Id_statut,
						`user`.Photo,
						profil.id_profil,
						profil.libelle
						FROM
						`user`
						INNER JOIN profil ON `user`.id_profil = profil.id_profil
						WHERE
							login='".$myLogin."'
							AND mot_passe='".$myPwd."'";

    $result = $mysqli->query($query);
	

    if ($result->num_rows == 0)
    {
        $Retour = "DENIED";
    }
    else
    {
		
        $usrPwd = "";
		$myLogin = "";
        $nom = "";
        $prenom = "";
        $id_profil = "";
		$Id_statut = "";
		$libprofil = "";
		$iduser = "";

        while($row = mysqli_fetch_array($result))
        {
			
            $usrPwd = $row['mot_passe'];
			$myLogin = $row['login'];
            $nom = $row['Nom_user'];
            $prenom = $row['prenoms_user'];
            $id_profil = $row['id_profil'];
			$libprofil = $row['libelle'];
			$iduser=$row['id_user'];
			$Id_statut=$row['Id_statut'];
			
			
			
        }

//echo "mdp saisi = ".$myPwd;
//echo "mdp trouve = ".$usrPwd;

        if($usrPwd == $myPwd)
        {
            //acces autorisé
            $Retour = "GRANTED";

            //variables de session
			
			
           $User = array();
			$tmparray = array('Nom_user' => $nom,'prenoms_user' => $prenom,'id_profil' => $id_profil,'libelle' => $libprofil,'login' => $myLogin, 'mot_passe' => $myPwd, 'id_user' => $iduser,'Id_statut' => $Id_statut);
            array_push($User,$tmparray);

            session_start();
            $_SESSION['TaxeUserData'] = $User;
            $_SESSION['IsAuthorized'] = true;
        }
        else
        {
            $Retour = "DENIED";
        }
    }

}

    $mysqli->close();
    echo "{\"retour\":\"$Retour\",
			\"Id_statut\":\"$Id_statut\",
	\"id_profil\":\"$id_profil\"}";

?>
