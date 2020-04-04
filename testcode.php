<?php 

			
if(isset($_POST['departement'])){
	$departement=$_POST['departement'];
	$departementarecuperer=$_POST['departement'];
	//echo ' Choix : '.$_POST['departement'];
					
}
								
?>
			
<form class="affiche" method="post" name="affiche" id="affiche" action="index.php">			
<?php 										
$reponse =$bdd->prepare('SELECT DISTINCT localite FROM '.$vendeur_BDD.' ORDER BY localite ASC');
$reponse->bindParam(':numdossier', $numdossier, PDO::PARAM_STR);
$reponse->bindParam(':nomvendeur', $nomvendeur, PDO::PARAM_STR);
$reponse->bindParam(':departement', $localite, PDO::PARAM_STR);
$reponse->execute();			
					
echo"
						
<ul>							
<li class='espacemini'></li>
<li>
<label for='departement' class='double2'>Département : </label>							
<select name='departement' id='departement' onchange='javascript:submit(this)' style='width:150px;'>
	<option selected=selected value='VotreChoix'>Votre Choix</option>";
		$reponse03 =$bdd->prepare('SELECT DISTINCT departement FROM '.$vendeur_BDD.' ORDER BY departement ASC');					
$reponse03->bindParam(':localite', $localite, PDO::PARAM_STR);
$reponse03->bindParam(':departement', $departement, PDO::PARAM_INT);
$reponse03->bindParam(':villedepartement', $villedepartement, PDO::PARAM_INT);	
$reponse03->execute();
				
while ($donnees03 = $reponse03->fetch())
	{
	echo "<option value='".$donnees03['departement']."'>".$donnees03['departement']."</option>";

	if(isset($_POST['departement'])){ 
		echo "<option selected=selected value='".$departement."'>".$departement."</option>";
	}								
}	
echo "</select> 
<script language='Javascript'>
//<![CDATA[	
function change_valeur() {
select = document.getElementById('departement');
choice = select.selectedIndex  // Récupération de l'index du <option> choisi
departement = select.options[choice].value; // Récupération du texte du <option> d'index 'choice'
//]]>
</script>";
if (isset($_POST['departement'])){
						
echo "<span class='texteaffichage'>Département Choisi : </span><span class='texteaffichagegras'>".$departement.'</span>';					
										}
echo"</li>
</ul>";	
												
?>
</form>
<!-- --------------------------------------------------------------------------- -->                    
<form class="recherche" method="post" name="recherche" id='recherche' action="index.php">			
<?php				
echo"<ul>
<li class='espacemini'></li>
<li>";
								
if (isset($_POST['departement'])){
	echo"<input type='hidden' name='departement' value='".$_POST['departement']."'>";
}
echo"<label for='localite' class='double2'>Ville : </label>								
<select name='localite' id='localite'  class='double' style='width:150px' ; ' />								
<option selected=selected value=''>Votre Choix</option>";									
$reponse04 =$bdd->prepare('SELECT DISTINCT localite FROM '.$vendeur_BDD.' WHERE departement LIKE "'.$_POST['departement'].'%" ORDER BY localite ASC');
	$reponse04->bindParam(':departement', $localite, PDO::PARAM_STR);
	$reponse04->bindParam(':localite', $localite, PDO::PARAM_STR);
									
$reponse04->execute();			
									
while ($donnees04 = $reponse04->fetch())
	{	
	echo "<option value='".$donnees04['localite']."'>".$donnees04['localite']."</option>";
										
	}

echo "</select> ";
						
echo"<script language='Javascript'>//<![CDATA[function change_valeur() {select = document.getElementById('localite');choice = select.selectedIndex  // Récupération de l'index du <option> choisi
localite = select.options[choice].value; // Récupération du texte du <option> d'index 'choice'
//]]>
</script> ";
if(isset($_POST['localite'])){
echo $_POST['localite'];
}									
echo"</li> ";