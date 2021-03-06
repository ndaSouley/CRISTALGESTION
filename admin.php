<?php
session_start();
if(!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}

$id_user=$_SESSION['TaxeUserData'][0]['id_user'];
?>

<!DOCTYPE html>
<html>
<style>
    li a:hover{
        text-decoration: none;
        color:#F30;
    }

</style>
<!-- Mirrored from polinova.ci/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Mar 2018 19:50:00 GMT -->
<head>

    <link href="css/images/logo.ico.png" rel="shortcut icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menu Principal .:: CRISTAL CONSTRUCTION ::.</title>
    <style type="text/css">
        .label_form {
            width:120px;
        }
    </style>
    <!-- Debut d'importation de style commune1 vers taxe-->
    <link rel="stylesheet" href="css/popupform.css"/>
    <!-- Fin  d'importation de style commune1 vers taxe-->
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
</head>
<body>
<div id="wrapper">


    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0;background-color:#002941">
      <div class="navbar-header text-center">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
        </button>

          <a class="navbar-brand text-center" href="#" style="margin-left:30px;">
          <strong><font size=6 color="#FFFFFF"><img src="css/images/Logo Template - Logo_18.png" width="154" height="39"  style=" margin-bottom:10px;margin-right:60x">
          </font></strong></a>

      </div>

        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
            <li style="color:#FFFFFF;margin-bottom:10px;"><?php echo($_SESSION['TaxeUserData'][0]['libelle'].' '.$_SESSION['TaxeUserData'][0]['prenoms_user']);?></li>

            <li class="col"><a href="deconnexion.php" style="color:white"><i class="fa fa-sign-out"><strong style="color:#0d0e0d"></strong></i></a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
        </ul>
        <div class="navbar-default sidebar">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li> <a class="nav-link" href="#" onClick="affiche('#');"><i class="fa fa-dashboard fa-fw" ></i> Menu</a> </li>
                    <li> <a href="#"><i class="fa fa-wrench fa-fw"></i> Paramètres<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="#" onClick="affiche('liste_utilisateur.php');">Compte Utilisateur</a> </li>
                            
                        </ul>
                    <li>
                        <!--<a href="#"><i class="fa fa-sitemap fa-fw"></i> Livraisons<span class="fa arrow"></span></a>-->
                        <ul class="nav nav-second-level">
                           
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-table fa-fw"></i> Gestion Immobilière<span class="fa arrow"></span></a>
                        
                        
                        <ul class="nav nav-second-level">
                            <li>
                                <li>
                        <a href="#"><i class="fa fa-table fa-fw"></i> Gestion Locative<span class="fa arrow"></span></a>
                        
                        
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#" onClick="affiche('liste_proprietaire.php');">Proprietaires</a>
                            </li>
                            <li>
                                <a href="#" onClick="affiche('liste_locataire.php');"> Location</a>
                            </li>
                            <li>
                                <a href="#" onClick="affiche('liste_locataire1.php');"> Liste des locataires</a>
                            </li>
                           <li>
                                <a href="#" onClick="affiche('liste_charge.php');"> Charges</a>
                            </li>
                            <li>
                                <a href="#" onClick="affiche('liste_charge_ok.php');"> Liste des Charges</a>
                            </li>
                            <li>
                        <a href="#"><i class="fa fa-table fa-fw"></i> COMPTABILITE<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#" onClick="affiche('liste_locataire_reglement.php');">Locataire</a>
                            </li>
                           <li>
                                <a href="#" onClick="affiche('liste_paiement_locataire.php');">Liste Reglement Locataire</a>
                            </li>
                            <li>
                                <a href="#" onClick="affiche('liste_proprietaire_a_regler.php');">Propriétaire à Régler</a>
                            </li>
                            <li>
                                <a href="#" onClick="affiche('liste_proprietaire_a_regler.php');">Impayer 2019</a>
                            </li>
                           
                           
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#" onClick="affiche('liste_reglement_proprietaire.php');">Proprietaire</a>
                            </li>
                           
                         
                           
                        </ul>
                        
                           
                        </ul>
                        
                        <!-- /.nav-second-level -->
                    </li>
                            
                           
                        </ul>
                        
                        <ul class="nav nav-second-level">
                            <li>
                                <li>
                        <a href="#"><i class="fa fa-table fa-fw"></i> Gestion des Ventes<span class="fa arrow"></span></a>
                        
                        
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#" onClick="affiche('liste_proprietaire_vente.php');">Proprietaires</a>
                            </li>
                            <li>
                                <a href="#" onClick="affiche('liste_reglement_proprietaire.php');">Biens en Ventes</a>
                            </li>
                            <li>
                                <a href="#" onClick="affiche('liste_locataire_impayer_2019.php');">Biens Vendus</a>
                            </li>
                           
                        </ul>
                        
                        <!-- /.nav-second-level -->
                    </li>
                            
                           
                        </ul>
                        
                     
                        
                        <!-- /.nav-second-level -->
                    </li>
                        
                        <!-- /.nav-second-level -->
                    </li>

                </ul>
            </div>

            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">

        <script type="text/javascript">
            
            // window.location = 'liste_contact.php';
        </script>
   <!-- <marquee style="
    margin-top:20px"> <font size="4" color="#FF0000">Cette Application est en plein Développement !!!</font></marquee><img src="css/images/image.png" width="900" height="250" style="margin-top:80px;margin-left:100px"></div>-->

</div>
<!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="vendor/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>

    function affiche(fen) {
        sessionStorage.even = "insert";
        $("#page-wrapper").empty();
        if (fen!=='non') {
        //    $("#page-wrapper").load(fen+".html"); 
            $("#page-wrapper").load(fen);

        }
    }

    $(document).ready(function() {

        $("#page-wrapper").load("dashoard.php");
	  
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
</script>

</body>

<!-- Mirrored from polinova.ci/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Mar 2018 19:50:10 GMT -->
</html>
