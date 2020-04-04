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
 
require_once 'dbconfig.php';

$date_ipression=date("Y-m-d H:i:s");

$date_ipression_ok = date("d-m-Y", strtotime($date_ipression));
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
										bien.ilot,
										bien.frais_agence,
										charge_impot.id_charge_impot,
										charge_impot.libelle_charge_impot,
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
										INNER JOIN charge_impot ON bien.id_charge_impot = charge_impot.id_charge_impot
										INNER JOIN categorie_bien ON categorie_bien.id_type_bien = type_bien.id_type_bien AND bien.id_categorie_bien = categorie_bien.id_categorie_bien
							WHERE
							bien.id_bien='".$Id_bien."'";

				// exécution de la requête
				$resultat1 = $DBcon->query($requete1) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat1->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$donneess[] = utf8_encode($donnees);
					
					$id_proprietaire = utf8_decode($donnees['id_proprietaire']);
					$nom_proprietaire = utf8_decode($donnees['nom_proprietaire']);
					$prenoms = utf8_decode($donnees['prenoms']);
					$contact = utf8_decode($donnees['contact']);
					$e_mail = utf8_decode($donnees['e_mail']);
					$fonction = utf8_decode($donnees['fonction']);
					$localite = utf8_decode($donnees['localite']);
					$date_nais_proprietaire = utf8_decode($donnees['date_nais_proprietaire']);
					$lieu_nais_proprietaire = utf8_decode($donnees['lieu_nais_proprietaire']);
					$cni_proprietaire = utf8_decode($donnees['cni_proprietaire']);
					$initial_proprietaire = utf8_decode($donnees['initial_proprietaire']);
					$montant_impot = utf8_decode($donnees['montant_impot']);
					$lieu_nais_proprietaire = utf8_decode($donnees['lieu_nais_proprietaire']);
					$impot_foncier = utf8_decode($donnees['impot_foncier']);
					$V_libelle_type_bien = utf8_decode($donnees['libelle_type_bien']);
					$V_libelle_categorie_commune = utf8_decode($donnees['libelle_categorie_commune']);
					$V_quartier_bien = utf8_decode($donnees['quartier_bien']);
					$V_libelle_categorie_bien = utf8_decode($donnees['libelle_categorie_bien']);
					$V_libelle_piece = utf8_decode($donnees['libelle_piece']);
					
					$nom_complet_proprietaire=$nom_proprietaire. '  ' . $prenoms;
					
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
    <td height="578" valign="top"><table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td width="21%"><img src="css/images/logo_cristal_ok.png" width="236" height="94" /></td>
        <td width="66%">&nbsp;</td>
        <td width="13%"><strong><img src="css/images/logo_cristal_1_ok.png" width="97" height="122" /></strong></td>
      </tr>
    </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
      <tr>
        <td width="100%" height="52"><table width="55%" height="33" border="1" align="center" cellspacing="1" bordercolor="#000000">
          <tr>
            <td height="29" bgcolor="#CCCCCC"><strong><CENTER>
              <h3>MANDAT DE GESTION EXCLUSIVE</h3>
              </CENTER></strong></td>
            </tr>
          </table>
          <br />
          <!--        code ici
-->        </td>
      </tr>
      <tr>
        <td><hr size="1" /></td>
      </tr>
      
      <tr>
        <td><p>Entre les soussignés :</p></td>
      </tr>
      <tr>
        <td><p>Nom et Prénoms: ................<?php echo($nom_complet_proprietaire);?>....................................................................</p></td>
      </tr>
      <tr>
        <td><p>Né(e) le: ..............................<?php echo($date_nais_proprietaire);?>..................................................................</p></td>
      </tr>
      <tr>
        <td><p>Profession execercée:..........<?php echo($fonction);?>..............................................................</p></td>
      </tr>
      
      <tr>
        <td><p>Adresse: ..............................<?php echo($localite);?>........................................................</p></td>
      </tr>
      <tr>
        <td><p>Téléphone : ..........................<?php echo($contact);?>................................................</p></td>
      </tr>
      <tr>
        <td><p>E-mail: .................................<?php echo($e_mail);?>...................................................</p></td>
      </tr>
      <tr>
        <td height="17"><p>Titre Foncier: ......................<?php echo($impot_foncier);?>..................................................</p></td>
      </tr>
      <tr>
        <td height="21"><br />
          Dénommé(e) le &quot;<strong>MANDAT</strong>&quot; ou &quot;<strong>PROPRIETAIRE</strong>&quot;</td>
      </tr>
      <tr>
        <td><p align="right"><u>D&rsquo;UNE  PART</u></p></td>
      </tr>
      <tr>
        <td height="378"><p><strong>CRISTAL HOME, </strong>Agence Immobilière de<strong> CRISTAL CONSTRUCTION</strong>, Socièté A Responsabilité limitée(SARL) au capital de 5 000 000 FCFA, immatriculée au RCCM d&rsquo;Abidjan sous le N° CIABJ-2015-B-5356 siège social est sis à Abidjan Cocody Riviera 3 les côtes,  lot 307, 06 B.P. 554 ABIDJAN 06, Tel.&nbsp;: 22&nbsp;47 24 64, Représentée par  sa gérante Madame MONKIE-ADUKO Marie-Reine, dûment habilitée aux  fins des présentes, </p>
          <p align="left">Dénommé(e)  le &ldquo; <strong>MANDATAIRE</strong>&nbsp;&rdquo; ou &ldquo; <strong>CRISTAL Home</strong>&nbsp;&rdquo;<u><br />
            D&rsquo;AUTRE  PART</u> </p>
          <p>Il a été  arrêté et convenu ce qui suit&nbsp;:<br />
            Le MANDANT susnommé confère au  MANDATAIRE qui l&rsquo;accepte, mandat exclusif d&rsquo;administrer aux conditions inscrites dans le  présent contrat l&rsquo;immeuble suivant dont le Mandant est propriétaire&nbsp;: </p>
          <p><?php echo($V_libelle_categorie_bien);?> de <?php echo($V_libelle_piece);?> Situé à <?php echo($V_quartier_bien);?> <?php echo($V_libelle_categorie_commune);?></p>
          <p>Le Mandant affirme avoir la propriété  des dits biens en vertu d&rsquo;un titre régulier. Le propriétaire souscrit à  l&rsquo;assurance des locaux tandis que le preneur souscrit à l&rsquo;assurance de ses  biens. </p></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><p align="center"><img src="css/images/line.png" width="829" height="9" /></p>
          <p align="center">CRISTAL  Construction,SARL au capital de 5 000 000 Francs CFA –<br />
            Siège  Social Abidjan Cocody RIVIERA 3 LES COTES, LOT 307 - 06 B.P 554 Abidjan 06<br />
            <a href="mailto:Cristalconstruction16@gmail.com/">Cristalconstruction16@gmail.com/</a> <a href="mailto:info@cristalhome.net">info@cristalhome.net</a> <br />
          Tél.&nbsp;: (225) 22  47 24 64 /47-50-32-89- RC N° CI-ABJ-2015-B-5356-  CCN°1509362 L</p></td>
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
        <td width="13%"><strong><img src="css/images/logo_cristal_1_ok.png" width="97" height="122" /></strong></td>
      </tr>
    </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
      <tr>
        <td colspan="3"><p>&nbsp; </p>
          <p><strong><u>DUREE</u></strong> <br />
            Le  présent mandat est consenti pour une durée d&rsquo;un (1) an à compter du jour de  signature du bail avec un locataire ou preneur, renouvelable par tacite  reconduction, sauf dénonciation par lettre recommandée avec accusé de réception  trois mois avant chaque expiration annuelle.<br />
            Le  propriétaire ne devra pas traiter directement avec le ou les locataires sans  l&rsquo;assistance de CRISTAL Home.<br />
            <strong><u>OBLIGATIONS DU MANDATAIRE</u></strong><br />
            CRISTAL Home rendra compte de sa gestion tous les trimestres en un  état détaillé de ce qu&rsquo;il aura perçu et dépensé.<br />
            •	Il pourra conclure, faire proroger et renouveler tous les baux, aux charges et conditions qu’il avisera, les résilier, donner ou accepter tous les congés, faire dresser l’état des lieux, le tout en préservant les intérêts du propriétaire ; en outre, toute modification du loyer se fera avec l’accord préalable et écrit du Propriétaire ;
            •	Percevoir tous les loyers d’avance ; 
            •	Assurer le règlement du loyer d’avance au propriétaire, au plus tard le 15 de chaque mois pour la période d’occupation des lieux ; <br />
            •	Assurer l’occupation paisible par le locataire du bien (prise en charge urgente des problèmes d’étanchéité, de rupture de tuyauterie…) ;
            •	Signaler au propriétaire la vacance du bien justifiant le non règlement de loyer ;
            •	Percevoir les cautions et dépôts de garantie et les restituer dans les délais et aux conditions prévues au contrat de bail ; <br />
            •	Exécuter tous les travaux afférents au Propriétaire après accord des devis, sauf réparations d’urgence (rupture de canalisations d’eau, court-circuit électrique) ;
            •	De toutes les sommes reçues ou payées, donner et retirer quittance, opérer le retrait de toutes sommes consignées, remettre tous les titres de pièces, en donner ou retirer décharge ; <br />
            •	A défaut de paiement, exercer toutes poursuites judiciaires, faire tous commandements, Sommations, assignations et citations devant les tribunaux compétents, concilier ou requérir des jugements, les faire signifier et exécuter
            •	En cas de mise en vente du bien par le propriétaire, CRISTAL Home aura la priorité de trouver un acquéreur, et une commission lui sera versée si le bien est vendu. <br />
            Aux  effets ci-dessus, passer et signer tous les actes, élire domicile, donner tous  les pouvoirs, substituer une ou plusieurs personnes dans tous ou partie des  présents pouvoirs, révoquer tous les mandats ou substitutions et généralement  faire tout ce que le Mandataire jugera utile et nécessaire.<br />
            <strong><u>OBLIGATIONS DU MANDANT</u></strong><br />
            Le Mandant  doit&nbsp;:</p>
          <ul>
            <li>Ne pas traiter directement avec les  clients logés par le mandataire&nbsp;;</li>
            <li>Prendre en charge les grosses  réparations qui lui incombent&nbsp;;</li>
            <li>Rembourser au mandataire les frais ou  avances occasionnés par diverses réparations à la charge du mandant&nbsp;;</li>
            <li>Adresser au  mandataire les quittances de règlement des impôts fonciers.<br />
              <p><strong><u>REMUMERATION</u></strong><br />
                Le Mandataire  percevra des honoraires mensuels de gestion de 10% à partir du ……………….. Ces  honoraires seront à la charge exclusive du Mandant lesquels seront prélevés par  le Mandataire sur chaque loyer mensuel. Elle ne fait pas obstacle à la fixation  et à l&rsquo;encaissement  d&rsquo;honoraires de location et de rédaction de bail à la charge des locataires des  immeubles gérés, fixés, d&rsquo;après les usages locaux, les arrêtés ou convention en  vigueur.&nbsp;</p>
              <p><strong><u>DEPOT DE GARANTIE OU CAUTION</u></strong></p>
              <p>Les dépôts de  garantie seront administrés par le Mandataire pour répondre des dégâts qui  pourraient être causés&nbsp;aux biens loués et aux objets mobiliers ou autres  garnissant les lieux loués ainsi qu&rsquo;aux différentes charges et consommations. </p>
              <p>Cette somme encaissée  sera restituée dans les meilleurs délais déduction faite éventuellement des  objets remplacés, des frais éventuels de remise en état, de ménage  complémentaire et autres sommes pouvant être dues par le locataire destinée à  garantir l'exécution des obligations locatives au départ du locataire. </p>
              <p><strong><u>INTEGRALITE DE L'ACCORD DES PARTIES</u></strong><br />
                Le présent  mandat représente l'intégralité de l'accord entre les parties eu égard à son  objet. Il annule et remplace tous engagements verbaux ou écrits qui lui sont  antérieurs.<br />
                Il ne pourra être modifié que par un acte écrit signé  des deux parties. </p>
              <p>&nbsp;</p>
              </li>
          </ul></td>
      </tr>
      <tr>
        <td width="18%" height="41">&nbsp;</td>
        <td width="84%" height="41" colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="85" colspan="3"><p align="center"><img src="css/images/line.png" width="829" height="9" /></p>
          <p align="center">CRISTAL  Construction,SARL au capital de 5 000 000 Francs CFA –<br />
            Siège  Social Abidjan Cocody RIVIERA 3 LES COTES, LOT 307 - 06 B.P 554 Abidjan 06<br />
  <a href="mailto:Cristalconstruction16@gmail.com/">Cristalconstruction16@gmail.com/</a> <a href="mailto:info@cristalhome.net">info@cristalhome.net</a> <br />
          Tél.&nbsp;: (225) 22  47 24 64 /47-50-32-89- RC N° CI-ABJ-2015-B-5356-  CCN°1509362 L</p></td>
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
        <td width="13%"><strong><img src="css/images/logo_cristal_1_ok.png" width="97" height="122" /></strong></td>
      </tr>
    </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
      <tr>
        <td height="795" valign="top"><p>&nbsp;</p>
          <ul>
            <li>
              <p><strong><u>DROIT APPLICABLE / ELECTION DE DOMICILE   </u></strong><br />
                Tout  litige auquel le contrat pourrait donner lieu, et notamment pour son exécution  ou son interprétation, relèvera de la compétence du Tribunal d&rsquo;Abidjan.<br />
                Pour  l&rsquo;exécution du contrat et de ses suites, les Parties font élection de domicile  à leur siège social et domicile respectif tel qu&rsquo;il figure en tête de la  présente. </p>
              <p>Fait à Abidjan   ……....<?php echo($date_ipression_ok);?>.…….....</p>
              <p>En deux exemplaires originaux dont chacune des parties  reconnaît avoir reçu le sien. </p>
              </li>
          </ul>
          <table width="90%" align="center" cellspacing="2">
            <tr>
              <td width="31%" height="83"><strong><center>LE(S) MANDANT(S)</center></strong></td>
              <td width="35%">&nbsp;</td>
              <td width="34%"><strong><center>LE MANDATAIRE<br />
(CRISTAL HOME) </center></strong></td>
            </tr>
            <tr>
              <td height="56"><center>Bon pour mandat</center></td>
              <td>&nbsp;</td>
              <td><center>Bon pour acceptation de mandat</center></td>
            </tr>
          </table>
          <p>&nbsp;</p></td>
      </tr>
      <tr>
        <td height="85"><div align="center"><br />
        </div></td>
        </tr>
      <tr>
        <td height="85"><div align="center"><br />
        </div></td>
        </tr>
      <tr>
        <td height="85"><p align="center"><img src="css/images/line.png" width="829" height="9" /></p>
          <p align="center">CRISTAL  Construction,SARL au capital de 5 000 000 Francs CFA –<br />
            Siège  Social Abidjan Cocody RIVIERA 3 LES COTES, LOT 307 - 06 B.P 554 Abidjan 06<br />
            <a href="mailto:Cristalconstruction16@gmail.com/">Cristalconstruction16@gmail.com/</a> <a href="mailto:info@cristalhome.net">info@cristalhome.net</a> <br />
            Tél.&nbsp;: (225) 22  47 24 64 /47-50-32-89- RC N° CI-ABJ-2015-B-5356-  CCN°1509362 L</p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
