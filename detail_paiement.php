<?php
session_start();
if(!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
//$profil=$_SESSION['TaxeUserData'][0]['id_profil'];
$id_user=$_SESSION['TaxeUserData'][0]['id_user'];

?><head>
<link rel="stylesheet" href="css/popupform.css"/>

</head>


<div class="row">
    <div class="col-lg-12">
    <table width="100%" style="margin-top:10px;" >
  <tr>
    <td width="18%"> <h4>DETAIL DU LOCATAIRE :</h4></td>
    <td id="monDiv" style="font-size:20px;">
   </td>
  </tr>
</table>

 
     
    
    <!-- /.col-lg-12 -->
</div>


<div class="row">
        <div class="col-lg-12" style="margin-top:15px;">
        
            <div class="panel panel-default panel-green">
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">CALENDRIER DE PAIE DU LOCATAIRE ANNEE: 2020 </h4>
                  
                </div> 
              </div>
                <!-- /.panel-heading -->
               <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Janvier</th>
                              <th>Fevrier</th>
                                <th>Mars</th>
                              <th>Avril </th>
                              <th>Mai</th>
                              <th>Juin</th>
                              <th>Juillet</th>
                              <th>Août</th>
                              <th>Septembre</th>
                              <th>Octobre</th>
                              <th>Novembre</th>
                              <th>Decembre</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                        
			
		<tr>     <td><div id="janvier"></td>
                <td><div id="Fevrier"></td>
                <td><div id="Mars"></td>
                <td><div id="Avril"></td>
                <td><div id="Mai"></td>
                <td><div id="Juin"></td>
                <td><div id="Juillet"></td>
                <td><div id="Aout"></td>
                <td><div id="Septembre"></td>
                 <td><div id="Octobre"></td>
                  <td><div id="Novembre"></td>
                   <td><div id="Decembre"></td>
                </tr>
               
                        </tbody>
                    </table>
                     <div class="col-lg-12">
            <div class="panel-footer text-right">
              <button class="btn btn-danger" name="BoutonResetCollecteur" type="reset" id="BoutonResetCollecteur"> Abandonner</button>
                
                
            </div>
        </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    

 
 
<script>
    
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }
	
	
function ouvrefen(mat)

    {
		var id_user = $('#id_user').val();
		var envoi = $('#envoi').val();
    //var mat = mle;
    
        var donnees = {action:"ENVOI",id_user:mat}; 
        console.log('{"action":"ENVOI","id_user":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_reglement_locataire.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour = '+data.Motif);
			    
				
				}
                
            });
            
        //$("#page-wrapper").load("proprietaire.php");
    }
   
		

$(document).ready(function() {
	
	$("#BoutonResetCollecteur").on('click', function(){
    //console.log("je suis dans le declencheur");
        $("#page-wrapper").load("liste_paiement_locataire.php");
    });
	
	
	if(sessionStorage.even == "UPDATE"){
		
		
		
    document.getElementById("monDiv").innerHTML = sessionStorage.nom_locataire + ' ' +sessionStorage.prenoms_locataire;
	
	
	if(sessionStorage.id_annee==1){
		
		
		if(sessionStorage.Janvier==1){
		
		janvier.disabled = true;
		
		document.getElementById("janvier").innerHTML="SOLDÉ";
		document.getElementById("janvier").style.color="green";
		
		
		}else if(sessionStorage.Janvier==0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML="IMPAYÉ";
			document.getElementById("janvier").style.color="red";
			
			}
			else if(sessionStorage.Janvier!=1 && sessionStorage.Janvier!=0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML=sessionStorage.Janvier;
			document.getElementById("janvier").style.color="red";
			
			}
			
			
			if(sessionStorage.Fevrier==1){
		
		janvier.disabled = true;
		
		document.getElementById("Fevrier").innerHTML="SOLDÉ";
		document.getElementById("Fevrier").style.color="green";
		
		
		}else if(sessionStorage.Fevrier==0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML="IMPAYÉ";
			document.getElementById("Fevrier").style.color="red";
			
			}else if(sessionStorage.Fevrier!=1 && sessionStorage.Fevrier!=0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML=sessionStorage.Fevrier;
			document.getElementById("Fevrier").style.color="red";
			
			}
			if(sessionStorage.Mars==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mars").innerHTML="SOLDÉ";
		document.getElementById("Mars").style.color="green";
		
		
		}else if(sessionStorage.Mars==0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML="IMPAYÉ";
			document.getElementById("Mars").style.color="red";
			
			}else if(sessionStorage.Mars!=1 && sessionStorage.Mars!=0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML=sessionStorage.Mars;
			document.getElementById("Mars").style.color="red";
			
			}
			
			if(sessionStorage.Avril==1){
		
		janvier.disabled = true;
		
		document.getElementById("Avril").innerHTML="SOLDÉ";
		document.getElementById("Avril").style.color="green";
		
		
		}else if(sessionStorage.Avril==0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML="IMPAYÉ";
			document.getElementById("Avril").style.color="red";
			
			}else if(sessionStorage.Avril!=1 && sessionStorage.Avril!=0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML=sessionStorage.Avril;
			document.getElementById("Avril").style.color="red";
			
			}
			if(sessionStorage.Mai==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mai").innerHTML="SOLDÉ";
		document.getElementById("Mai").style.color="green";
		
		
		
		}else if(sessionStorage.Mai==0){
			janvier.disabled = true;
			document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").style.color="red";
			
			
			}else if(sessionStorage.Mai!=1 && sessionStorage.Mai!=0){
			janvier.disabled = true;
			//document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").innerHTML=sessionStorage.Mai;
			document.getElementById("Mai").style.color="red";
			
			
			}
			if(sessionStorage.Juin==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juin").innerHTML="SOLDÉ";
		document.getElementById("Juin").style.color="green";
		
		
		}else if(sessionStorage.Juin==0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML="IMPAYÉ";
			document.getElementById("Juin").style.color="red";
			
			}else if(sessionStorage.Juin!=1 && sessionStorage.Juin!=0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML=sessionStorage.Juin;
			document.getElementById("Juin").style.color="red";
			
			}
			if(sessionStorage.Juillet==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juillet").innerHTML="SOLDÉ";
		document.getElementById("Juillet").style.color="green";
		
		
		}else if(sessionStorage.Juillet==0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML="IMPAYÉ";
			document.getElementById("Juillet").style.color="red";
			
			
			}else if(sessionStorage.Juillet!=1 && sessionStorage.Juillet!=0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML=sessionStorage.Juillet;
			document.getElementById("Juillet").style.color="red";
			
			
			}
			if(sessionStorage.Aout==1){
		
		janvier.disabled = true;
		
		document.getElementById("Aout").innerHTML="SOLDÉ";
		document.getElementById("Aout").style.color="green";
		
		
		}else if(sessionStorage.Aout==0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML="IMPAYÉ";
			document.getElementById("Aout").style.color="red";
			
			
			}else if(sessionStorage.Aout!=1 && sessionStorage.Aout!=0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML=sessionStorage.Aout;
			document.getElementById("Aout").style.color="red";
			
			
			}
			if(sessionStorage.Septembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Septembre").innerHTML="SOLDÉ";
		document.getElementById("Septembre").style.color="green";
		
		
		}else if(sessionStorage.Septembre==0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML="IMPAYÉ";
			document.getElementById("Septembre").style.color="red";
			
			
			}else if(sessionStorage.Septembre!=1 && sessionStorage.Septembre!=0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML=sessionStorage.Septembre;
			document.getElementById("Septembre").style.color="red";
			
			
			}
			if(sessionStorage.Octobre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Octobre").innerHTML="SOLDÉ";
		document.getElementById("Octobre").style.color="green";
		
		
		}else if(sessionStorage.Octobre==0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML="IMPAYÉ";
			document.getElementById("Octobre").style.color="red";
			
			
			}else if(sessionStorage.Octobre!=1 && sessionStorage.Octobre!=0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML=sessionStorage.Octobre;
			document.getElementById("Octobre").style.color="red";
			
			
			}
			if(sessionStorage.Novembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Novembre").innerHTML="SOLDÉ";
		document.getElementById("Novembre").style.color="green";
		
		
		}else if(sessionStorage.Novembre==0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML="IMPAYÉ";
			document.getElementById("Novembre").style.color="red";
			
			}else if(sessionStorage.Novembre!=1 && sessionStorage.Novembre!=0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML=sessionStorage.Novembre;
			document.getElementById("Novembre").style.color="red";
			
			}
			if(sessionStorage.Decembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Decembre").innerHTML="SOLDÉ";
		document.getElementById("Decembre").style.color="green";
		
		
		}else if(sessionStorage.Decembre==0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML="IMPAYÉ";
			document.getElementById("Decembre").style.color="red";
			
			}else if(sessionStorage.Decembre!=1 && sessionStorage.Decembre!=0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML=sessionStorage.Decembre;
			document.getElementById("Decembre").style.color="red";
			
			}
			
		
		
		}else if(sessionStorage.id_annee==2){
			
			if(sessionStorage.Janvier==1){
		
		janvier.disabled = true;
		
		document.getElementById("janvier").innerHTML="SOLDÉ";
		document.getElementById("janvier").style.color="green";
		
		
		}else if(sessionStorage.Janvier==0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML="IMPAYÉ";
			document.getElementById("janvier").style.color="red";
			
			}
			else if(sessionStorage.Janvier!=1 && sessionStorage.Janvier!=0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML=sessionStorage.Janvier;
			document.getElementById("janvier").style.color="red";
			
			}
			
			
			if(sessionStorage.Fevrier==1){
		
		janvier.disabled = true;
		
		document.getElementById("Fevrier").innerHTML="SOLDÉ";
		document.getElementById("Fevrier").style.color="green";
		
		
		}else if(sessionStorage.Fevrier==0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML="IMPAYÉ";
			document.getElementById("Fevrier").style.color="red";
			
			}else if(sessionStorage.Fevrier!=1 && sessionStorage.Fevrier!=0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML=sessionStorage.Fevrier;
			document.getElementById("Fevrier").style.color="red";
			
			}
			if(sessionStorage.Mars==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mars").innerHTML="SOLDÉ";
		document.getElementById("Mars").style.color="green";
		
		
		}else if(sessionStorage.Mars==0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML="IMPAYÉ";
			document.getElementById("Mars").style.color="red";
			
			}else if(sessionStorage.Mars!=1 && sessionStorage.Mars!=0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML=sessionStorage.Mars;
			document.getElementById("Mars").style.color="red";
			
			}
			
			if(sessionStorage.Avril==1){
		
		janvier.disabled = true;
		
		document.getElementById("Avril").innerHTML="SOLDÉ";
		document.getElementById("Avril").style.color="green";
		
		
		}else if(sessionStorage.Avril==0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML="IMPAYÉ";
			document.getElementById("Avril").style.color="red";
			
			}else if(sessionStorage.Avril!=1 && sessionStorage.Avril!=0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML=sessionStorage.Avril;
			document.getElementById("Avril").style.color="red";
			
			}
			if(sessionStorage.Mai==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mai").innerHTML="SOLDÉ";
		document.getElementById("Mai").style.color="green";
		
		
		
		}else if(sessionStorage.Mai==0){
			janvier.disabled = true;
			document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").style.color="red";
			
			
			}else if(sessionStorage.Mai!=1 && sessionStorage.Mai!=0){
			janvier.disabled = true;
			//document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").innerHTML=sessionStorage.Mai;
			document.getElementById("Mai").style.color="red";
			
			
			}
			if(sessionStorage.Juin==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juin").innerHTML="SOLDÉ";
		document.getElementById("Juin").style.color="green";
		
		
		}else if(sessionStorage.Juin==0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML="IMPAYÉ";
			document.getElementById("Juin").style.color="red";
			
			}else if(sessionStorage.Juin!=1 && sessionStorage.Juin!=0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML=sessionStorage.Juin;
			document.getElementById("Juin").style.color="red";
			
			}
			if(sessionStorage.Juillet==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juillet").innerHTML="SOLDÉ";
		document.getElementById("Juillet").style.color="green";
		
		
		}else if(sessionStorage.Juillet==0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML="IMPAYÉ";
			document.getElementById("Juillet").style.color="red";
			
			
			}else if(sessionStorage.Juillet!=1 && sessionStorage.Juillet!=0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML=sessionStorage.Juillet;
			document.getElementById("Juillet").style.color="red";
			
			
			}
			if(sessionStorage.Aout==1){
		
		janvier.disabled = true;
		
		document.getElementById("Aout").innerHTML="SOLDÉ";
		document.getElementById("Aout").style.color="green";
		
		
		}else if(sessionStorage.Aout==0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML="IMPAYÉ";
			document.getElementById("Aout").style.color="red";
			
			
			}else if(sessionStorage.Aout!=1 && sessionStorage.Aout!=0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML=sessionStorage.Aout;
			document.getElementById("Aout").style.color="red";
			
			
			}
			if(sessionStorage.Septembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Septembre").innerHTML="SOLDÉ";
		document.getElementById("Septembre").style.color="green";
		
		
		}else if(sessionStorage.Septembre==0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML="IMPAYÉ";
			document.getElementById("Septembre").style.color="red";
			
			
			}else if(sessionStorage.Septembre!=1 && sessionStorage.Septembre!=0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML=sessionStorage.Septembre;
			document.getElementById("Septembre").style.color="red";
			
			
			}
			if(sessionStorage.Octobre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Octobre").innerHTML="SOLDÉ";
		document.getElementById("Octobre").style.color="green";
		
		
		}else if(sessionStorage.Octobre==0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML="IMPAYÉ";
			document.getElementById("Octobre").style.color="red";
			
			
			}else if(sessionStorage.Octobre!=1 && sessionStorage.Octobre!=0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML=sessionStorage.Octobre;
			document.getElementById("Octobre").style.color="red";
			
			
			}
			if(sessionStorage.Novembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Novembre").innerHTML="SOLDÉ";
		document.getElementById("Novembre").style.color="green";
		
		
		}else if(sessionStorage.Novembre==0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML="IMPAYÉ";
			document.getElementById("Novembre").style.color="red";
			
			}else if(sessionStorage.Novembre!=1 && sessionStorage.Novembre!=0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML=sessionStorage.Novembre;
			document.getElementById("Novembre").style.color="red";
			
			}
			if(sessionStorage.Decembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Decembre").innerHTML="SOLDÉ";
		document.getElementById("Decembre").style.color="green";
		
		
		}else if(sessionStorage.Decembre==0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML="IMPAYÉ";
			document.getElementById("Decembre").style.color="red";
			
			}else if(sessionStorage.Decembre!=1 && sessionStorage.Decembre!=0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML=sessionStorage.Decembre;
			document.getElementById("Decembre").style.color="red";
			
			}
			
			
			}else if(sessionStorage.id_annee==3){
				
				
				if(sessionStorage.Janvier==1){
		
		janvier.disabled = true;
		
		document.getElementById("janvier").innerHTML="SOLDÉ";
		document.getElementById("janvier").style.color="green";
		
		
		}else if(sessionStorage.Janvier==0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML="IMPAYÉ";
			document.getElementById("janvier").style.color="red";
			
			}
			else if(sessionStorage.Janvier!=1 && sessionStorage.Janvier!=0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML=sessionStorage.Janvier;
			document.getElementById("janvier").style.color="red";
			
			}
			
			
			if(sessionStorage.Fevrier==1){
		
		janvier.disabled = true;
		
		document.getElementById("Fevrier").innerHTML="SOLDÉ";
		document.getElementById("Fevrier").style.color="green";
		
		
		}else if(sessionStorage.Fevrier==0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML="IMPAYÉ";
			document.getElementById("Fevrier").style.color="red";
			
			}else if(sessionStorage.Fevrier!=1 && sessionStorage.Fevrier!=0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML=sessionStorage.Fevrier;
			document.getElementById("Fevrier").style.color="red";
			
			}
			if(sessionStorage.Mars==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mars").innerHTML="SOLDÉ";
		document.getElementById("Mars").style.color="green";
		
		
		}else if(sessionStorage.Mars==0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML="IMPAYÉ";
			document.getElementById("Mars").style.color="red";
			
			}else if(sessionStorage.Mars!=1 && sessionStorage.Mars!=0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML=sessionStorage.Mars;
			document.getElementById("Mars").style.color="red";
			
			}
			
			if(sessionStorage.Avril==1){
		
		janvier.disabled = true;
		
		document.getElementById("Avril").innerHTML="SOLDÉ";
		document.getElementById("Avril").style.color="green";
		
		
		}else if(sessionStorage.Avril==0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML="IMPAYÉ";
			document.getElementById("Avril").style.color="red";
			
			}else if(sessionStorage.Avril!=1 && sessionStorage.Avril!=0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML=sessionStorage.Avril;
			document.getElementById("Avril").style.color="red";
			
			}
			if(sessionStorage.Mai==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mai").innerHTML="SOLDÉ";
		document.getElementById("Mai").style.color="green";
		
		
		
		}else if(sessionStorage.Mai==0){
			janvier.disabled = true;
			document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").style.color="red";
			
			
			}else if(sessionStorage.Mai!=1 && sessionStorage.Mai!=0){
			janvier.disabled = true;
			//document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").innerHTML=sessionStorage.Mai;
			document.getElementById("Mai").style.color="red";
			
			
			}
			if(sessionStorage.Juin==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juin").innerHTML="SOLDÉ";
		document.getElementById("Juin").style.color="green";
		
		
		}else if(sessionStorage.Juin==0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML="IMPAYÉ";
			document.getElementById("Juin").style.color="red";
			
			}else if(sessionStorage.Juin!=1 && sessionStorage.Juin!=0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML=sessionStorage.Juin;
			document.getElementById("Juin").style.color="red";
			
			}
			if(sessionStorage.Juillet==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juillet").innerHTML="SOLDÉ";
		document.getElementById("Juillet").style.color="green";
		
		
		}else if(sessionStorage.Juillet==0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML="IMPAYÉ";
			document.getElementById("Juillet").style.color="red";
			
			
			}else if(sessionStorage.Juillet!=1 && sessionStorage.Juillet!=0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML=sessionStorage.Juillet;
			document.getElementById("Juillet").style.color="red";
			
			
			}
			if(sessionStorage.Aout==1){
		
		janvier.disabled = true;
		
		document.getElementById("Aout").innerHTML="SOLDÉ";
		document.getElementById("Aout").style.color="green";
		
		
		}else if(sessionStorage.Aout==0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML="IMPAYÉ";
			document.getElementById("Aout").style.color="red";
			
			
			}else if(sessionStorage.Aout!=1 && sessionStorage.Aout!=0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML=sessionStorage.Aout;
			document.getElementById("Aout").style.color="red";
			
			
			}
			if(sessionStorage.Septembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Septembre").innerHTML="SOLDÉ";
		document.getElementById("Septembre").style.color="green";
		
		
		}else if(sessionStorage.Septembre==0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML="IMPAYÉ";
			document.getElementById("Septembre").style.color="red";
			
			
			}else if(sessionStorage.Septembre!=1 && sessionStorage.Septembre!=0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML=sessionStorage.Septembre;
			document.getElementById("Septembre").style.color="red";
			
			
			}
			if(sessionStorage.Octobre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Octobre").innerHTML="SOLDÉ";
		document.getElementById("Octobre").style.color="green";
		
		
		}else if(sessionStorage.Octobre==0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML="IMPAYÉ";
			document.getElementById("Octobre").style.color="red";
			
			
			}else if(sessionStorage.Octobre!=1 && sessionStorage.Octobre!=0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML=sessionStorage.Octobre;
			document.getElementById("Octobre").style.color="red";
			
			
			}
			if(sessionStorage.Novembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Novembre").innerHTML="SOLDÉ";
		document.getElementById("Novembre").style.color="green";
		
		
		}else if(sessionStorage.Novembre==0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML="IMPAYÉ";
			document.getElementById("Novembre").style.color="red";
			
			}else if(sessionStorage.Novembre!=1 && sessionStorage.Novembre!=0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML=sessionStorage.Novembre;
			document.getElementById("Novembre").style.color="red";
			
			}
			if(sessionStorage.Decembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Decembre").innerHTML="SOLDÉ";
		document.getElementById("Decembre").style.color="green";
		
		
		}else if(sessionStorage.Decembre==0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML="IMPAYÉ";
			document.getElementById("Decembre").style.color="red";
			
			}else if(sessionStorage.Decembre!=1 && sessionStorage.Decembre!=0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML=sessionStorage.Decembre;
			document.getElementById("Decembre").style.color="red";
			
			}
			
				
				}//sessionStorage.id_annee==3
			sessionStorage.nom_locataire = data.nom_locataire;
			sessionStorage.prenoms_locataire = data.prenoms_locataire;
			//document.querySelector('nom_locatairediv').textContent= sessionStorage.nom_locataire + ' ' +sessionStorage.prenoms_locataire ;
			//var nom_locatairediv=sessionStorage.nom_locataire + ' ' +sessionStorage.prenoms_locataire ;
			

	}
});


</script>     
 