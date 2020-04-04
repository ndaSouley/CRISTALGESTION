<?php
session_start();
  $V_id_user=$_SESSION['TaxeUserData'][0]['id_user'];
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
?>
    <div class='row'>
        <div class='col-lg-12'>
            <div class='panel panel-default panel-green'>
              <div class='panel-heading'>
                <div class='clearfix'>
                  <h4 class='panel-title pull-left' style='padding-top: 7.5px;'>DETAIL DU  PAIEMENT</h4>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class='panel-body'>
                    <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                        <thead>
                            <tr>
                              <th>Exo</th>
                              <th>Contribuable</th>
                              <th>Montant reglé</th>
                              <th>N° Sticker</th>
                              <th>Collecteur</th>
                              <th  colspan="2" align="center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

<?php

include('dbconnexion.php');
		$query = "SELECT
                    temp_paiement.num_collecte,
                    temp_paiement.id_user,
                    temp_paiement.code_contribuable,
                    temp_paiement.matricule_collecteur,
                    temp_paiement.montant_paye,
                    temp_paiement.date_paye,
                    temp_paiement.annee_paye,
                    temp_paiement.date_enregistrement,
                    temp_paiement.id_service,
                    temp_paiement.num_sticker
                    FROM
                    temp_paiement
				    WHERE temp_paiement.id_user =".$V_id_user."";
				 
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

			        $num_collecte = utf8_decode($row['num_collecte']);
			        $code_contribuable = utf8_decode($row['code_contribuable']);
					$matricule_collecteur = utf8_encode($row['matricule_collecteur']);
					$montant_paye = utf8_encode($row['montant_paye']);
					$annee_paye = utf8_encode($row['annee_paye']);
					$date_enregistrement = utf8_encode($row['date_enregistrement']);
					$id_service = utf8_encode($row['id_service']);
					$num_sticker = utf8_encode($row['num_sticker']);

			?>
			
				<tr>
                  <td><?php echo $annee_paye; ?></td>
                  <td><?php echo $code_contribuable; ?></td>
                  <td><?php echo $montant_paye; ?></td>
				  <td><?php echo $num_sticker; ?></td>
				  <td><?php echo $matricule_collecteur; ?></td>
                  <td><button name="BoutonSupprime" type="button" onclick="delligne('<?php echo $num_collecte; ?>')" class="btn btn-danger" id="BoutonSupprime">Supprimer</button></td>
                   	  <td><button name="BoutonSupprime" type="button" onclick="selligne('<?php echo $num_collecte; ?>')" class="btn btn-success" id="BoutonSupprime">Modifier</button></td>
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

//CODE DE SUPPRESSION DU TABLEAU tempo_regie_bon
	   function delligne(mat)
    {
        var donnees = {action:"SUPPRESSION",id_tempo:mat};
         console.log('je suis dans la suppression');
		 console.log('{"action":"SUPPRESSION","id_tempo_bon_livre":'+mat+'}');    
		
        $.ajax({
                type: "POST",
                url: "traitement_bon_regie.php",
                data: donnees,
                success : function(data) {      
                 console.log("Retour "+data.Id_temp);   
                }                       
                
            });
            
        $("#page-bon").load("liste_temporaire_paiement.php");
        }
	

	
//Code de rappel des  données du tableau tempo_regie_bon
	   function selligne(mat)
    {
	   
        var donnees = {action:"SELECT",id_tempo2:mat};
        console.log('je suis dans la selection');
		  // console.log('je suis dans la selection');
		console.log('{"action":"SELECT","id_tempo_bon_livre":'+mat+'}');    
		
        $.ajax({
                type: "POST",
                url: "traitement_paiement.php",
                data: donnees,
                success : function(data) { 
				//console.log('je suis dans le update liste temporaire2'+data.id_tempo2);
				sessionStorage.V_gest_bon="2";
				
				//sessionStorage.regie = data.regie;
				sessionStorage.id_tempo2 =data.id_tempo2;
				sessionStorage.id_tempo2 =mat;
			    sessionStorage.even = "UPDATE";
                sessionStorage.regie = data.regie;
				sessionStorage.date_cde = data.date_cde;
				sessionStorage.num_bc = data.num_bc;
			    sessionStorage.num_bl = data.num_bl;
                sessionStorage.date_bl = data.date_bl;
                sessionStorage.valeur_unitaire_cde = data.valeur_unitaire_cde;
                sessionStorage.qte_cde = data.qte_cde;
                sessionStorage.valeur_unitaire_livree = data.valeur_unitaire_livree;
                sessionStorage.plage_debut = data.plage_debut;
                sessionStorage.plage_fin = data.plage_fin;
				sessionStorage.libelle = data.libelle;
				sessionStorage.qte_livree = data.qte_livree;
				sessionStorage.id_user = data.id_user;
              }                       
                
            });
            
        $("#page-bon").load("bon_livraison_regie.php");
    }
	
	

</script>