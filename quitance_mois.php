<?php
session_start();
if (!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false) {
  header('Location:index.php');
}
$profil = $_SESSION['TaxeUserData'][0]['id_profil'];
$id_user = $_SESSION['TaxeUserData'][0]['id_user'];

require_once 'dbconfig.php';

$date_ipression = date("Y-m-d H:i:s");
$date_jour = date("Y-m-d");

$date_ipression_ok = date("d-m-Y H:i:s", strtotime($date_ipression));
//echo"date impression " . $date_ipression_ok;

$Id_bien = $_GET['Id_bien_envoye'];
$mois_01 = "05";
$annee = "2";
$requete1 = "SELECT
					bien.id_bien,
					bien.id_type_bien,
					bien.prix_bien,
					bien.num_appartement,
					bien.nom_immeuble,
					bien.quartier_bien,
					locataire.id_locataire,
					locataire.nom_locataire,
					locataire.prenoms_locataire,
					reglement_locataire.id_reglement,
					reglement_locataire.id_locataire,
					reglement_locataire.id_bien,
					reglement_locataire.Loyer_locataire,
					reglement_locataire.id_mois,
					reglement_locataire.id_annee,
					reglement_locataire.date_reglement,
					annee.id_annee,
					annee.annee,
					reglement_locataire.id_annee,
					`user`.id_user,
					`user`.Nom_user,
					`user`.prenoms_user,
					reglement_locataire.id_user
					FROM
					bien
					INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire ,
					reglement_locataire ,
					annee ,
					`user`
					WHERE
					bien.id_bien='" . $Id_bien . "'
					and reglement_locataire.id_locataire=locataire.id_locataire 
					AND annee.id_annee=reglement_locataire.id_annee
					AND `user`.id_user=reglement_locataire.id_user
					";

// exécution de la requête
$resultat1 = $DBcon->query($requete1) or die(print_r($DBcon->errorInfo()));
// résultats
$donnees = array();
while ($donnees = $resultat1->fetch(PDO::FETCH_ASSOC)) {
  // je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
  //$donneess[] = utf8_encode($donnees);

  $id_bien = utf8_decode($donnees['id_bien']);
  $id_type_bien = utf8_decode($donnees['id_type_bien']);
  $prix_bien = utf8_decode($donnees['prix_bien']);
  $num_appartement = utf8_decode($donnees['num_appartement']);
  $nom_immeuble = utf8_decode($donnees['nom_immeuble']);
  $id_mois = utf8_decode($donnees['id_mois']);
  $quartier_bien = utf8_decode($donnees['quartier_bien']);
  $nom_locataire = utf8_decode($donnees['nom_locataire']);
  $prenoms_locataire = utf8_decode($donnees['prenoms_locataire']);
  $V_annee = utf8_decode($donnees['annee']);
  $id_reglement = utf8_decode($donnees['id_reglement']);
  $V_Nom_user = utf8_decode($donnees['Nom_user']);
  $V_prenoms_user = utf8_decode($donnees['prenoms_user']);
  $nom_complet_user = $V_Nom_user . '  ' . $V_prenoms_user;


  $nom_complet_locataire = $nom_locataire . '  ' . $prenoms_locataire;
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

  <table width="79%" border="0" align="center" cellpadding="0" cellspacing="4">
    <tr>
      <td height="578" valign="top">
        <table width="90%" border="0" align="center" cellspacing="0">
          <tr>
            <td width="30%" style="margin-top: 70%; margin-left: 50%; text-align: center;"><strong><img src="css/images/LOGO_CRISTAL_HOME_1.png" width="107" height="137" /></strong></td>
            <td width="60%">&nbsp;</td>
            <td width="13%"><strong><img src="css/images/logo_cristal_ok.png" width="218" height="97" /></strong></td>
          </tr>
        </table>
        <table width="106%" border="0" align="center" cellpadding="0" cellspacing="3">
          <tr>
            <td height="52" colspan="3">
              <table width="51%" height="98" align="center" cellspacing="2" bordercolor="#000000">
                <tr>
                  <td height="92"><strong>
                      <CENTER>
                        <h1>Quittance de Loyer</h1>
                      </CENTER>
                    </strong></td>
                </tr>
              </table>
              Référence: <?php echo ($nom_complet_user); ?>
              <!--        code ici
-->
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <table width="104%" border="0" align="center" cellspacing="6">
                <tr>
                  <td colspan="2" style="margin-left:20%">N°Appt: <?php echo ($num_appartement) ?> </td>
                  <td colspan="2" rowspan="2">Situation géographique:<?php echo ($quartier_bien); ?>.</td>
                  <td width="15%" rowspan="2">
                    <table width="11%" border="0" cellspacing="2">
                      <tr>
                        <td width="16%" height="37">
                          <h1>N°:<?php echo ($id_reglement); ?></h1>
                        </td>
                        <td width="84%" bgcolor="#F1F1F1">&nbsp;</td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">Date d'impression: <?php echo ($date_ipression_ok); ?></td>
                </tr>
                <tr>
                  <td width="28%" height="46"> loyer:<?php echo (' ' . number_format($prix_bien)); ?> FCFA </td>
                  <td width="16%" bgcolor="#F1F1F1"> </td>

                  <td colspan="3">Locataire:<?php echo (' ' . ' ' . '<strong>' . $nom_complet_locataire . '</strong>'); ?> </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td width="5%" height="31"><br /></td>
            <td width="77%" bgcolor="#F1F1F1">&nbsp;</td>
            <td width="18%" bgcolor="#F1F1F1">&nbsp;</td>
          </tr>
          <tr>
            <td>
              <p align="right">&nbsp;</p>
            </td>
            <td colspan="2">Pour la période de

              <?php if ($id_mois == '01') {
                echo '<Strong>Janvier/' . $V_annee . '</strong>';
              } elseif ($id_mois == '02') {
                echo '<Strong>Fevrier/' . $V_annee . '</strong>';
              } elseif ($id_mois == '03') {
                echo '<Strong>Mars/' . $V_annee . '</strong>';
              } elseif ($id_mois == '04') {
                echo '<Strong>Avril/' . $V_annee . '</strong>';
              } elseif ($id_mois == '05') {
                echo '<Strong>Mai/' . $V_annee . '</strong>';
              } elseif ($id_mois == '06') {
                echo '<Strong>Juin/' . $V_annee . '</strong>';
              } elseif ($id_mois == '07') {
                echo '<Strong>Juillet/' . $V_annee . '</strong>';
              } elseif ($id_mois == '08') {
                echo '<Strong>Août/' . $V_annee . '</strong>';
              } elseif ($id_mois == '09') {
                echo '<Strong>Septembre/' . $V_annee . '</strong>';
              } elseif ($id_mois == '10') {
                echo '<Strong>Octobre/' . $V_annee . '</strong>';
              } elseif ($id_mois == '11') {
                echo '<Strong>Novembre/' . $V_annee . '</strong>';
              } elseif ($id_mois == '12') {
                echo '<Strong>Decembre/' . $V_annee . '</strong>';
              }; ?>...des locaux qu'il occupe dans la maison située à <?php echo ($quartier_bien); ?></td>
            <td>&nbsp;</td>
          </tr>
          <!--<tr>
        <td height="26" valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td height="26" valign="top">&nbsp;</td>
      </tr>-->
          <tr>
            <td>
              <p align="center">&nbsp;</p>
            </td>
            <td><strong>NOTA</strong>: Un locataire ne peut deménager </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td valign="top">
              <p>&nbsp;</p>
            </td>
            <td valign="top">1 Qu'il n'ait justifié au propriétaire par une quittance du Receveur qu'il a acquitté toutes ses contributions personnelles et mobilières de l'année courante.</td>
            <td valign="top" width="18%">
              <p> </p>
            </td>
          </tr>
          <tr>
            <td>
              <p align="center"></p>
            </td>
            <td>2 Qu'il n'ait donné ou reçu congé par écrit dans les délais prescrits</td>
            <td><strong><u>Signature&amp; Cachet</u></strong>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <p>&nbsp;</p>
            </td>
            <td rowspan="2">3 Qu'il n'ait fait faire toutes les réparations locatives à sa charge
              suivant l'usage ou d'après l'état<br />
              des lieux s'il en existe un. </td>
            <td rowspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="37" valign="top">
              <p align="center">&nbsp;</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  ------------ --------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  <table width="79%" border="0" align="center" cellpadding="0" cellspacing="4">
    <tr>
      <td height="578" valign="top">
        <table width="90%" border="0" align="center" cellspacing="0">
          <tr>
            <td width="30%" style="margin-top: 70%; margin-left: 50%; text-align: center;"><strong><img src="css/images/LOGO_CRISTAL_HOME_1.png" width="107" height="137" /></strong></td>
            <td width="60%">&nbsp;</td>
            <td width="13%"><strong><img src="css/images/logo_cristal_ok.png" width="218" height="97" /></strong></td>
          </tr>
        </table>
        <table width="106%" border="0" align="center" cellpadding="0" cellspacing="3">
          <tr>
            <td height="52" colspan="3">
              <table width="51%" height="98" align="center" cellspacing="2" bordercolor="#000000">
                <tr>
                  <td height="92"><strong>
                      <CENTER>
                        <h1>Quittance de Loyer</h1>
                      </CENTER>
                    </strong></td>
                </tr>
              </table>
              Référence: <?php echo ($nom_complet_user); ?>
              <!--        code ici
-->
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <table width="104%" border="0" align="center" cellspacing="6">
                <tr>
                  <td colspan="2" style="margin-left:20%">N°Appt: <?php echo ($num_appartement) ?> </td>
                  <td colspan="2" rowspan="2">Situation géographique:<?php echo ($quartier_bien); ?>.</td>
                  <td width="15%" rowspan="2">
                    <table width="11%" border="0" cellspacing="2">
                      <tr>
                        <td width="16%" height="37">
                          <h1>N°:<?php echo ($id_reglement); ?></h1>
                        </td>
                        <td width="84%" bgcolor="#F1F1F1">&nbsp;</td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">Date d'impression: <?php echo ($date_ipression_ok); ?></td>
                </tr>
                <tr>
                  <td width="28%" height="46"> loyer:<?php echo (' ' . number_format($prix_bien)); ?> FCFA </td>
                  <td width="16%" bgcolor="#F1F1F1"> </td>

                  <td colspan="3">Locataire:<?php echo (' ' . ' ' . '<strong>' . $nom_complet_locataire . '</strong>'); ?> </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td width="5%" height="31"><br /></td>
            <td width="77%" bgcolor="#F1F1F1">&nbsp;</td>
            <td width="18%" bgcolor="#F1F1F1">&nbsp;</td>
          </tr>
          <tr>
            <td>
              <p align="right">&nbsp;</p>
            </td>
            <td colspan="2">Pour la période de

              <?php if ($id_mois == '01') {
                echo '<Strong>Janvier/' . $V_annee . '</strong>';
              } elseif ($id_mois == '02') {
                echo '<Strong>Fevrier/' . $V_annee . '</strong>';
              } elseif ($id_mois == '03') {
                echo '<Strong>Mars/' . $V_annee . '</strong>';
              } elseif ($id_mois == '04') {
                echo '<Strong>Avril/' . $V_annee . '</strong>';
              } elseif ($id_mois == '05') {
                echo '<Strong>Mai/' . $V_annee . '</strong>';
              } elseif ($id_mois == '06') {
                echo '<Strong>Juin/' . $V_annee . '</strong>';
              } elseif ($id_mois == '07') {
                echo '<Strong>Juillet/' . $V_annee . '</strong>';
              } elseif ($id_mois == '08') {
                echo '<Strong>Août/' . $V_annee . '</strong>';
              } elseif ($id_mois == '09') {
                echo '<Strong>Septembre/' . $V_annee . '</strong>';
              } elseif ($id_mois == '10') {
                echo '<Strong>Octobre/' . $V_annee . '</strong>';
              } elseif ($id_mois == '11') {
                echo '<Strong>Novembre/' . $V_annee . '</strong>';
              } elseif ($id_mois == '12') {
                echo '<Strong>Decembre/' . $V_annee . '</strong>';
              }; ?>...des locaux qu'il occupe dans la maison située à <?php echo ($quartier_bien); ?></td>
            <td>&nbsp;</td>
          </tr>
          <!--<tr>
        <td height="26" valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td height="26" valign="top">&nbsp;</td>
      </tr>-->
          <tr>
            <td>
              <p align="center">&nbsp;</p>
            </td>
            <td><strong>NOTA</strong>: Un locataire ne peut deménager </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td valign="top">
              <p>&nbsp;</p>
            </td>
            <td valign="top">1 Qu'il n'ait justifié au propriétaire par une quittance du Receveur qu'il a acquitté toutes ses contributions personnelles et mobilières de l'année courante.</td>
            <td valign="top" width="18%">
              <p> </p>
            </td>
          </tr>
          <tr>
            <td>
              <p align="center"></p>
            </td>
            <td>2 Qu'il n'ait donné ou reçu congé par écrit dans les délais prescrits</td>
            <td><strong><u>Signature&amp; Cachet</u></strong>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <p>&nbsp;</p>
            </td>
            <td rowspan="2">3 Qu'il n'ait fait faire toutes les réparations locatives à sa charge
              suivant l'usage ou d'après l'état<br />
              des lieux s'il en existe un. </td>
            <td rowspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="37" valign="top">
              <p align="center">&nbsp;</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

</body>

</html>