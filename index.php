<!DOCTYPE html>
<html lang="fr"  class="login_page">
    
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    
        <meta charset="utf-8">
        <title>Authentification .:: CRISTAL CONSTRUCTION ::. </title>        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Le styles -->
        <link href="css/images/logo.ico.png" rel="shortcut icon">
	<!--<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">-->
	<!--<link href="css/blue.css" media="screen" rel="stylesheet" type="text/css">-->
	<link href="css/style.css" media="screen" rel="stylesheet" type="text/css">
    <link href="css/animated.css" media="screen" rel="stylesheet" type="text/css">
	<!--<link href="lib/qtip2/jquery.qtip.min.css" media="screen" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=PT+Sans" media="screen" rel="stylesheet" type="text/css">	-->
    <head>
    <link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/mycss.css">
    <link href="css/style.css" media="screen" rel="stylesheet" type="text/css">
  
	
    </head>
      <div style="margin-top:60px">
    
    <body class="animated flip"> <div class="login_logo"><center><img src="css/images/logo_cristal_1_ok.png" alt="Logo Mairie" width="103" height="162" style="margin-bottom:15px"></center> <div align="center" style="margin-bottom:3px"><h6><strong><!--CRISTAL CONSTRUCTION--></strong></h6></div></div>

		<div class="login_box" style="margin-top:10px;">
			
			   <form role="form" method="post"  id="form" action="index.html">

					<div class="top_b">
						<h1 align="center">Authentification</h1>
					</div>    
						<div class="cnt_b">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon input-sm"><i class="glyphicon glyphicon-user"></i></span>
					    <input name="usrLogin" type="text" placeholder="Identifiant" id="usrLogin" autocomplete="off" class="form-control input-sm" value="">
							</div>
							</div>
                            </br>
                              
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon input-sm"><img src=" css/images/conn_lock.png"></span>
									<input name="usrPwd" type="password" id="usrPwd" placeholder="Mot de passe" autocomplete="off" class="form-control input-sm" value="">
								</div>
							</div>                                       
						</div>
				
					<div class="btm_b clearfix text-right">	
                   			
              <button class="btn btn-default" name="boutonresetlogin" type="reset" id="boutonresetlogin"> Annuler</button>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" name="btn_login" id="btn_login">Valider</button>
						<span class="link_reg"></span>
					</div>  
				</form>
			<div class="links_b links_btm clearfix">
					<span class="linkform">&copy; Copyright - CRISTAL CONSTRUCTION 2020 - Tous droits reserv&eacute;s</span>				
				</div>
			
		  </div>
				
		</div>
        
        
    </body>

</html>
 <div class="panel-body">
<div id="page-connexion">
</div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<script>
    
   // $("#boutonresetlogin").on('click', function(){
    //console.log("je suis dans le declencheur");
        //$("#includedContent").load("collecteur.php");
 $("#btn_login").on('click', function() {
//    alert("submit form");
    //e.preventDefault(e);

// Variables utilisateur
     var usrLogin = $('#usrLogin').val();
    var usrPwd = $('#usrPwd').val();
    var action = $('#action').val(); 
	 //var data = $('#login').val(); 
     console.log('usrLogin = '+usrLogin);
	console.log('usrPwd = '+usrPwd);
	
	
           var donnees = "{\"usrLogin\":\""+usrLogin+"\",\"usrPassword\":\""+usrPwd+"\"}";
			
	 /*var donnees = {action:"CONNEXION",
	 				usrLogin:usrLogin,
					usrPwd:usrPwd};*/
					
	              console.log('{"action":"CONNEXION","login":'+usrLogin+',"passe":'+usrPwd+'}');
					
//					console.log('{"id_abonn_serv":'+data.id_abonn_serv+',"montant_mensuel":'+ data.montant_mensuel+',"droit_de_place":'+ data.droit_de_place+'}');
					
					
				$.ajax({
                url:'traitement_connexion1.php',
                type:"POST",
                data:donnees,
                contentType:"application/json; charset=utf-8",
                dataType:"json",
                cache:false,
                timeout: 10000,
                success: function(data){
                    console.log('Gooooooooooooooooooo!d');
                    profil = data.id_profil;
					Id_statut = data.Id_statut;
					 			
                },
                error: function(r,e){
                    console.log('Echecccccccccccccccc!');
                    console.log('Erreur : '+e);
                    //console.dir(r);

                },
                complete: function(r,s){
                    console.log('Terminéeeeeeeeeeee!');
                    console.log('Envoyéeeeeeeeeeee : '+donnees);
                    console.dir(donnees);
                    console.log('Status :'+s);

                    var obj= $.parseJSON(r.responseText);

                    console.log('responseText :'+ r.responseText);
                    console.dir(obj);
					/*
                    $.each( obj, function( key, value ) {
                        //alert( key + ": " + value );
                        myresponse = value.retour;
                    });

					*/	
					myresponse = obj.retour;
						
                    //console.log('RETOUR :'+ myresponse);
//console.log('profil :'+ profil);
                    //setTimeout(function(){ $("#dialog-message2").dialog("close"); }, 10000);
                 if(myresponse == "GRANTED")
                    {
						if(profil==1 && Id_statut==1)
						{
							//console.log('Je suis dans le traitement');
							window.location.href="admin.php";
						}
						else if(profil==2 && Id_statut==1)
						 
						{
							window.location.href="admin_utilisateur.php";
						} else if(profil==3 && Id_statut==1){
							
							
							window.location.href="admin_DG.php";
							
						}
						else if(profil==4 && Id_statut==1 ){
							
							window.location.href="admin_chef_agence.php";
							
							}else if(profil==7 && Id_statut==1 ){
							
							window.location.href="admin_chef_agence.php";
							
							}else if(profil==5 && Id_statut==1){
							
							window.location.href="admin_comptabilite.php";
							
							}
                    }
                    else
                    {
						$.alert({
							title: 'Erreur!',
							content: 'Désolé login ou mot de passe incorrect !',
						});

                        //reactiver le boutton
                        /*$("#btnConnexion").attr("disabled", false);
                        $("#usrLogin").val("");
                        $("#usrPassword").val("");

                        //acces refuse
                        $("#dialog-message3").dialog("open");*/
                    }


                }
				
            });
	
					

});
</script> 
