
<?php
session_start();
if(!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
$profil=$_SESSION['TaxeUserData'][0]['id_profil'];
$id_user=$_SESSION['TaxeUserData'][0]['id_user'];

require_once 'dbconfig.php';

$date_ipression=date("Y-m-d H:i:s");
$date_jour=date("Y-m-d");

$date_ipression_ok = date("d-m-Y H:i:s", strtotime($date_ipression));
//echo"date impression " . $date_ipression_ok;

$Id_bien=$_GET['Id_bien_envoye'];


$requete1 = "SELECT
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
					bien.date_enregistrement,
					bien.num_ncc,
					bien.id_charge,
					bien.id_commission,
					bien.loyer_proprietaire,
					bien.frais_agence,
					bien.disponiblite,
					bien.loyer_agence,
					bien.id_locataire,
					bien.id_charge_impot,
					bien.id_categorie_bien,
					bien.lot,
					bien.ilot,
					bien.num_appartement,
					bien.parcelle,
					bien.photo1,
					bien.nom_immeuble,
					bien.Nbre_place_garage,
					bien.id_user,
					bien.apport_proprietaire,
					bien.apport_cristal,
					bien.Id_rehabilitation,
					bien.montant_impot,
					locataire.id_locataire,
					locataire.nom_locataire,
					locataire.prenoms_locataire,
					locataire.date_nais_locataire,
					locataire.lieu_nais_locataire,
					locataire.telephone_locataire,
					locataire.num_cni_sejour,
					locataire.fonction_locataire,
					locataire.e_maill_locataire,
					locataire.date_sortie,
					locataire.date_entree_locataire,
					locataire.caution,
					locataire.frais_de_gestion,
					locataire.id_user,
					locataire.nature_carte,
					locataire.delivre_le,
					locataire.expire_le
					FROM
					bien
					INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire
					WHERE bien.id_bien='".$Id_bien."'";

				// exécution de la requête
				$resultat1 = $DBcon->query($requete1) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat1->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$donneess[] = utf8_encode($donnees);
					
					$id_bien = utf8_decode($donnees['id_bien']);
					$nom_locataire = utf8_decode($donnees['nom_locataire']);
					$prenoms_locataire = utf8_decode($donnees['prenoms_locataire']);
					$fonction_locataire = utf8_decode($donnees['fonction_locataire']);
					$nom_complet=$nom_locataire . ' ' . $prenoms_locataire;
					$date_nais_locataire = utf8_decode($donnees['date_nais_locataire']);
					$lieu_nais_locataire = utf8_decode($donnees['lieu_nais_locataire']);
					$description = utf8_decode($donnees['description']);
					$date_entree_locataire = utf8_decode($donnees['date_entree_locataire']);
					$prix_bien = utf8_decode($donnees['prix_bien']);
					$nature_carte = utf8_decode($donnees['nature_carte']);
					$delivre_le = utf8_decode($donnees['delivre_le']);
					$delivre_le_ok = date("d-m-Y", strtotime($delivre_le));
					$expire_le = utf8_decode($donnees['expire_le']);
					$expire_le_ok = date("d-m-Y", strtotime($expire_le));
					$num_cni_sejour = utf8_decode($donnees['num_cni_sejour']);
					$date_nais_locataire_BON_1 = date("d", strtotime($date_nais_locataire));
					$date_nais_locataire_BON_2 = date("m", strtotime($date_nais_locataire));
					$date_nais_locataire_BON_3 = date("Y", strtotime($date_nais_locataire));
					$date_jour_bon=date("d-m-Y");
					if($date_nais_locataire_BON_2=='01'){
						
					
						$MOIS='JANVIER';
						
						}elseif($date_nais_locataire_BON_2=='02'){
							
							
							$MOIS='FEVRIER';
							
							}elseif($date_nais_locataire_BON_2=='03'){
								
								
								$MOIS='MARS';
							
							
							}elseif($date_nais_locataire_BON_2=='04'){
								
								
								$MOIS='AVRIL';
							
							}elseif($date_nais_locataire_BON_2=='05'){
								
								
								 $MOIS='MAI';
							
							}elseif($date_nais_locataire_BON_2=='06'){
								
								
								 $MOIS='JUIN';
							
							}elseif($date_nais_locataire_BON_2=='07'){
								
								
								 $MOIS='JUILLET';
							
							
							}elseif($date_nais_locataire_BON_2=='08'){
								
							   $MOIS='AOÛT';
							   
							}elseif($date_nais_locataire_BON_2=='09'){
								
								
							
								$MOIS='SEPTEMBRE';
								
							}elseif($date_nais_locataire_BON_2=='10'){
								
								
								$MOIS='OCTOBRE';
							
							
							}elseif($date_nais_locataire_BON_2=='11'){
								
								$MOIS='NOVEMBRE';
							
							
							}elseif($date_nais_locataire_BON_2=='12'){
								
								$MOIS='DECEMBRE';
							
							
							}
					
				}
				?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans nom</title>

 <style>
 #table {
	font-size: 12.5px;
}
 td {
	text-align: justify;
}
 </style>

    </style>
</head>


<!--<input type="button" value="Imprimer" onClick="window.print()">-->

<body onload="window.print()">

<table width="68%" border="0" align="center" cellpadding="0" cellspacing="6">
  <tr>
    <td height="1226" valign="top"><table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td width="21%"><img src="css/images/logo_cristal_ok.png" width="236" height="94" /></td>
        <td width="66%">&nbsp;</td>
        <td width="13%"><strong><img src="css/images/LOGO_CRISTAL_HOME_1.png" width="117" height="146" /></strong></td>
      </tr>
    </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
      <tr>
        <td width="100%" height="52"><table width="55%" height="33" border="1" align="center" cellspacing="1" bordercolor="#000000">
          <tr>
            <td height="29" bgcolor="#CCCCCC"><strong><CENTER>
              <h3>CONTRAT DE BAIL A USAGE D'HABITATION</h3>
              </CENTER></strong></td>
            </tr>
          </table>
          <br />
          <!--        code ici
-->        </td>
      </tr>
      <tr>
        <td><p style="font-size:24px"><strong>  ENTRE</strong><br />
            <strong>CRISTAL <em>Home</em>,</strong> Agence Immobilière de <strong>CRISTAL  CONSTRUCTION</strong>, Société A  Responsabilité Limitée (SARL) au capital de 5&nbsp;000&nbsp;000 FCFA&nbsp;;  immatriculée au RCCM d&rsquo;Abidjan sous le N° CI-ABJ-2015-B-5356 siège social est  sis à Abidjan Cocody Riviera 3 les côtes, lot 307, 06 B.P. 554 ABIDJAN 06,  Tel.&nbsp;: 22&nbsp;47 24 64, Représentée  par sa gérante Madame MONKIE-ADUKO Marie-Reine, agissant au nom et comme mandataire du Propriétaire<strong></strong></p>
          <p  style="font-size:24px">Dénommé au cours du  présent acte «&nbsp;<strong>LE BAILLEUR</strong>&nbsp;».</p></td>
      </tr>
      <tr>
        <td height="21"><br /></td>
      </tr>
      <tr>
        <td><p align="right"><u>D&rsquo;UNE  PART</u></p></td>
      </tr>
      <tr>
        <td height="103" valign="top"><p style="font-size:24px"><strong>ET  <br />
        <?php echo($nom_complet);?>          ,<?php echo($fonction_locataire);?>, née le <?php echo($date_nais_locataire_BON_1 . ' ' .$MOIS . ' ' . $date_nais_locataire_BON_3);?> à <?php echo($lieu_nais_locataire);?>, titulaire de <?php echo($nature_carte);?> N° <?php echo($num_cni_sejour);?>. délivré le <?php echo($delivre_le_ok);?> et valable jusqu&rsquo;au <?php echo($expire_le_ok);?>.                           <br />
          Dénommé au cours du présent acte «&nbsp;LE PRENEUR&nbsp;».</strong></p>
</td>
      </tr>
      <tr>
        <td><p align="right"><u>D&rsquo;UNE  PART</u></p></td>
      </tr>
      <tr>
        <td valign="top"><p style="font-size:24px"><strong>LESQUELS </strong>  ont  convenu et arrêté le contrat de bail qui suit&nbsp;:</p></td>
      </tr>
      <tr>
        <td><p align="center" style="font-size:24px"><strong><u>BAIL</u></strong></p></td>
      </tr>
      <tr>
        <td valign="top"><p style="font-size:24px"> <p style="font-size:24px"> Le BAILLEUR donne à bail  à titre d&rsquo;habitation, pour une durée, sous les conditions et moyennant le prix  ci-après indiqués au PRENEUR qui accepte, les biens immobiliers dont la  désignation suit&nbsp;:</p></td>
      </tr>
      <tr>
        <td><p align="center" style="font-size:24px"><strong><u>DESIGNATION</u></strong></p></td>
      </tr>
      <tr>
        <td><p style="font-size:24px"> <?php echo($description);?>.</p></td>
      </tr>
      <tr>
        <td valign="top"><p style="font-size:24px"> <p style="font-size:24px"> Le PRENEUR déclare  connaître parfaitement le bien loué pour l&rsquo;avoir vu et visité en vue du présent  bail.</p></td>
      </tr>
      <tr>
        <td><p align="center" style="font-size:24px"><strong><u>ETAT DES LIEUX</u></strong></p></td>
      </tr>
      <tr>
        <td height="156" valign="top"><p style="font-size:24px"> <p style="font-size:24px"> Le PRENEUR prendra les lieux loués dans l’état où ils se trouveront lors de l’entrée en jouissance et les rendra en fin de bail tel qu’il les aura reçus suivant l’état des lieux dressé par les parties.
          A l’expiration du bail, le PRENEUR veillera à la remise des lieux dans leur état primitif (agencement, enduit, peinture intérieure, etc.)
        </p>
          <p style="font-size:24px">&nbsp;</p></td>
      </tr>
      <tr>
        <td><p align="center"><img src="css/images/line.png" width="829" height="9" /></p>
          <p align="center"  style="font-size:22px">CRISTAL  Construction,SARL au capital de 5 000 000 Francs CFA –<br />
            Siège  Social Abidjan Cocody RIVIERA 3 LES COTES, LOT 307 - 06 B.P 554 Abidjan 06<br />
            <a href="mailto:gestion@christalhome.net/">gestion@christalhome.net/</a> <a href="mailto:info@cristalhome.net">info@cristalhome.net</a> <br />
          Tél.&nbsp;: (225) 22  54-53-66 /47-50-32-89- RC N° CI-ABJ-2015-B-5356-  CCN°1509362 L          </p>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p></td>
      </tr>
      
    </table></td>
  </tr>
</table>
<table width="68%" border="0" align="center" cellpadding="0" cellspacing="6">
  <tr>
    <td height="1852" valign="top"><table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td width="21%"><img src="css/images/logo_cristal_ok.png" width="236" height="94" /></td>
        <td width="66%">&nbsp;</td>
        <td width="13%"><strong><img src="css/images/LOGO_CRISTAL_HOME_1.png" width="117" height="146" /></strong></td>
      </tr>
    </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
        <tr>
        <td height="1192"><table width="70%" height="33" border="1" align="center" cellspacing="1" bordercolor="#000000">
          <tr>
            <td height="29" bgcolor="#CCCCCC"><center>
              <h3><strong>TITRE I&nbsp;: CLAUSES ET  CONDITIONS PARTICULIERES</strong></h3>
              </center></td>
            </tr>
          </table>
         <p style="font-size:22px"> <strong> ARTICLE  1- DUREE DU BAIL</strong> </p>
          <p style="font-size:24px"> Le présent bail est  consenti et accepté pour une durée d&rsquo;une année entière, qui commence le <?php echo($date_entree_locataire);?> .pour  se terminer le 01 Le BAILLEUR ne peut pas rompre le bail avant le terme de la  première (1ère) année pour quelque raison que ce soit sauf pour  non-paiement du loyer.</p>
          <p style="font-size:22px"><strong>ARTICLE  2- RENOUVELLEMENT DU BAIL</strong> </p>
          <p style="font-size:24px"> A l&rsquo;expiration de la  première année, ledit bail se renouvellera par tacite reconduction. Il pourra  également être résilié à tout moment, à charge par celle des parties qui voudra  faire cesser le présent bail, de donner à l&rsquo;autre un préavis de trois (3) mois  par lettre remis contre décharge ou par acte d&rsquo;huissier.
         <p style="font-size:22px"><strong>ARTICLE  3- LOYER</strong> </p>
          <p style="font-size:24px"> Le présent bail est  consenti et accepté moyennant un loyer mensuel de <?php echo number_format($prix_bien); ?> FRANCS CFA payable par  mois et d&rsquo;avance, au plus tard le 05 du mois en espèces ou par chèque à l&rsquo;ordre  de CRISTAL Construction.<br />
            En cas de non paiement du  loyer jusqu&rsquo;au 10 du mois en cours, il sera majoré au locataire une pénalité de  10%.
         <p style="font-size:22px"><strong>  ARTICLE  4- REVISION DU LOYER</strong> </p>
          <p style="font-size:22px"> Les parties conviennent  que le loyer pourra être révisé tous les trois (3) ans. A défaut d&rsquo;accord entre  les parties, le nouveau montant du loyer prendra en compte le taux de référence  fixé annuellement par l&rsquo;Etat de Côte d&rsquo;Ivoire ou par tout organisme qualifié.  Dans tous les cas, l&rsquo;augmentation ne pourra dépasser les DIX POUR CENT (10%).
          <p style="font-size:22px"><strong>ARTICLE  5- DEPOT DE GARANTIE (ou CAUTION), FRAIS D&rsquo;AGENCE et PREMIER LOYER</strong> </p>
          <p style="font-size:24px"> A titre de provision et  pour la garantie de l&rsquo;exécution des clauses du présent contrat, le Preneur a  versé entre les mains du Bailleur, la somme de <?php echo number_format(2*$prix_bien);?>.  CFA représentant deux (2) mois de loyer en  guise de dépôt de garantie (ou caution).<br />
            Laquelle somme sera  conservée par le Bailleur pour le compte du Preneur durant toute la durée du  bail. Elle est non productive d&rsquo;intérêts et ne pourra pas servir au paiement du  loyer même en fin de bail.<br /> <p style="font-size:24px"> Il s&rsquo;acquittera également  d&rsquo;un mois de loyer de <?php echo number_format($prix_bien);?> CFA charges comprises et des frais d&rsquo;Agence équivalant  au même montant soit  <?php echo number_format($prix_bien);?> F CFA</p>
          <p style="font-size:24px"> A l&rsquo;expiration dudit  bail, le dépôt de garantie (ou caution) serait restitué au Preneur après  paiement de tous les loyers dus par lui et l&rsquo;exécution de toutes les  réparations lui incombant, ainsi que les résiliations CIE et SODECI faites sans  laisser d&rsquo;impayés.<br /> <p style="font-size:24px"> A cet effet, le Preneur  s&rsquo;engage à remettre au Bailleur, les quitus CIE et SODECI desquels il  ressortira qu&rsquo;il ne doit aucune somme à l&rsquo;égard desdits établissements, faute  de quoi, il autorise le Bailleur à payer pour son compte les sommes dues  auxdits établissements par déduction sur le dépôt de garantie (caution)  disponible.</p>
          <p style="font-size:22px"><strong>ARTICLE  6- DESTINATION DES LIEUX</strong></p><p style="font-size:24px"> Les lieux loués devront  servir au Preneur à usage d&rsquo;habitation à l&rsquo;exclusion de tout autre usage, même  temporairement.</p></td>
      </tr>
      <tr>
        <td height="105"><p align="center" style="font-size:22px"><img src="css/images/line.png" alt="" width="829" height="9" />CRISTAL  Construction,SARL au capital de 5 000 000 Francs CFA –<br />
Siège  Social Abidjan Cocody RIVIERA 3 LES COTES, LOT 307 - 06 B.P 554 Abidjan 06<br />
<a href="mailto:Cristalconstruction16@gmail.com/">gestion@christalhome.net/</a> <a href="mailto:info@cristalhome.net">info@cristalhome.net</a> <br />
Tél.&nbsp;: (225) 22  54-53-66 /47-50-32-89- RC N° CI-ABJ-2015-B-5356-  CCN°1509362 L</p>
          <p align="center" style="font-size:22px">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p></td>
      </tr>
  </table></td>
  </tr>
</table>
<table width="68%" border="0" align="center" cellpadding="0" cellspacing="6">
  <tr>
    <td height="1901" valign="top"><table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td width="21%"><img src="css/images/logo_cristal_ok.png" width="236" height="94" /></td>
        <td width="66%">&nbsp;</td>
        <td width="13%"><strong><img src="css/images/LOGO_CRISTAL_HOME_1.png" width="117" height="146" /></strong></td>
      </tr>
    </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
        <tr>
          <td height="795" valign="top"><table width="63%" height="33" border="1" align="center" cellspacing="1" bordercolor="#000000">
            <tr>
              <td height="29" bgcolor="#CCCCCC"><center>
                <h3><strong>TITRE II&nbsp;: CHARGES ET  CONDITIONS GENERALES</strong></h3>
              </center></td>
            </tr>
          </table>
          <p style="font-size:24px">Le présent bail est  consenti et accepté sous les charges et conditions ordinaires et de droit en  pareille matière que le Preneur, s&rsquo;oblige à exécuter et accomplir sous peine de  tous dommages- intérêts et même de résiliation immédiate du présent bail si bon  semblait au Bailleur, savoir&nbsp;:</p>
            <p style="font-size:24px"><strong>ARTICLE  7- CESSIONS DE BAIL OU SOUS-LOCATION<br />
            </strong>La présente location a  été consentie au Preneur «&nbsp;intuitu personae&nbsp;». Toute cession de bail,  sous-location ou simple occupation en tout ou partie des lieux par un tiers,  est rigoureusement interdite sous peine de résiliation immédiate du présent  contrat de location à la simple constatation de l&rsquo;infraction et sans qu&rsquo;il soit  besoin de recourir à la procédure de mise en demeure.</p>
          <p style="font-size:24px"><strong><font size="4">ARTICLE  8- MOBILIER</strong> </p> 
          <p style="font-size:24px"> Le Preneur s&rsquo;engage à  garnir les lieux loués, de meubles et objets mobiliers lui appartenant en  qualité de valeurs suffisantes pour répondre du paiement de loyers et de  l&rsquo;exécution de toutes les conditions du bail.</p>
          <p style="font-size:24px"><strong>ARTICLE  9- ENTRETIEN ET REPARATIONS</strong></p> <p style="font-size:24px"> Le Preneur entretiendra  les lieux loués en bon état de réparation locative, en jouira en bon père de  famille, suivant leur usage et ne pourra en aucun cas, rien faire ni laisser,  qui puisse les détériorer.<br />
            Il supportera toutes  réparations qui deviendraient nécessaires par la suite et toutes dégradations  résultant de son fait, ou de celui de sa famille ou de son personnel de maison. <br />
            Il aura entièrement à sa  charge, sans recours contre le Bailleur, l&rsquo;entretien&nbsp;:</p>
          <p style="font-size:24px"><strong>9.1  De la plomberie</strong> qui comprend la robinetterie, les  colonnes de douche, les chasses d&rsquo;eau des WC à l&rsquo;exclusion des canalisations  encastrées pour l&rsquo;adduction en eau potable.</p>
          <p style="font-size:24px"><strong>9.2  De l&rsquo;électricité</strong> qui comprend tous les appareils notamment  les interrupteurs, prises dismatics et les luminaires.</p>
          <p style="font-size:24px"><strong>9.3  Des aménagements intérieurs et réfection de la peinture</strong> qui comprennent les enduits, la propriété des sols, leur revêtement et  également la réfection des peintures intérieures tous les deux (2) ans. Il est  formellement interdit de changer les couleurs de l&rsquo;intérieur du bien loué sans  l&rsquo;autorisation préalable et par écrit du Bailleur; la peinture extérieur  restant à la charge du Bailleur qui procèdera à sa réfection tous les deux (2)  ans également.<br />
            Le Preneur veillera  également au bon entretien de la cour intérieure et aux abords du bien loué.<br />
            Les bris de glaces, la  détérioration des fenêtres, des châssis naccos, des grilles et volets  métalliques dus au fait que le Preneur ne les a pas fait fonctionner  régulièrement à l&rsquo;exception de ceux provoqués par guerres civiles, les émeutes  et tremblements de terre, resteront à la charge du Preneur qui en supportera  les réparations.<br />
            Le Preneur supportera  également toutes dégradations résultant de son fait ou de celui de son  prestataire dues à la pose d&rsquo;une antenne ayant abîmé la toiture du bien loué.<br />
            Le Preneur ne pourra  faire aucune installation électrique et câblage quelconque sans avoir obtenu  l&rsquo;accord préalable et par écrit du Bailleur.<br />
            Le Preneur devra  installer les appareils de climatisation et autres conformément aux règles de  l&rsquo;art notamment les compresseurs des splits à l&rsquo;extérieur sur des socles  appropriés. Le Preneur devra mettre des tuyaux pour l&rsquo;écoulement de l&rsquo;eau des  moteurs de climatisation de sorte que l&rsquo;eau ne s&rsquo;écoule pas sur les balcons,  les terrasses, les grilles métalliques, les volets roulants, les naccos et les  baies vitrées.<br />
          La première vidange des  fosses d&rsquo;aisance est à la charge du Bailleur, et les suivantes à la charge du Preneur.</p></td>
        </tr>
        <tr>
          <td height="97"><p align="center" style="font-size:21px"><img src="css/images/line.png" width="829" height="9" />CRISTAL  Construction,SARL au capital de 5 000 000 Francs CFA –<br />
Siège  Social Abidjan Cocody RIVIERA 3 LES COTES, LOT 307 - 06 B.P 554 Abidjan 06<br />
<a href="mailto:Cristalconstruction16@gmail.com/">gestion@christalhome.net/</a> <a href="mailto:info@cristalhome.net">info@cristalhome.net</a> <br />
Tél.&nbsp;: (225) 22  54-53-66 /47-50-32-89- RC N° CI-ABJ-2015-B-5356-  CCN°1509362 L</p></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="68%" border="0" align="center" cellpadding="0" cellspacing="6">
  <tr>
    <td height="1952" valign="top"><table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td width="21%"><img src="css/images/logo_cristal_ok.png" width="236" height="94" /></td>
        <td width="66%">&nbsp;</td>
        <td width="13%"><strong><img src="css/images/LOGO_CRISTAL_HOME_1.png" width="117" height="146" /></strong></td>
      </tr>
    </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
        <tr>
          <td height="1576" valign="top"><p style="font-size:24px"> Le Preneur devra aviser  le Bailleur, en temps utile, par lettre, par courrier électronique&nbsp;ou par  téléphone, des grosses réparations qu&rsquo;il serait nécessaire d&rsquo;effectuer dans les  lieux loués. 
            <p style="font-size:24px"><strong>ARTICLE  10- GROSSES REPARATIONS </strong></p>
            <p style="font-size:24px"> Le Bailleur ne sera tenu  d&rsquo;exécuter, au cours du bail, que les grosses réparations qui pourraient  devenir nécessaires (toiture, étanchéité, gros œuvres, etc.)&nbsp;; toutes  autres réparations quelles qu&rsquo;elles soient, restant à la charge du Preneur.<br /> <p style="font-size:24px"> Outre les dommages  résultant de vices de construction, le Bailleur ne sera en aucun cas  responsable des dégâts ou accidents occasionnés par les fuites d&rsquo;eau ou de gaz  et par l&rsquo;humidité et généralement pour tout autres cas de force majeure ainsi  que pour tout ce qui pourrait en être la conséquence direct ou indirect.</p>
            <p style="font-size:24px"> Le Preneur souffrira les grosses réparations et toute transformations  nécessaires que le Bailleur serait tenu d&rsquo;effectuer au cours du bail, quelles  qu&rsquo;en soient l&rsquo;importance et la durée sans pouvoir demander aucune indemnité ni  diminution ou non-paiement du loyer.
            <p style="font-size:24px"> <strong> ARTICLE  11- DEGRADATIONS ET VOLS</strong><br />
            Le Preneur est  responsable de toutes les dégradations ou vols quelconques qui pourraient être  commis par lui, par son personnel ou par des tiers dans les locaux loués et il  en supportera les conséquences. </p>
            <p style="font-size:24px"><strong>ARTICLE  12- AMENAGEMENTS-TRANSFORMATION-CONSTRUCTIONS</strong></p>
            <p style="font-size:24px"> Le Preneur ne pourra  faire aucun aménagement, aucune modification ou transformation de l&rsquo;état où de  la disposition des locaux, sans l&rsquo;autorisation préalable et écrit du Bailleur.
            <p style="font-size:24px"><strong>ARTICLE  13- REGLEMENTS URBAINS</strong> <br /> <p style="font-size:24px"> Le Preneur satisfera en  lieu et place du Bailleur à toutes les prescriptions de police, de voirie et  d&rsquo;hygiène de manière que le Bailleur ne soit pas inquiété à cet égard.</p>
            <p style="font-size:24px"><strong>ARTICLE  14- IMPOTS-PATENTES-TAXES LOCATIVES</strong> <br /> <p style="font-size:24px"> Le locataire  s&rsquo;acquittera, à partir du jour de l&rsquo;entrée en jouissance, en sus du loyer  ci-dessus fixé, de toutes contributions, taxes et autres, tous impôts afférents  à son occupation, à l&rsquo;exception des impôts fonciers qui resteront à la charge  du Bailleur.</p>
            <p style="font-size:24px"><strong>  ARTICLE  15- ASSURANCES</strong> <br />
            Le locataire s&rsquo;engage à  souscrire une assurance contre l&rsquo;incendie, les risques locatifs, le bris de  glaces et les recours des voisins et à maintenir cette assurance pendant le  cours du présent bail, à en acquitter exactement les primes et cotisations  annuelles et à justifier du tout à la première réquisition du Bailleur.</p>
            <p style="font-size:24px"><strong>ARTICLE  16- VISITE DES LIEUX</strong> <br /> <p style="font-size:24px"> En cas de mise en vente  ou de relocation du bien par le propriétaire, le Preneur devra laisser visiter  le Bailleur, ou les acquéreurs et locataires éventuels, chaque fois que le Bailleur  le jugera utile, à charge pour lui de prévenir le Preneur par lettre ou par  téléphone au moins 24 heures à l&rsquo;avance.</p>
            <p style="font-size:24px"><strong>  ARTICLE  17- REMISE DES CLES</strong></p>
<p style="font-size:24px">Le jour de l&rsquo;expiration  de la location, le Preneur devrait remettre au Bailleur les clés des locaux.  Dans le cas où, par le fait du Preneur, le Bailleur n&rsquo;aurait pu mettre en  location ou laisser visiter les lieux ou encore faire la livraison à un nouveau  locataire ou même  en reprendre la libre  disposition, à l&rsquo;expiration de la location, il aurait droit à une indemnité  égale à deux (2) mois de loyer, sans préjudice de tous dommages et intérêts.</td>
        </tr>
        <tr>
          <td height="210"><p align="center"><img src="css/images/line.png" width="829" height="9" /></p>
            <p align="center" style="font-size:22px">CRISTAL  Construction,SARL au capital de 5 000 000 Francs CFA –<br />
Siège  Social Abidjan Cocody RIVIERA 3 LES COTES, LOT 307 - 06 B.P 554 Abidjan 06<br />
<a href="mailto:Cristalconstruction16@gmail.com/">gestion@christalhome.net/</a> <a href="mailto:info@cristalhome.net">info@cristalhome.net</a> <br />
Tél.&nbsp;: (225) 22  54-53-66 /47-50-32-89- RC N° CI-ABJ-2015-B-5356-  CCN°1509362 L </p></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="68%" border="0" align="center" cellpadding="0" cellspacing="6">
  <tr>
    <td height="1901" valign="top"><table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td width="21%"><img src="css/images/logo_cristal_ok.png" width="236" height="94" /></td>
        <td width="66%">&nbsp;</td>
        <td width="13%"><strong><img src="css/images/LOGO_CRISTAL_HOME_1.png" width="117" height="146" /></strong></td>
      </tr>
    </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
        <tr>
          <td height="342" valign="top"><p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px"><strong>  ARTICLE  18- COPROPRIETE OU REGIME ASSIMILE</strong></p>
            <p style="font-size:24px"> <p style="font-size:24px"> Dans le cas où le bien  loué se trouverait en copropriété en raison de l&rsquo;existence de parties communes  ou de l&rsquo;usage d&rsquo;espaces, de services ou d&rsquo;équipements communs, le Bailleur et  le Preneur conviennent que les charges ou les cotisations pour l&rsquo;entretien des  parties communes seront à la charge exclusive du&nbsp;:</p>
            <p style="font-size:24px"> PRENUER (locataire)          OUI                                                      NON<br />
              BAILLEUR  (propriétaire)    OUI                                                      NON</p>
            <p style="font-size:24px"> <p style="font-size:24px"> Les parties conviennent  également que le montant retenu pourra être prélevé automatiquement sur les  factures CIE ou SODECI ou par tout organe désigné par les parties ou l&rsquo;Etat de  Côte d&rsquo;Ivoire.</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p>
            <p style="font-size:24px">&nbsp;</p></td>
        </tr>
        <tr>
          <td height="85"><p align="center"><img src="css/images/line.png" width="829" height="9" /></p>
            <p align="center" style="font-size:22px">CRISTAL  Construction,SARL au capital de 5 000 000 Francs CFA –<br />
Siège  Social Abidjan Cocody RIVIERA 3 LES COTES, LOT 307 - 06 B.P 554 Abidjan 06<br />
<a href="mailto:Cristalconstruction16@gmail.com/">gestion@christalhome.net/</a> <a href="mailto:info@cristalhome.net">info@cristalhome.net</a> <br />
Tél.&nbsp;: (225) 22  54-53-66 /47-50-32-89- RC N° CI-ABJ-2015-B-5356-  CCN°1509362 L </p></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="68%" border="0" align="center" cellpadding="0" cellspacing="6">
  <tr>
    <td height="578" valign="top"><table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td width="21%"><img src="css/images/logo_cristal_ok.png" width="236" height="94" /></td>
        <td width="66%">&nbsp;</td>
        <td width="13%"><strong><img src="css/images/LOGO_CRISTAL_HOME_1.png" width="117" height="146" /></strong></td>
      </tr>
    </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
      <tr>
        <td height="559" colspan="2" valign="top"><table width="70%" height="33" border="1" align="center" cellspacing="1" bordercolor="#000000">
          <tr>
            <td height="29" bgcolor="#CCCCCC"><center>
              <h3><strong>TITRE III&nbsp;:  ENREGISTREMENT ET REGLEMENT DES LITIGES</strong></h3>
            </center></td>
          </tr>
        </table>
          <p style="font-size:24px"><strong>ARTICLE  19- ENREGISTREMENT</strong> </p>
          <p style="font-size:24px"> <p style="font-size:24px"> Le présent formulaire de  bail est fourni par le BAILLEUR à ses frais.<br />
            L&rsquo;enregistrement du bail  est requis pour une année et demeure aux frais du PRENEUR.<br /> <p style="font-size:24px"> Le paiement des droits  d&rsquo;enregistrement des années successives demeure toujours à la charge du PRENEUR  et il s&rsquo;opèrera sur un formulaire portant renouvellement du bail fourni par le  BAILLEUR à ses frais.</p>
          <p style="font-size:24px"><strong>ARICLE  20- CLAUSE RESOLUTOIRE</strong></p>
          <p style="font-size:24px"> <p style="font-size:24px"> A défaut de paiement d&rsquo;un  seul terme de loyer ou d&rsquo;inexécution de l&rsquo;une des clauses du présent bail,  celui-ci sera résilié de plein droit, si bon semble au BAILLEUR, dix jours  après un commandement de payer ou de remplir les conditions en souffrance, par  acte d&rsquo;huissier, et demeuré sans effet.</p>
          <p style="font-size:24px"> <p style="font-size:24px"> Tous frais et honoraires  engagés à cet effet seront supportés par le locataire qui s&rsquo;y oblige.</p>
          <p style="font-size:24px"><strong>ARTICLE  21- ELECTION DE DOMICILE ET ATTRIBUTION DE JURIDICTION</strong> </p>
          <p style="font-size:24px"> <p style="font-size:24px"> Pour l&rsquo;exécution des  présentes et de leurs suites, les parties font élection de domicile en leur  domicile ou siège social indiqué au début du présent bail.</p> <p style="font-size:24px"> En outre, toutes les  contestations qui pourraient s&rsquo;élever pendant la durée du bail, pourront être  soumises à l&rsquo;arbitrage de tout organisme qualifié à cette fin et requis par les  parties, à défaut le litige sera soumis à la juridiction compétente de la  situation des lieux loués.
<p style="font-size:24px">&nbsp;</p></td>
      </tr>
      <tr>
        <td height="22"></td>
        <td height="22"><strong>DONT ACTE</strong></td>
        </tr>
      <tr>
        <td width="46%" height="22">&nbsp;</td>
        <td width="54%"><p style="font-size:24px">Fait  à&nbsp;Abidjan<br />
          En  (2) exemplaires originaux<br />
          Le   <?php echo ($date_jour_bon);?></p></td>
        </tr>
      <tr>
        <td height="22" colspan="2"><p align="center"><strong><u>LE BAILLEUR</u></strong>                                                                                           <strong><u>LE PRENEUR</u></strong></p></td>
      </tr>
      <tr>
        <td height="179" colspan="2"><p style="font-size:24px">&nbsp;</p>
          <p style="font-size:24px">&nbsp;</p>
          <p style="font-size:24px">&nbsp;</p>
          <p style="font-size:24px">&nbsp;</p>
          <p style="font-size:24px">&nbsp;</p>
          <p style="font-size:24px">&nbsp;</p>
          <p style="font-size:24px">&nbsp;</p>
          <p style="font-size:24px">&nbsp;</p>
          <p style="font-size:24px">&nbsp;</p></td>
      </tr>
      <tr>
        <td height="85" colspan="2"><p align="center"><img src="css/images/line.png" width="829" height="9" /></p>
          <p align="center" style="font-size:22px">CRISTAL  Construction,SARL au capital de 5 000 000 Francs CFA –<br />
Siège  Social Abidjan Cocody RIVIERA 3 LES COTES, LOT 307 - 06 B.P 554 Abidjan 06<br />
<a href="mailto:Cristalconstruction16@gmail.com/">gestion@christalhome.net/</a> <a href="mailto:info@cristalhome.net">info@cristalhome.net</a> <br />
Tél.&nbsp;: (225) 22  54-53-66 /47-50-32-89- RC N° CI-ABJ-2015-B-5356-  CCN°1509362 L </p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
