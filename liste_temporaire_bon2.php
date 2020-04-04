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
                  <h4 class='panel-title pull-left' style='padding-top: 7.5px;'>DETAIL DU BON DE COMMANDE</h4>
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
require('dbconnexion.php');
 //$V_id_user=$_SESSION['id_user'];
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
				WHERE temp_bon_livre.id_user ='".$V_id_user."'";
				 
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
			?>
			
				<tr>
                  <td><?php echo $valeur_unitaire_cde;?></td>
                  <td><?php echo $qte_cde; ?></td>
                  <td><?php echo $valeur_unitaire_livree;?></td>
                  <td><?php echo $plage_debut;?></td>
				  <td><?php echo $plage_fin;?></td>				  
				  <td><?php echo $qte_livree;?></td>
                  <td><button name="BoutonSupprime" type="button" onclick="delligne('<?php echo $id_temp_bon_livre; ?>')" class="btn btn-danger" id="BoutonSupprime">Supprimer</button></td>	
                   	  <td><button name="BoutonSupprime" type="button" onclick="selligne('<?php echo $id_temp_bon_livre; ?>')" class="btn btn-success" id="BoutonSupprime">Modifier</button></td>	
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
            
        $("#page-bon").load("liste_temporaire_bon2.php");
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
                url: "traitement_bon_regie.php",
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