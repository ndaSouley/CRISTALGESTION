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
                  <h4 class='panel-title pull-left' style='padding-top: 7.5px;'>DETAIL DU BON DE COMMANDE TRESOR</h4>
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
                              <th  colspan="2" align="center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

<?php

include('dbconnexion.php');

		$query = "SELECT
						temp_bon_tresor.id_bon_tresor,
						temp_bon_tresor.id_user,
						temp_bon_tresor.num_bon_commande,
						temp_bon_tresor.num_bon_livraison,
						temp_bon_tresor.agent_receptionnaire,
						temp_bon_tresor.valeur_unitaire_commande,
						temp_bon_tresor.plage_debut_sticker,
						temp_bon_tresor.plage_fin_sticker,
						temp_bon_tresor.total_qte_commande,
						temp_bon_tresor.valeur_unitaire_livraison,
						temp_bon_tresor.total_qte_livraison,
						temp_bon_tresor.date_bon_commande,
						temp_bon_tresor.date_bon_livraison,
						temp_bon_tresor.date_operation
						FROM
						temp_bon_tresor
						WHERE
						temp_bon_tresor.id_user='".$V_id_user."'";
																 
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
			        $id_bon_tresor = utf8_decode($row['id_bon_tresor']);
			        $id_user = utf8_decode($row['id_user']);
					$num_bon_commande = utf8_encode($row['num_bon_commande']);
					$num_bon_livraison = utf8_encode($row['num_bon_livraison']);
					$agent_receptionnaire = utf8_encode($row['agent_receptionnaire']);
					$valeur_unitaire_commande = utf8_encode($row['valeur_unitaire_commande']);
					$plage_debut_sticker = utf8_encode($row['plage_debut_sticker']);
					$plage_fin_sticker = utf8_encode($row['plage_fin_sticker']);
					$total_qte_commande = utf8_encode($row['total_qte_commande']);
					$valeur_unitaire_livraison = utf8_encode($row['valeur_unitaire_livraison']);
					$total_qte_livraison = utf8_encode($row['total_qte_livraison']);
					$date_bon_commande = utf8_encode($row['date_bon_commande']);
					$date_bon_livraison = utf8_encode($row['date_bon_livraison']);
					
			?>
			
				<tr>
                  <td><?php echo $valeur_unitaire_commande; ?></td>
                  <td><?php echo $total_qte_commande; ?></td>
                  <td><?php echo $valeur_unitaire_livraison; ?></td>
                  <td><?php echo $plage_debut_sticker; ?></td>
				  <td><?php echo $plage_fin_sticker; ?></td>				  
				  <td><?php echo $total_qte_livraison; ?></td>
                  <td><button name="BoutonSupprime" type="button" onclick="delligne('<?php echo $id_bon_tresor; ?>')" class="btn btn-danger" id="BoutonSupprime">Supprimer</button></td>	
                   	  <td><button name="BoutonSupprime" type="button" onclick="selligne('<?php echo $id_bon_tresor; ?>')" class="btn btn-success" id="BoutonSupprime">Modifier</button></td>	
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
                url: "traitement_bon_tresor.php",
                data: donnees,
                success : function(data) {      
                 console.log("Retour "+data.Id_temp);   
                }                       
                
            });
            
        $("#page-bon").load("liste_temporaire_bon_tresor.php");
        }
	

	
//Code de rappel des  données du tableau tempo_regie_bon
	   function selligne(mat)
    {
	   
        var donnees = {action:"SELECT",id_tempo2:mat};
        console.log('je suis dans la selection');
		  // console.log('je suis dans la selection');
		console.log('{"action":"SELECT","Matricule tresor":'+mat+'}');    
		
        $.ajax({
                type: "POST",
                url: "traitement_bon_tresor.php",
                data: donnees,
                success : function(data) { 
				console.log('je suis dans le update liste temporaire2'+data.valeur_unitaire_livraison);
				sessionStorage.V_gest_bon="2";
				
				//sessionStorage.regie = data.regie;
				//sessionStorage.id_tempo2 =data.id_tempo2;
				sessionStorage.id_tempo2 =mat;
			    sessionStorage.even = "UPDATE";
                sessionStorage.id_bon_tresor = data.id_bon_tresor;
				sessionStorage.id_user = data.id_user;
				sessionStorage.num_bon_commande = data.num_bon_commande;
			    sessionStorage.num_bon_livraison = data.num_bon_livraison;
                sessionStorage.agent_receptionnaire = data.agent_receptionnaire;
                sessionStorage.valeur_unitaire_commande = data.valeur_unitaire_commande;
                sessionStorage.plage_debut_sticker = data.plage_debut_sticker;
                sessionStorage.plage_fin_sticker = data.plage_fin_sticker;
                sessionStorage.valeur_unitaire_livree = data.valeur_unitaire_livree;
                sessionStorage.total_qte_commande = data.total_qte_commande;
				sessionStorage.valeur_unitaire_livraison = data.valeur_unitaire_livraison;
				sessionStorage.total_qte_livraison = data.total_qte_livraison;
				sessionStorage.date_bon_commande = data.date_bon_commande;
				sessionStorage.date_bon_livraison = data.date_bon_livraison;
				sessionStorage.date_operation = data.date_operation;
              }                       
                
            });
            
        $("#page-bon").load("bon_livraison_tresor.php");
    }
	
	

</script>