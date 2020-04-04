<?PHP
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");
//$InputJsonString = file_get_contents('php://input');
//$data = json_decode($InputJsonString, true);
try
{
    require_once 'dbconfig.php';
    $stmt = null;

    //echo" A = ".$data['usrLogin'];

    $usr_Login = htmlspecialchars($data['usrLogin']);
    $myPwd = htmlspecialchars($data['usrPwd']);
    // if(($_POST['action'])== "CONNEXION") {
     //echo"   je suis au debut de select".$usr_Login;
    if(($data['action'])== "CONNEXION") {

        //echo"  SSSSSSSSSSSS";
        $query = "SELECT utilisateur.id_user,
						 utilisateur.id_service,
						  utilisateur.IdProfil,
						  utilisateur.usrLogin,
						  utilisateur.usrPwd,
						  utilisateur.nom,
						  utilisateur.prenom,
						  profil.LibProfil
                           FROM 
                           utilisateur , profil	
                           WHERE
					          utilisateur.IdProfil = profil.IdProfil AND (utilisateur.usrLogin='".$usr_Login."'AND utilisateur.usrPwd='".$myPwd."')";

        $result = $mysqli->query($query);

        if ($result->num_rows == 0)
        {
            $Retour = "DENIED";
           // echo"id_user" .$Retour;
        }
        else
        {
            $usrPwd = "";
            $nom = "";
            $prenom = "";
            $IdProfil = "";
            $id_user="";
            $LibProfil="";
            echo"id_user" .$id_user;
            while($row = mysqli_fetch_array($result))
            {
                $usrPwd = $row['usrPwd'];
                $usrLogin = $row['usrLogin'];
                $nom = $row['nom'];
                $prenom = $row['prenom'];
                $IdProfil = $row['IdProfil'];
                $LibProfil = $row['LibProfil'];
                $id_user = $row['id_user'];
            }


            if($usrPwd == $myPwd)
            {
                //acces autorisé
                $Retour = "GRANTED";

                //variables de session
                $User = array();
                $tmparray = array('id_user' => $id_user,'nom' => $nom,'prenom' => $prenom,'profil' => $id_profil,'libprofil' => $libprofil,'usrlogin' => $myLogin, 'usrpwd' => $myPwd,'id_user' => $id_user);
                array_push($User,$tmparray);

                session_start();
                $_SESSION['MairieUserData'] = $User;
                $_SESSION['IsAuthorized'] = true;
            }
            else
            {
                $Retour = "DENIED";
            }
        }

    }

        echo "{
						\"usrPwd\":\"$usrPwd\", 
						\"id_user\":\"$id_user\",
						\"IdProfil\":\"$IdProfil\", 
						\"usrLogin\":\" $usrLogin\"}";



}
catch(PDOException $pe)
{
    $DBcon->rollBack();
    $DBcon = null;

    $msg = $pe->getMessage();
    echo "{\"Etat\":\"0\",\"Motif\":\"$msg\"}";

    //echo "[{\"Etat\":\"0\",\"Motif\":\"$msg. DESOLE, ECHEC D'ENREGISTREMENT. OPERATION ANNULEE !\"}]";
    exit();
}



?>