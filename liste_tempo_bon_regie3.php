<?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");
//$InputJsonString = file_get_contents('php://input');
//$data = json_decode($InputJsonString, true);

include('dbconnexion.php');
 session_start();
	 $V_id_user=$_SESSION['id_user'];

echo <<<ET

    <div class='row'>
        <div class='col-lg-12'>
            <div class='panel panel-default panel-green'>
              <div class='panel-heading'>
                <div class='clearfix'>
                  <h4 class='panel-title pull-left' style='padding-top: 7.5px;'>DETAIL DU BON DE COMMANDE 2</h4>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class='panel-body'>
                    <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                        <thead>
                            <tr>
                              <th>Valeur Unitaire Cde</th>
                              <th>Qté Cde</th>
                              <th>Valeur Unitaire Livrée</th>
                              <th>Plage Debut</th>
                              <th>Plage Fin</th>
                              <th>Qté Livrée</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
ET;


	
	/*$regie = '".<script> VAR regie=sessionStorage.v_regie;</script>."';
	$num_bc = '".<script> VAR num_bc=sessionStorage.v_numbc;</script>."';
	$id_user = '".<script> VAR id_user=sessionStorage.v_user;</script>."';*/
	
	/*$regie = "<script> console.log('regie ='+sessionStorage.v_regie); document.write(sessionStorage.v_regie) </script>";
	$num_bc = "<script> console.log('regie ='+sessionStorage.v_numbc); document.write(sessionStorage.v_numbc) </script>";
	$id_user = "<script> console.log('regie ='+sessionStorage.v_user); document.write(sessionStorage.v_user) </script>";*/
			//echo "variablePHP = ".$variablePHP;

	
		$regie = $_POST["regie"];
		$num_bc = $_POST["numbc"];
		//$id_user = $data["iduser"];
		
		
		//echo "regie = ".$regie;
		//echo "bc = ".$num_bc;
		//echo "user = ".$id_user;
		
		$query = "SELECT
				temp_bon_livre.id_temp_bon_livre,
				temp_bon_livre.regie,
				temp_bon_livre.date_cde,
				temp_bon_livre.num_bc,
				temp_bon_livre.num_bl,
				temp_bon_livre.date_bl,
				temp_bon_livre.valeur_unitaire_cde,
				temp_bon_livre.qte_cde,
				temp_bon_livre.valeur_unitaire_livree,
				temp_bon_livre.plage_debut,
				temp_bon_livre.plage_fin,
				temp_bon_livre.qte_livree,
				temp_bon_livre.id_user
				FROM
				temp_bon_livre
				WHERE temp_bon_livre.id_user =".$V_id_user."";
				 
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
			$id_temp_bon_livre = utf8_decode($row['id_temp_bon_livre']);
			$regie = utf8_decode($row['regie']);
					$date_cde = utf8_encode($row['date_cde']);
					$num_bc = utf8_encode($row['num_bc']);
					$num_bl = utf8_encode($row['num_bl']);
					$date_bl = utf8_encode($row['date_bl']);
					$valeur_unitaire_cde = utf8_encode($row['valeur_unitaire_cde']);
					$valeur_unitaire_livree = utf8_encode($row['valeur_unitaire_livree']);
					$plage_debut = utf8_encode($row['plage_debut']);
					$plage_fin = utf8_encode($row['plage_fin']);
					$qte_cde = utf8_encode($row['qte_cde']);
					$qte_livree = utf8_encode($row['qte_livree']);
			


			
				echo "<tr>
                  <td>$valeur_unitaire_cde</td>
                  <td>$qte_cde</td>
                  <td>$valeur_unitaire_livree</td>
                  <td>$plage_debut</td>
				  <td>$plage_fin</td>				  
				  <td>$qte_livree</td>
                  <td><button name='BoutonSupprime' type='button' onclick='delligne('$id_quittance')' class='btn btn-success' id='BoutonSupprime'>Supprimer</button></td>			  
                </tr>";
				
		}
	}	


echo <<<EL

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
    /*$(document).ready(function() {
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

		
    });*/
        
    $('#tbl1 button').click(function () {
        alert($(this).closest('table').attr('id'));
    });

    function getMethod(idget) {
        parentTable = element.parentNode;
        alert(parentTable.id);
        //alert($(idget).closest('td').attr('id'));
    }
    
    function decodeHTML(str){
    return str.replace(/&#([0-9]{1,3});/gi, function(match, num) {
        return String.fromCharCode(parseInt(num));
        });
    }
    
    /*
    function ouvrefen(mat)
    {
    
    //var mat = mle;
    
        var donnees = {action:"SELECT",id_quit:mat}; 
        console.log('{"action":"SELECT","matricule":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_autorisation_stationnement.php" ,
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
				sessionStorage.	type_vehicule = data.type_vehicule;
				
			    sessionStorage.nombre_place = data.nombre_place;
				sessionStorage.PTAC = data.PTAC;
				sessionStorage.genre_vehicule = data.genre_vehicule;
				sessionStorage.marque_vehicule = data.marque_vehicule;
                sessionStorage.adresse = data.adresse;
                sessionStorage.quartier = data.quartier;
                sessionStorage.code_quittance = data.code_quittance;
				sessionStorage.profession = data.profession;
			    sessionStorage.numquittance = data.numquittance;
				sessionStorage.numero_antenne = data.numero_antenne;
				sessionStorage.numero_macaron = data.numero_macaron;
				sessionStorage.immatriculation = data.immatriculation;
				sessionStorage.code_quittance = data.code_quittance;
				sessionStorage.couleur = data.couleur;
				sessionStorage.exercice = data.periode;
				sessionStorage.numserie = data.numero_serie;
				sessionStorage.lib_categ = data.lib_categ;
				sessionStorage.lib_type_service = data.lib_type_service;
				sessionStorage.cbdaf = data.CB_DAF;
				sessionStorage.datequittance = data.date_validite;
				sessionStorage.periode = data.periode;
				sessionStorage.montant_droit_place = data.montant_droit_place;
				sessionStorage.periode = data.periode;
				sessionStorage.quotite_officiel = data.quotite_officiel;
				sessionStorage.num_plaque = data.num_plaque
                }                       
                
            });
            
        //$("#page-wrapper").load("autorisation_stationnement.php");
    }
   */
    
</script>
EL;

$mysqli->close();
	  
?>