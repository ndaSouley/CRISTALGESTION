   
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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">NOMBRE DE CONTRIBUABLE PAR CONTRIBUABLE</h4>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>N°</th>
                              <th>Matricule collecteur</th>
                              <th>Nom contribuable</th>
                              <th>Prénom contribuable</th>
                              <th>Date de naissance</th>
                              <th>CNI</th>
                              <th>Téléphone</th>
                              <th>Date d'enregistrement</th>


                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
<?php

include('dbconnexion.php');

	
			$query = "SELECT
			
						contribuable.id_contribuable,
						collecteur.matricule_collecteur,
						contribuable.nom,
						contribuable.prenom,
						contribuable.date_naissance,
						contribuable.lieu_naissance,
						contribuable.cni,
						contribuable.quartier,
						contribuable.profession,
						contribauble.adresse,
						contribuable.telephone,
						contribuable.date_enreg
						FROM
						contribuable
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
			$id_contribuable = utf8_decode($row['id_contribuable']);
			$matricule_collecteur = utf8_decode($row['matricule_collecteur']);
			$nom = utf8_decode($row['nom']);
			$prenom = utf8_decode($row['prenom']);
			$date_naissance = utf8_encode($row['date_naissance']);
			$cni = utf8_encode($row['cni']);
			$telephone = utf8_encode($row['telephone']);
			$date_enreg = utf8_encode($row['date_enreg']);
					
?>
			
		<tr>       
                  <td><?php echo $id_contribuable; ?></td>
                   <td><?php echo $matricule_collecteur; ?></td>
                  <td><?php echo $nom; ?></td>
                  <td><?php echo $prenom; ?></td>
                  <td><?php echo $date_naissance; ?></td>
                  <td><?php echo $cni; ?></td>
                  <td><?php echo $telephone; ?></td>
                  <td><?php echo $date_enreg; ?></td>
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