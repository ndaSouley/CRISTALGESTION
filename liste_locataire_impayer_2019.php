 <?php
	session_start();
	if (!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false) {
		header('Location:index.php');
	}
	$profil = $_SESSION['TaxeUserData'][0]['id_profil'];
	$id_user = $_SESSION['TaxeUserData'][0]['id_user'];
	?>
 <?php

	include('dbconnexion.php');


	$query = "SELECT
							Count(proprietaire.id_proprietaire) AS nbre_proprietaire
							FROM
							proprietaire
							";


	if (mysqli_connect_errno()) {
		echo "[{\"ConnectError\":\"yes\"}]";
		//exit();
	} else {
		$mysqli->set_charset('utf8');

		$result = $mysqli->query($query);
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

			$nbre_proprietaire = utf8_decode($row['nbre_proprietaire']);
		}
	}
	//$date_jour_1 = date('m')-1;
	//$date_jour_1 = '11';
	$date_jour = date('y-m-d');
	//echo($date_jour);
	$mois_en_cours = date('m');
	$anne_en_cours = date('y');
	



	//echo $date_debut->diff($date_fin)->format("%m mois, %y annee and %i minuts");



	///**********************************************************/


	?>

 <div class="row">
 	<div class="col-lg-12">
 		<h4 class="page-header" align="center">
 			<!--TOTAL LOCATAIRE--><?php //echo(' ' . $nbre_proprietaire);
									?></h4>
 	</div>
 	<!-- /.col-lg-12 -->
 </div>
 <!-- /.row -->
 <div class="row">
 	<div class="col-lg-12">

 		<div class="panel panel-default panel-green">

 			<div class="panel-heading">
 				<div class="clearfix">
 					<h4 class="panel-title pull-left" style="padding-top: 7.5px;">ETAT DES IMPAYER </h4>

 				</div>
 			</div>
 			<!-- /.panel-heading -->
 			<div class="panel-body">
 				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
 					<thead>
 						<tr>
 							<!--  <th>Date Enrg</th>-->
 							<th>Code Locataire</th>
 							<th>Nom Locataire</th>
 							<th>Montant du bien </th>
 							<th>Mois </th>
 							<th>Année</th>
 							<!-- <th>Localite </th>
                              <th>Résidence</th>
                              <th>Mois</th>
                              <th>Moyen de paiement</th>
                              <th>Loyer</th>
                               <th>Action </th>
                               <th>Imprimer</th>
                                 <th>Modifier</th>-->

 						</tr>
 					</thead>
 					<tbody>
 						<?php

							//include('dbconnexion.php');
							//$mois_en_cours_3='05';
							$anne_en_cours_2 = '3';
							$date_expire = '2019/01/01 00:00:00';
							$date_debut = new DateTime($date_expire);
							$date_fin = new DateTime();
							$interval_mois = $date_debut->diff($date_fin)->format("%m");
							$interval_annee = $date_debut->diff($date_fin)->format("%y");
							$diff_total = $interval_annee * 12 + $interval_mois;
							$donnees = array();

							class Locataire
							{
								public $id_locataire;
								public $nom_locataire;
								public $prenoms_locataire;
								public $date_nais_locataire;
								public $lieu_nais_locataire;
								public $telephone_locataire;
								public $num_cni_sejour;
								public $fonction_locataire;
								public $e_maill_locataire;
								public $date_sortie;
								public $date_entree_locataire;
								public $prix_bien;
							}

							$liste_locataires = array();
							$id_annee = 2;
							$id_mois = 0;
							$str_mois = "";



							for ($i = 0; $i <= $diff_total; $i++) {
								/*$date = $date_debut;
				$date->$date_debut.('+'.$i.' months'); // or you can use '-90 day' for deduct
				$date = $date->format('Y-m-d h:i:s');
                echo $date. "<br>";*/
								$id_mois = $id_mois + 1;
								if ($id_mois < 10) {
									$str_mois = '0' . $id_mois;
								} else {
									$str_mois = $id_mois;
								}
								if ($id_mois > 12) {
									$id_mois = 1;
									$str_mois = "01";
									$id_annee = $id_annee + 1;
								}

								$effectiveDate = date('Y-m-d', strtotime($i . " months",  strtotime('2019/01/01'))) . "<br>";
								//echo $effectiveDate;

								/* $query = "SELECT * from locataire where date_entree_locataire<='".$effectiveDate."'";*/
								$query = "SELECT 
								locataire.id_locataire,
								locataire.nom_locataire,
								locataire.prenoms_locataire,
								bien.id_locataire as identifiant_locataire,
								bien.prix_bien
								from
								locataire 
								inner join bien on bien.id_locataire = locataire.id_locataire where locataire.date_entree_locataire<='" . $effectiveDate . "'
			  					ORDER BY locataire.nom_locataire";


								if (mysqli_connect_errno()) {
									echo "[{\"ConnectError\":\"yes\"}]";
									//exit();
								} else {

									$mysqli->set_charset('utf8');

									$result = $mysqli->query($query);
									$liste_id = array();
									while ($donnees = $result->fetch_array(MYSQLI_ASSOC)) {
										//$rows[] = utf8_encode($donnees);

										$loc = new Locataire();
										$loc->id_locataire = utf8_decode($donnees['id_locataire']);
										$loc->nom_locataire = utf8_decode($donnees['nom_locataire']);
										$loc->prenoms_locataire = utf8_decode($donnees['prenoms_locataire']);
										$loc->prix_bien = utf8_decode($donnees['prix_bien']);


										array_push($liste_id, $loc);
									}
									/*echo json_encode($liste_id);*/

									foreach ($liste_id as $valeur) {

										$req = "SELECT * from reglement_locataire where id_locataire='" . $valeur->id_locataire . "'
											AND id_annee ='" . $id_annee . "' and id_mois = '" . $str_mois . "'";


										$result_ok = $mysqli->query($req);
										if (mysqli_num_rows($result_ok) == 0) {
											/* echo $valeur->nom_locataire. ' ' . $valeur->prenoms_locataire. ' doit '. $valeur->prix_bien. ' pour le mois '.$str_mois. ' de l\' annee ' .$id_annee. '<br>';*/
											//$date_doc = date("d-m-Y H:i:s", strtotime($date_doc));
							?>

 										<tr>
 											<td><?php echo $valeur->id_locataire; ?></td>
 											<td><?php echo $valeur->nom_locataire . ' ' . $valeur->prenoms_locataire; ?></td>

 											<td><?php echo $valeur->prix_bien; ?></td>
 											<td><?php if ($str_mois == "01") {

														echo ("Janvier");
													} elseif ($str_mois == "02") {

														echo ("Février");
													} elseif ($str_mois == "03") {

														echo ("Mars");
													} elseif ($str_mois == "04") {

														echo ("Avil");
													} elseif ($str_mois == "05") {

														echo ("Mai");
													} elseif ($str_mois == "06") {

														echo ("Juin");
													} elseif ($str_mois == "07") {

														echo ("Juillet");
													} elseif ($str_mois == "08") {

														echo ("Août");
													} elseif ($str_mois == "09") {

														echo ("Septembre");
													} elseif ($str_mois == "10") {

														echo ("Octobre");
													} elseif ($str_mois == "11") {

														echo ("Novembre");
													} elseif ($str_mois == "12") {

														echo ("Décembre");
													}; ?></td>
 											<td><?php if ($id_annee == 2) {

														echo ("2019");
													} elseif ($id_annee == 3) {
														echo ("2020");
													}; ?></td>


 							<?php

										}
									}
								}
							}


								?>

 					</tbody>

 				</table>
 				<!-- /.table-responsive -->
 				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
 					<thead>
 						<tr>
 							<th height="51" colspan="15"><strong>
 									<font size="5">Montant Total</font>
 								</strong></th>

 							<th width="19%">
 								<font size="5"></font>
 							</th>
 							<!-- <th>Imprimer</th>
                                <th>Modifier</th>-->

 						</tr>
 					</thead>
 					<tbody>
 					</tbody>
 				</table>
 			</div>
 			<!-- /.panel-body -->
 		</div>
 		<!-- /.panel -->
 	</div>
 	<!-- /.col-lg-12 -->
 </div>

 <script>
 	$(document).ready(function() {
 		$('#dataTables-example').DataTable({
 			responsive: true,
 			"language": {
 				"search": "Recherche:",
 				"sZeroRecords": "Aucun enregistrements correspondants trouvés",
 				"sEmptyTable": "Aucune donnée disponible",
 				"paginate": {
 					"first": "First",
 					"last": "Last",
 					"next": "Suivant",
 					"previous": "Précédent"
 				}
 			}
 		});

 	});

 	$("#tbl1 button").click(function() {
 		alert($(this).closest("table").attr("id"));
 	});

 	function getMethod(idget) {
 		parentTable = element.parentNode;
 		alert(parentTable.id);
 		//alert($(idget).closest("td").attr("id"));
 	}

 	function ouvrefen_OK(mat) {

 		// var Vid_bien = 'je suis la';

 		var donnees = {
 			action: "REQUET_selecte_locataire",
 			V_id_bien: mat
 		};
 		console.log('{"action":"REQUET_selecte_locataire","V_id_bien":' + mat + '}');

 		$.ajax({
 			type: "POST",
 			url: "traitement_reglement_locataire.php",
 			data: donnees,
 			success: function(data) {

 				//console.log('retour');
 				console.log('retour =  ' + data.Vid_bien);
 				sessionStorage.id_bien = mat;
 				sessionStorage.even = "UPDATE";

 				// CALENDRIER DE PAIE



 				sessionStorage.Janvier = data.Janvier;
 				sessionStorage.Fevrier = data.Fevrier;
 				sessionStorage.Mars = data.Mars;
 				sessionStorage.Avril = data.Avril;
 				sessionStorage.Mai = data.Mai;
 				sessionStorage.Juin = data.Juin;
 				sessionStorage.Juillet = data.Juillet;
 				sessionStorage.Aout = data.Aout;
 				sessionStorage.Septembre = data.Septembre;
 				sessionStorage.Octobre = data.Octobre;
 				sessionStorage.Novembre = data.Novembre;
 				sessionStorage.Decembre = data.Decembre;

 				// CALENDRIER DE PAIE




 				sessionStorage.loyer_proprietaire = data.loyer_proprietaire;

 				console.log('retour bon =  ' + data.nom_locataire);


 				sessionStorage.id_bien = data.id_bien;
 				sessionStorage.Var_mt_total_travaux = data.Var_mt_total_travaux;
 				sessionStorage.mois_travaux = data.mois_travaux;
 				sessionStorage.ID_LOCATAIRE_Charge = data.ID_LOCATAIRE_Charge;
 				sessionStorage.charge_regle = data.charge_regle;
 				sessionStorage.prix_bien = data.prix_bien;
 				sessionStorage.nom_locataire = data.nom_locataire;
 				sessionStorage.prenoms_locataire = data.prenoms_locataire;
 				sessionStorage.id_charge = data.id_charge;
 				sessionStorage.mt_total_travaux = data.Var_mt_total_travaux;
 				sessionStorage.ID_LOCATAIRE_Charge = data.ID_LOCATAIRE_Charge;
 				sessionStorage.mois_travaux = data.mois_travaux;
 				sessionStorage.charge_regle = data.charge_regle;



 			}

 		});

 		$("#page-wrapper").load("detail_paiement.php");

 	}



 	$("#BoutonAjout").on('click', function() {
 		sessionStorage.even = "INSERT";
 		$("#page-wrapper").load("locataire.php");
 	});
 </script>