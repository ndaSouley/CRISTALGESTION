    
   <?php
session_start();
if(!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
$profil=$_SESSION['TaxeUserData'][0]['id_profil'];
$id_user=$_SESSION['TaxeUserData'][0]['id_user'];
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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES UTLISATEURS</h4>
                  <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div> 
              </div>
                <!-- /.panel-heading -->
               <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Date Créa</th>
                              <th>Profil</th>
                              <th>Nom </th>
                              <th>Prenoms</th>
                              <th>Tél</th>
                              <th>Login</th>
                                <th>E-mail</th>
                                  <th>Statut</th>
                                <th>Action</th>
                              <!--<th></th>-->
                            </tr>
                        </thead>
                        <tbody>
<?php

include('dbconnexion.php');


			$query = "SELECT
							statut.Id_statut,
							statut.libelle_statut,
							`user`.id_user,
							`user`.id_profil,
							`user`.Nom_user,
							`user`.prenoms_user,
							`user`.login,
							`user`.mot_passe,
							`user`.contact,
							`user`.e_mail,
							`user`.date_enregistrement,
							`user`.Photo,
							`user`.Id_statut,
							profil.id_profil,
							profil.libelle
							FROM
							statut
							INNER JOIN `user` ON `user`.Id_statut = statut.Id_statut
							INNER JOIN profil ON `user`.id_profil = profil.id_profil
							ORDER BY
							`user`.date_enregistrement DESC";
			
										
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
			$Id_statut = utf8_decode($row['Id_statut']);
			$libelle_statut = utf8_decode($row['libelle_statut']);
			$id_profil = utf8_decode($row['id_profil']);
			$Nom_user = utf8_decode($row['Nom_user']);
			$prenoms_user = utf8_decode($row['prenoms_user']);
			$login = utf8_encode($row['login']);
			$contact = utf8_encode($row['contact']);
			$e_mail = utf8_encode($row['e_mail']);
			$date_enregistrement = utf8_encode($row['date_enregistrement']);
			$libelle = utf8_encode($row['libelle']);
			$nom_complet=$Nom_user . ' ' .$prenoms_user;
			
			// Code pour formater une dans y-m-d en -d-m-y
                  $newDate = date("d-m-Y H:i:s", strtotime($date_enregistrement));
				 //$date_doc = date("d-m-Y H:i:s", strtotime($date_doc));
?>
			
		<tr>       
                  <td><?php echo $newDate; ?></td>
                   <td><?php echo $libelle; ?></td>
                  <td><?php echo $Nom_user; ?></td>
                  <td><?php echo $prenoms_user; ?></td>
                  <td><?php echo $contact; ?></td>
                  <td><?php echo $login; ?></td>
                  <td><?php echo $e_mail; ?></td>
                  <td><?php echo $libelle_statut; ?></td>
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
    
        var donnees = {action:"SELECT",Id_user:mat}; 
        console.log('{"action":"SELECT","Id_user":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_collecteur.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour =  '+mat);
			    sessionStorage.Id_user = mat;
                sessionStorage.even = "UPDATE";


		             	sessionStorage.id_user = data.id_user;
          				sessionStorage.id_profil = data.id_profil;
          				sessionStorage.Nom_user = data.Nom_user;
          				sessionStorage.prenoms_user = data.prenoms_user;
          				sessionStorage.login = data.login;
                 		 sessionStorage.mot_passe = data.mot_passe;
          				sessionStorage.contact = data.contact;
          				sessionStorage.e_mail = data.e_mail;
          				sessionStorage.libelle_statut = data.libelle_statut;
						sessionStorage.libelle = data.libelle;
						sessionStorage.Id_statut = data.Id_statut;
						
						//Test d'affichage des données
                   console.log('je suis le téléphone 1 dans la liste utilisateur'+data.id_user);
          			
                }                       
                
            });
            
        $("#page-wrapper").load("utilisateur.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("utilisateur.php");
    });
	
    
    
</script>