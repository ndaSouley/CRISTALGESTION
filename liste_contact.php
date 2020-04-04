    
   <?php
session_start();
if(!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
$profil=$_SESSION['TaxeUserData'][0]['profil'];
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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES CONTACTS CRISTAL CONSTRUCTION</h4>
                  <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                            <th>Date</th>
                              <th>Nom complet </th>
                              <th>Téléphone 1 </th>
                              <th>Téléphone 2 </th>
                                <th>E-mail</th>
                                 <th>Type Contact</th>
                                <th>Société</th>
                                 <th>Fonction</th>
                               
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
<?php

include('dbconnexion.php');

if($profil==1){
	
	$query = "SELECT 
      							contact.Id_utilisateur,
								contact.Id_user,
      							contact.nom_personne,
      							contact.prenom_personne,
      							contact.telephone1,
      							contact.telephone2,
      							contact.email,
      							contact.societe,
      							contact.fonction,
								contact.id_typepersonne,
      							contact.date_enregistement,
								contact.id_typecontact,
								type_personne.id_typepersonne,
								type_personne.libelle
								
							FROM 
							`contact`,
							`type_personne`
							Where contact.id_typepersonne=type_personne.id_typepersonne 
							 ";
	
	}else if($profil==2 || $profil==5){
		
		$query = "SELECT 
      							contact.Id_utilisateur,
								contact.Id_user,
      							contact.nom_personne,
      							contact.prenom_personne,
      							contact.telephone1,
      							contact.telephone2,
      							contact.email,
      							contact.societe,
      							contact.fonction,
								contact.id_typepersonne,
      							contact.date_enregistement,
								type_personne.id_typepersonne,
								type_personne.libelle
								
							FROM 
							`contact`,
							`type_personne`
							Where contact.id_typepersonne=type_personne.id_typepersonne
							 ";
		
		}else if($profil==3){
		
		$query = "SELECT 
      							contact.Id_utilisateur,
								contact.Id_user,
      							contact.nom_personne,
      							contact.prenom_personne,
      							contact.telephone1,
      							contact.telephone2,
      							contact.email,
      							contact.societe,
      							contact.fonction,
								contact.id_typepersonne,
      							contact.date_enregistement,
								type_personne.id_typepersonne,
								type_personne.libelle
								
							FROM 
							`contact`,
							`type_personne`
								Where  contact.id_typecontact=1 AND contact.id_typepersonne=type_personne.id_typepersonne
							 ";
						
			}else if($profil==4){
				
				$query = "SELECT 
      							contact.Id_utilisateur,
								contact.Id_user,
      							contact.nom_personne,
      							contact.prenom_personne,
      							contact.telephone1,
      							contact.telephone2,
      							contact.email,
      							contact.societe,
      							contact.fonction,
								contact.id_typepersonne,
      							contact.date_enregistement,
								type_personne.id_typepersonne,
								type_personne.libelle
								
							FROM 
							`contact`,
							`type_personne`
							Where  contact.id_typecontact=1 AND contact.id_typepersonne=type_personne.id_typepersonne
							 ";
				
				}

	
			
										
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
			
			
			$Id_user = utf8_decode($row['Id_utilisateur']);
			$Id_user = utf8_decode($row['Id_user']);
			$nom_personne = utf8_decode($row['nom_personne']);
			$prenom_personne = utf8_decode($row['prenom_personne']);
			$nom_complet=$nom_personne . ' ' .$prenom_personne;
			$telephone1 = utf8_decode($row['telephone1']);
			$telephone2 = utf8_encode($row['telephone2']);
			$email = utf8_encode($row['email']);
			$societe = utf8_encode($row['societe']);
			$fonction = utf8_encode($row['fonction']);
			$date_enregistement = utf8_encode($row['date_enregistement']);
			$id_typepersonne = utf8_encode($row['id_typepersonne']);
			$libelle = utf8_encode($row['libelle']);
			//Formatage de date
			$newDate = date("d-m-Y H:i:s", strtotime($date_enregistement));
			/*$newDate = date("d-m-Y", strtotime($date_enregistement));
			$newDate1 = date("H:i:s", strtotime($date_enregistement));
			$time=$newDate. ' ' .$newDate1;*/
					
?>
			
		<tr>       
                 <td><?php echo $newDate; ?></td>
                  <td><?php echo $nom_complet; ?></td>
                  <td><?php echo $telephone1; ?></td>
                  <td><?php echo $telephone2; ?></td>
                  <td><?php echo $email; ?></td>
                  <td><?php echo $libelle; ?></td>
                  <td><?php echo $societe; ?></td>
                  <td><?php echo $fonction; ?></td>
                    
                  <td><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php echo $Id_user; ?>')" class="btn top_b" id="BoutonDetail">Modifier</button></td>
				  
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


		              sessionStorage.Id_user = data.Id_user;
          				sessionStorage.nom = data.nom;
          				sessionStorage.prenom = data.prenom;
          				sessionStorage.telephone1_perso = data.telephone1_perso;
          				sessionStorage.telephone2_perso = data.telephone2_perso;
          				sessionStorage.email = data.email;
                  sessionStorage.date_saisie = data.date_saisie;
          				sessionStorage.date_creation = data.date_creation;
          				sessionStorage.societe = data.societe;
          				sessionStorage.fonction = data.fonction;
						sessionStorage.libelle = data.libelle;
						sessionStorage.id_typepersonne = data.id_typepersonne;

                   console.log('je suis le téléphone 1 dans la liste contact'+data.test);
          			
                }                       
                
            });
            
        $("#page-wrapper").load("contact.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("contact.php");
    });
	
    
    
</script>