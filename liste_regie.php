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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES REGIES</h4>
                  <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Quittance</th>
                              <th>Nom Contrib</th>
                              <th>Prenoms Contrib</th>
                              <th>Quotite payé</th>
                              <th>Exercice</th>
                              <th>Nom Collec.</th>
                              <th>Prenom Collec.</th>
                              <th>Date Doc</th>
                              <th>Date Creation</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>

<?php

include('dbconnexion.php');
	

		$query = "SELECT
				quittance.code_quittance,
				contribuable.nom AS nomContribuable,
				contribuable.prenom AS prenomContribuable,
				service.quotite_paye,
				exercice.periode,
				collecteur.nom AS nomCollecteur,
				collecteur.prenom AS prenomCollecteur,
				service.date_doc,
				service.date_creation
				FROM
				service
				INNER JOIN exercice ON service.code_periode = exercice.code_periode
				INNER JOIN contribuable ON service.id_contribuable = contribuable.id_contribuable
				INNER JOIN quittance ON service.id_quittance = quittance.id_quittance
				INNER JOIN collecteur ON contribuable.matricule_collecteur = collecteur.matricule_collecteur";

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
			$code_quittance = utf8_decode($row['code_quittance']);
					$nomContribuable = utf8_encode($row['nomContribuable']);
					$prenomContribuable = utf8_encode($row['prenomContribuable']);
					$quotite_paye = utf8_encode($row['quotite_paye']);
					$periode = utf8_encode($row['periode']);
					$nomCollecteur = utf8_encode($row['nomCollecteur']);
					$prenomCollecteur = utf8_encode($row['prenomCollecteur']);
					$date_doc = utf8_encode($row['date_doc']);
					$date_creation = utf8_encode($row['date_creation']);
			
?>

			
		<tr>
                  <td><?php echo $code_quittance; ?></td>
                  <td><?php echo $nomContribuable; ?></td>
                  <td><?php echo $prenomContribuable; ?></td>
                  <td><?php echo $quotite_paye; ?></td>
				  <td><?php echo $periode; ?></td>				  
				  <td><?php echo $nomCollecteur; ?></td>
                  <td><?php echo $prenomCollecteur; ?></td>
                  <td><?php echo $date_doc; ?></td>
                  <td><?php echo $date_creation; ?></td>
                  <td><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php echo $code_quittance; ?>')" class="btn btn-success" id="BoutonDetail">Modifier</button></td>
				  
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
    
        var donnees = {action:"SELECTALL"};
        //console.log('{"acte":"COLLECTEUR","action":"SELECT","matricule":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_taxe_forfaitaire.php" ,
                data: donnees,
                success : function(data) {      
                
                console.log('retour = '+data.code_quittance+data.nom+data.prenom);
                
                sessionStorage.even = "UPDATE";
                sessionStorage.collecteur = data.collecteur;
				sessionStorage.nom = data.nom;
				sessionStorage.prenom = data.prenom;
				 sessionStorage.date_naissance = data.date_naissance;
                sessionStorage.nom = data.lieu_naissance;
                sessionStorage.cni = data.cni;
                sessionStorage.telephone = data.telephone;
                sessionStorage.adresse = data.adresse;
                sessionStorage.quartier = data.quartier;
                sessionStorage.code_quittance = data.code_quittance;
				sessionStorage.profession = data.num;
				sessionStorage.profession = data.profession;
			    sessionStorage.profession = data.profession;
				sessionStorage.profession = data.profession;
				sessionStorage.profession = data.profession;
			
                        
                }                       
                
            });
            
        $("#page-wrapper").load("regie.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("regie.php");
    });
	
    
    
</script>