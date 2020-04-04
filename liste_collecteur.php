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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES CONTACTS</h4>
                  <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Nom</th>
                              <th>Prénoms</th>
                              <th>Téléphone 1 </th>
                              <th>Téléphone 2 </th>
                                <th>E-mail</th>
                                <th>Société</th>
                                 <th>Fonction</th>
                               
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
<?php

include('dbconnexion.php');

	
			$query = "SELECT 
							contact.Id_user,
							contact.nom_personne,
							contact.prenom_personne,
							contact.telephone1,
							contact.telephone2,
							contact.email,
							contact.societe,
							contact.fonction
							FROM 
							`contact` ";
										
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
			
			
			$Id_user = utf8_decode($row['Id_user']);
			$nom_personne = utf8_decode($row['nom_personne']);
			$prenom_personne = utf8_decode($row['prenom_personne']);
			$telephone1 = utf8_decode($row['telephone1']);
			$telephone2 = utf8_encode($row['telephone2']);
			$email = utf8_encode($row['email']);
			$societe = utf8_encode($row['societe']);
			$fonction = utf8_encode($row['fonction']);
					
?>
			
		<tr>       
                 
                   <td><?php echo $nom_personne; ?></td>
                  <td><?php echo $prenom_personne; ?></td>
                  <td><?php echo $telephone1; ?></td>
                  <td><?php echo $telephone2; ?></td>
                  <td><?php echo $email; ?></td>
                   <td><?php echo $societe; ?></td>
                    <td><?php echo $fonction; ?></td>
                    
                  <td><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php echo $matricule_collecteur; ?>')" class="btn btn-success" id="BoutonDetail">Modifier</button></td>
				  
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
    
        var donnees = {action:"SELECT",matricule_collecteur:mat}; 
        console.log('{"action":"SELECT","matricule_collecteur":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_collecteur.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour =  '+mat);
			    sessionStorage.matricule_collecteur = mat;
                sessionStorage.even = "UPDATE";
				
				sessionStorage.matricule_collecteur = data.matricule_collecteur;
				sessionStorage.nom = data.nom;
				sessionStorage.contact = data.contact;
				sessionStorage.id_secteur = data.id_secteur;
				sessionStorage.libelle = data.libelle;
				sessionStorage.periode = data.periode;
				sessionStorage.code_periode = data.code_periode;
				sessionStorage.date_creation = data.date_creation;
				sessionStorage.date_enreg = data.date_enreg;
				sessionStorage.date_affectation = data.date_affectation;
				sessionStorage.prenom = data.prenom;
                }                       
                
            });
            
        $("#page-wrapper").load("collecteur.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("collecteur.php");
    });
	
    
    
</script>