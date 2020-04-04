   <?php
session_start();
  $V_id_user=$_SESSION['TaxeUserData'][0]['id_user'];
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES PAIEMENTS</h4>
                  <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Date</th>
                              <th>Exo</th>
                              <th>Montant paye</th>
                              <th>Contribuable</th>
                              <th>Collecteur</th>
                            </tr>
                        </thead>
                        <tbody>

<?php

include('dbconnexion.php');
	
		$query = "SELECT
					paiement.num_collecte,
					paiement.code_contribuable,
					paiement.matricule_collecteur,
					paiement.montant_paye,
					paiement.date_paye,
					paiement.annee_paye,
					paiement.num_sticker,
					collecteur.matricule_collecteur,
					collecteur.nom AS nomcollecteur,
					collecteur.prenom AS prenomcollecteur,
					contribuable.id_contribuable,
					contribuable.matricule_collecteur,
					contribuable.nom,
					contribuable.prenom,
					contribuable.matricule_collecteur
					FROM
					paiement ,
					collecteur
				    INNER JOIN contribuable ON contribuable.matricule_collecteur = collecteur.matricule_collecteur
					WHERE
					paiement.code_contribuable = contribuable.id_contribuable AND contribuable.matricule_collecteur=collecteur.matricule_collecteur";

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
			         $montant_paye = utf8_decode($row['montant_paye']);
					$date_paye = utf8_encode($row['date_paye']);
					$annee_paye = utf8_encode($row['annee_paye']);
					$nomCollecteur = utf8_encode($row['nomcollecteur']);
					$prenomCollecteur = utf8_encode($row['prenomcollecteur']);
					$nomContribuable = utf8_encode($row['nom']);
					$prenomContribuable = utf8_encode($row['prenom']);
					
					$NomColecteur=$nomCollecteur.'   '.$prenomCollecteur;
					$NomContribuable=$nomContribuable.'  '.$prenomContribuable;
			?>

		<tr>
                  <td><?php echo $date_paye; ?></td>
                  <td><?php echo $annee_paye; ?></td>
                  <td><?php echo $montant_paye; ?></td>
				  <td><?php echo $NomContribuable; ?></td>				  
				  <td><?php echo $NomColecteur; ?></td>
                 
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
                url: "traitement_paiment.php" ,
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
            
        $("#page-wrapper").load("paiment.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("paiment.php");
    });
	
</script>