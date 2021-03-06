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
                              <th>Date Crea</th>
                              <th>Date Doc</th>
                              <th>Quittance</th>
                              <th>Contribuable</th>
                              <th>Quotite</th>
                              <th>Exo</th>
                              <th>Collecteur</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
<?php

include('dbconnexion.php');
	$quittance = "<script>document.write(sessionStorage.type_quittance); </script>";
	
					$query = "SELECT
			quittance.id_quittance,
			quittance.code_quittance,
			contribuable.nom AS nomContribuable,
			contribuable.prenom AS prenomContribuable,
			service.quotite_paye,
			exercice.periode,
			collecteur.nom AS nomCollecteur,
			collecteur.prenom AS prenomCollecteur,
			service.date_doc,
			service.date_creation,
			quittance.Id_Type_quit
			FROM
							service
							INNER JOIN exercice ON service.code_periode = exercice.code_periode
							INNER JOIN contribuable ON service.id_contribuable = contribuable.id_contribuable
							INNER JOIN quittance ON service.id_quittance = quittance.id_quittance
							INNER JOIN collecteur ON contribuable.matricule_collecteur = collecteur.matricule_collecteur
			WHERE
			quittance.Id_Type_quit ='TFDPPCA'";
			
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
			$id_quittance = utf8_decode($row['id_quittance']);
			$code_quittance = utf8_decode($row['code_quittance']);
					$nomContribuable = utf8_encode($row['nomContribuable']);
					$prenomContribuable = utf8_encode($row['prenomContribuable']);
					$quotite_paye = utf8_encode($row['quotite_paye']);
					$periode = utf8_encode($row['periode']);
					$nomCollecteur = utf8_encode($row['nomCollecteur']);
					$prenomCollecteur = utf8_encode($row['prenomCollecteur']);
					$date_doc = utf8_encode($row['date_doc']);
					$date_creation = utf8_encode($row['date_creation']);
					
					// Code pour formater une dans y-m-d en -d-m-y
                    $newDate = date("d-m-Y H:i:s", strtotime($date_creation));
					 $date_doc = date("d-m-Y H:i:s", strtotime($date_doc));
					
					$contribuable= $nomContribuable.' '.$prenomContribuable;
			        $collecteur= $nomCollecteur.' '.$prenomCollecteur;
?>

			
		<tr>       
                  <td><?php echo $newDate; ?></td>
                   <td><?php echo $date_doc; ?></td>
                  <td><?php echo $code_quittance; ?></td>
                  <td><?php echo $contribuable; ?></td>
                  <td><?php echo $quotite_paye; ?></td>
				  <td><?php echo $periode; ?></td>				  
				  <td><?php echo $collecteur; ?></td>
                  <td><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php echo $id_quittance; ?>')" class="btn btn-success" id="BoutonDetail">Modifier</button></td>
				  
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
                url: "traitement_taxe_forfaitaire.php",
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			   console.log('retour =  '+mat);
				
			    sessionStorage.mat_quittance = mat;
                sessionStorage.even = "UPDATE";
				sessionStorage.code_periode = data.code_periode;
				sessionStorage.IdType_quit = data.IdType_quit;
				sessionStorage.mat = data.mat;
				sessionStorage.code_categ = data.code_categ;
				sessionStorage.nomCollecteur = data.nomCollecteur;
				sessionStorage.nomContribuable = data.nomContribuable;
				sessionStorage.prenomContribuable = data.prenomContribuable;
				sessionStorage.datenais = data.datenais;
                sessionStorage.lieunaissance = data.lieunais;
                sessionStorage.telephone = data.telephone;
				sessionStorage.cni = data.cni;
                sessionStorage.adresse = data.adresse;
                sessionStorage.quartier = data.quartier;
                sessionStorage.code_quittance = data.code_quittance;
				sessionStorage.profession = data.profession;
			    sessionStorage.numquittance = data.code_quittance;
				sessionStorage.exercice = data.periode;
				sessionStorage.numserie = data.numero_serie;
				sessionStorage.lib_categ = data.lib_categ;
				sessionStorage.lib_type_service = data.lib_type_service;
				sessionStorage.cbdaf = data.CB_DAF;
				sessionStorage.datequittance = data.date_validite;
				sessionStorage.periode = data.periode;
				sessionStorage.montant_droit_place = data.droit_de_place_reel;
				sessionStorage.periode = data.periode;
				sessionStorage.quotite_officiel = data.quotite_officiel;
				sessionStorage.montant_taxe = data.montant_taxe;
				sessionStorage.id_abonn_serv = data.id_abonn_serv;
				sessionStorage.droit_de_place_reel = data.droit_de_place_reel;
				sessionStorage.num_plaque = data.num_plaque;
				sessionStorage.montant_mensuel_reel = data.montant_mensuel_reel;
				
                }                       
                
            });
            
        $("#page-wrapper").load("taxe_forfaitaire.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
		sessionStorage.mess = "1";
        $("#page-wrapper").load("taxe_forfaitaire.php");
    });
	
    
    
</script>