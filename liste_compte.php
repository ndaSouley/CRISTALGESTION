
<?php
session_start();
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default panel-green">
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES UTILISATEURS</h4>
                  <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div> 
              </div>
                <!-- /.panel-heading --> 
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Profil</th>
                               <th>	Nom</th>
                              <th>	Prenoms</th>
                              <th>Login</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>

<script>console.log('test='+sessionStorage.type_quittance); </script>

<?php

include('dbconnexion.php');
	/*$quittance = "<script>document.write(sessionStorage.type_quittance); </script>";*/
	$quittance = "<script>sessionStorage.type_quittance; </script>";
	
					$query = "SELECT
									utilisateur.id_user,
									utilisateur.IdProfil,
									utilisateur.usrLogin,
									utilisateur.usrPwd,
									utilisateur.nom,
									utilisateur.prenom,
									profil.LibProfil
									FROM
									utilisateur ,
									profil
									WHERE
									utilisateur.IdProfil = profil.IdProfil";
			
				if (mysqli_connect_errno())
	{
		echo "[{\"ConnectError\":\"yes\"}]";
		//exit();
	}
	else
	{
		$mysqli->set_charset('utf8');

		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			        $id_user = utf8_decode($row['id_user']);
			        $IdProfil = utf8_decode($row['IdProfil']);
					$usrLogin = utf8_encode($row['usrLogin']);
					$usrPwd = utf8_encode($row['usrPwd']);
					$nom = utf8_encode($row['nom']);
					$prenom = utf8_encode($row['prenom']);
					$LibProfil = utf8_encode($row['LibProfil']);
					
?>

			
		<tr>       
                  <td><?php echo $LibProfil; ?></td>
                   <td><?php echo $nom; ?></td>
                  <td><?php echo $prenom; ?></td>
                  <td><?php echo $usrLogin; ?></td>
                  <td><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php echo $id_user; ?>')" class="btn btn-success" id="BoutonDetail">Modifier</button></td>

                </tr>
<?php				
		}
	}	
$mysqli->close();
	  
?>
                            
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>    
    $(document).ready(function() {
         $('#dataTables-example').DataTable({
            responsive: true,
              "language": {
                "search":       "Recherche:",
                "sZeroRecords" : "Aucun enregistrements correspondants trouvés",
                "sEmptyTable" : "Aucune donnée disponible",
                "paginate": {
                  "first":      "First",
                  "last":       "Last",
                  "next":       "Suivant",
                  "previous":   "Précédent"
    }
  }
        });

    });
        
    $("#tbl1 button").click(function () {
        alert($(this).closest("table").attr("id"));
    });

    function getMethod(idget) {
        parentTable = element.parentNode;
        alert(parentTable.id);
        //alert($(idget).closest("td").attr("id"));
    }
    
    function decodeHTML(str){
    return str.replace(/&#([0-9]{1,3});/gi, function(match, num) {
        return String.fromCharCode(parseInt(num));
        });
    }
    
    
    function ouvrefen(mat)
    {
    
    //var mat = mle;
    
        var donnees = {action:"SELECT",id_quit:mat}; 
        console.log('{"action":"SELECT","matricule":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_utlisateur.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour =  '+mat);
			    sessionStorage.mat_quittance = mat;
                sessionStorage.even = "UPDATE";
				sessionStorage.id_user = data.id_user;
				sessionStorage.IdProfil = data.IdProfil;
				sessionStorage.usrLogin = data.usrLogin;
				sessionStorage.usrPwd = data.usrPwd;
				sessionStorage.prenom = data.prenom;
				sessionStorage.nom = data.nom;
				sessionStorage.LibProfil = data.LibProfil;
                }                       
                
            });
            
        $("#page-wrapper").load("utilisateur.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("utilisateur.php");
    });
	
    
    
</script>