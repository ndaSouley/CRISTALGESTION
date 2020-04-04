 <?php
session_start();
if(!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
$profil=$_SESSION['TaxeUserData'][0]['id_profil'];
$id_user=$_SESSION['TaxeUserData'][0]['id_user'];
?>
 <?php
 
 include('dbconnexion.php');
 



			$query = "SELECT
							Count(proprietaire.id_proprietaire) AS nbre_proprietaire
							FROM
							proprietaire
							";
			
										
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
			
			$nbre_proprietaire = utf8_decode($row['nbre_proprietaire']);
			
		}
	}
 
 ?>
   
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header" align="center">NOMBRE PROPRIETAIRE<?php echo(' ' . $nbre_proprietaire);?></h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
        
            <div class="panel panel-default panel-green">
            
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES PROPRIETAIRES </h4>
                  <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div> 
              </div>
                <!-- /.panel-heading -->
               <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Date Créa</th>
                              <th>Code Proprietaire</th>
                              <th>Nom</th>
                              <th>Télephone </th>
                              <th>Categ. Bien</th>
                              <th>Commune </th>
                              <th>Qartier</th>
                               <th>N° Appartement</th>
                              
                              <th>Observations</th>
                              <th>Residence</th>
                              <th>Montant</th>
                                <th>Imprimer</th>
                               
                                <th>Modifier</th>
                                  
                              <!--<th></th>-->
                            </tr>
                        </thead>
                        <tbody>
<?php

//include('dbconnexion.php');


			$query = "SELECT
										bien.id_bien,
										bien.id_type_bien,
										bien.id_commune,
										bien.prix_bien,
										bien.quartier_bien,
										bien.id_proprietaire,
										bien.impot_foncier,
										bien.loyer_percu,
										bien.id_nbre_piece,
										bien.description,
										bien.num_appartement,
										bien.parcelle,
										bien.date_enregistrement,
										bien.num_ncc,
										bien.id_charge,
										bien.id_commission,
										commission.id_commission,
										commission.libelle_commission,
										commune.id_commune,
										commune.libelle_categorie_commune,
										nbre_piece.id_nbre_piece,
										nbre_piece.libelle_piece,
										proprietaire.id_proprietaire,
										proprietaire.nom_proprietaire,
										proprietaire.prenoms,
										proprietaire.contact,
										proprietaire.e_mail,
										proprietaire.fonction,
										proprietaire.localite,
										proprietaire.montant_impot,
										proprietaire.date_nais_proprietaire,
										proprietaire.lieu_nais_proprietaire,
										proprietaire.initial_proprietaire,
										proprietaire.cni_proprietaire,
										type_bien.id_type_bien,
										type_bien.libelle_type_bien,
										charge_bien.id_charge,
										charge_bien.libelle_charge,
										bien.loyer_proprietaire,
										bien.id_categorie_bien,
										bien.id_charge_impot,
										bien.lot,
										bien.nom_immeuble,
										bien.ilot,
										bien.frais_agence,
										categorie_bien.id_categorie_bien,
										categorie_bien.libelle_categorie_bien,
										categorie_bien.id_type_bien
										FROM
										bien
										INNER JOIN commission ON bien.id_commission = commission.id_commission
										INNER JOIN commune ON bien.id_commune = commune.id_commune
										INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
										INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
										INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
										INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
										INNER JOIN categorie_bien ON categorie_bien.id_type_bien = type_bien.id_type_bien 
										AND bien.id_categorie_bien = categorie_bien.id_categorie_bien
										 
							   	ORDER BY bien.id_type_bien DESC";
			
										
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
			
			$id_bien = utf8_decode($row['id_bien']);
			$id_type_bien = utf8_decode($row['id_type_bien']);
			$id_commune = utf8_decode($row['id_commune']);
			$V_description = utf8_decode($row['description']);
			$prix_bien = utf8_decode($row['prix_bien']);
			$quartier_bien = utf8_decode($row['quartier_bien']);
			$id_proprietaire = utf8_encode($row['id_proprietaire']);
			$impot_foncier = utf8_encode($row['impot_foncier']);
			$Nbre_pieces = utf8_encode($row['libelle_piece']);
			$nom_proprietaire = utf8_encode($row['nom_proprietaire']);
			$prenoms = utf8_encode($row['prenoms']);
			$nom_complet=$nom_proprietaire . ' ' .$prenoms;
			$contact = utf8_encode($row['contact']);
			$e_mail = utf8_encode($row['e_mail']);
			$fonction = utf8_encode($row['fonction']);
			$localite = utf8_encode($row['localite']);
			$cni_proprietaire = utf8_encode($row['cni_proprietaire']);
			$initial_proprietaire = utf8_encode($row['initial_proprietaire']);
			$libelle_commission = utf8_encode($row['libelle_commission']);
			$id_type_bien = utf8_encode($row['id_type_bien']);
			$libelle_type_bien = utf8_encode($row['libelle_type_bien']);
			$loyer_proprietaire = utf8_encode($row['loyer_proprietaire']);
			$id_categorie_bien = utf8_encode($row['id_categorie_bien']);
			$libelle_categorie_commune = utf8_encode($row['libelle_categorie_commune']);
			$num_appartement = utf8_encode($row['num_appartement']);
			$libelle_categorie_bien = utf8_encode($row['libelle_categorie_bien']);
			$nom_immeuble = utf8_encode($row['nom_immeuble']);
			
			$date_enregistrement = utf8_encode($row['date_enregistrement']);
			// Code pour formater une dans y-m-d en -d-m-y
                  $newDate = date("d-m-Y H:i:s", strtotime($date_enregistrement));
				 //$date_doc = date("d-m-Y H:i:s", strtotime($date_doc));
?>
			
		<tr>       
                  <td><?php echo $newDate; ?></td>
                  <td><?php echo $initial_proprietaire; ?></td>
                   <td><?php echo $nom_complet; ?></td>
                  <td><?php echo $contact; ?></td>
                  <td><?php echo $libelle_categorie_bien; ?></td>
                  <td><?php echo $libelle_categorie_commune; ?></td>
                   <td><?php echo $quartier_bien; ?></td>
                  <td><?php echo $num_appartement; ?></td>
                  <td><?php echo $V_description ; ?></td>
                   <td><?php echo $nom_immeuble ; ?></td>
                  
                  
                  <td><?php echo number_format($prix_bien) . ' FCFA  '; ?></td>
                  
                  
              <td> <a href="mondat_gestion.php?Id_bien_envoye=<?php echo($id_bien);?>" target="_bloank"><button name="BoutonDetail" type="button"  class="btn btn-success" id="BoutonDetail" ><img src="css/images/imprimante.png" alt="Image de modification" width="35" height="35"></button></a></td>
              
              
                  <td><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php echo $id_bien; ?>')" class="btn btn-success" id="BoutonDetail">Modifier</button></td>
                
                
				  
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
    
        var donnees = {action:"REQUETE",id_bien:mat}; 
        console.log('{"action":"REQUETE","id_bien":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_proprietaire.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour =  '+mat);
			    sessionStorage.id_bien = mat;
                sessionStorage.even = "UPDATE";
				
				
						
		             	sessionStorage.apport_proprietaire = data.apport_proprietaire;
						sessionStorage.apport_cristal = data.apport_cristal;
						sessionStorage.Id_rehabilitation = data.Id_rehabilitation;
						sessionStorage.Libele_rehabilitation = data.Libele_rehabilitation;
						sessionStorage.loyer_proprietaire = data.loyer_proprietaire;
						sessionStorage.frais_agence = data.frais_agence;
						sessionStorage.id_commune = data.id_commune;
						sessionStorage.id_commission = data.id_commission;
						sessionStorage.libelle_commission = data.libelle_commission;
						sessionStorage.libelle_categorie_commune = data.libelle_categorie_commune;
						sessionStorage.id_bien = data.id_bien;
						sessionStorage.id_nbre_piece = data.id_nbre_piece;
						sessionStorage.libelle_piece = data.libelle_piece;
          				sessionStorage.prix_bien = data.prix_bien;
          				sessionStorage.quartier_bien = data.quartier_bien;
          				sessionStorage.impot_foncier = data.impot_foncier;
          				sessionStorage.loyer_percu = data.loyer_percu;
                 	    sessionStorage.Nbre_pieces = data.Nbre_pieces;
          				sessionStorage.description = data.description;
          				sessionStorage.nom_proprietaire = data.nom_proprietaire;
          				sessionStorage.prenoms = data.prenoms;
						sessionStorage.contact = data.contact;
						sessionStorage.e_mail = data.e_mail;
						sessionStorage.fonction = data.fonction;
						sessionStorage.localite = data.localite;
						sessionStorage.initial_proprietaire = data.initial_proprietaire;
						sessionStorage.num_ncc = data.num_ncc;
						sessionStorage.date_nais_proprietaire = data.date_nais_proprietaire;
						sessionStorage.lieu_nais_proprietaire = data.lieu_nais_proprietaire;
						sessionStorage.cni_proprietaire = data.cni_proprietaire;
						sessionStorage.id_type_bien = data.id_type_bien;
						sessionStorage.libelle_type_bien = data.libelle_type_bien;
						sessionStorage.id_charge_impot = data.id_charge_impot;
						sessionStorage.libelle_charge_impot = data.libelle_charge_impot;
						sessionStorage.lot = data.lot;
						sessionStorage.ilot = data.ilot;
						sessionStorage.libelle_charge = data.libelle_charge;
						sessionStorage.montant_impot = data.montant_impot;
						sessionStorage.num_appartement = data.num_appartement;
						sessionStorage.parcelle = data.parcelle;
						sessionStorage.id_charge = data.id_charge;
						sessionStorage.societe = data.societe;
						sessionStorage.id_categorie_bien = data.id_categorie_bien;
						sessionStorage.libelle_categorie_bien = data.libelle_categorie_bien;
						
						//Test d'affichage des données
                   console.log('je suis le libelle categorie bien'+data.libelle_categorie_bien);
          			
                }                       
                
            });
            
        $("#page-wrapper").load("proprietaire.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("proprietaire.php");
    });
	
    
    
</script>