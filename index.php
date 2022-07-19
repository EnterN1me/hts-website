<!DOCTYPE html>
<head lang="fr">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<!-- Page de recherche de tarifs pour réparation HighTech-Services
@author Mickael GUERCHON
-->
<title>Tarif Reparation</title>
<!--lien icon-->
<link rel="icon" href="https://hightech-service.fr/wp-content/uploads/2021/01/cropped-logo-32x32.png" sizes="32x32">


<style type="text/css">
    html, body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: .9em;
		heigh: 100%;
        background: #DDDDDD;   
    }
	
	h1.blocktext {
		margin-left: auto;
		margin-right: auto;
		width: 6em;
	}
	
	h1 {
		font-family: Roboto;
		font-weight: 300%;
		background-color: #AAAAAA;
		text-transform: none;
		font-size: 4.5rem;
		line-height: 1.2em; 
		text-align:center ;
		box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
	}
	
	img{
		text-align:left;
	}
	
	form{
		background-color: #BBBBBB;
		padding: 5% 40px 2% 40px;
		margin-bottom: auto;
		display: flex;
		justify-content: space-between;
		font-size: 150%;
		font-weight: bold;
	}
	
	p select {
		display: flex;
		justify-content: space-between;
	}
	
	select{
		height:30px;
		font-size: 20px;
		box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
	}
	
	p {
		margin-bottom:10px;
		padding; 60% 10px;
		background-color: #BBBBBB;
		text-align: center;
	}

    .text {
	padding-top: 4%;
	font-size: 250%
    }
	
	.maj{
		margin-bottom:10px;
		padding; 60% 10px;
		background-color: #DDDDDD;
		text-align: right;
	}
		
	
</style>
</head>

<body>


<div class='bandeau'><img src="https://hightech-service.fr/wp-content/uploads/2019/04/logo-200x100ok.png" srcset="https://hightech-service.fr/wp-content/uploads/2019/04/logo-200x100ok.png 1x,  2x" alt="HighTech Service Toulouse" class="logo logoLight">
<h1> Votre tarif revendeur HT </h1>
</div>

<?php if (isset($_POST['type'])){
	$type_select=$_POST['type'];
}
else {$type_select="";}

if (isset($_POST['marque'])){
	$marque_select=$_POST['marque'];
}
else {$marque_select="";}

if (isset($_POST['modele'])){
	$modele_select=$_POST['modele'];
}
else {$modele_select="";}

if (isset($_POST['reparation'])){
	$reparation_select=$_POST['reparation'];
}
else {$reparation_select="";}
?>

<?php 
$con = new mysqli('localhost','id','pwd','BtoB');

if ($con->connect_error){
	die('Erreur : '.$con->connect_error);
}
//echo 'Connexion réussie '; // debug


$sql_type = "SELECT type FROM tarifs";
$result_type = mysqli_query($con,$sql_type);
$types = array();
if ($result_type) {
	while($row = $result_type->fetch_assoc()) {
	    array_push($types,ucfirst(mb_strtolower($row['type'])));
	}
	$types = array_unique($types);
}
else{
	echo "0 resultat type (probleme base de donnees); ";
}


$condition = "";
if($type_select!="") {
	$condition = "WHERE type = '$type_select'";
}
$sql_marque = "SELECT marque FROM tarifs $condition";
$result_marque = mysqli_query($con,$sql_marque);
$marques = array();
if ($result_marque) {
	while($row = $result_marque->fetch_assoc()) {
	    array_push($marques,ucfirst(mb_strtolower($row['marque'])));
	}
	$marques = array_unique($marques);
}
else{
	echo "0 resultat marque; ";
}

$condition = "";
if($marque_select!="") {
	$condition = "WHERE marque = '$marque_select'";
}
$sql_modele = "SELECT modele FROM tarifs $condition";
$result_modele = mysqli_query($con,$sql_modele);
$modeles = array();
if ($result_modele) {
	while($row = $result_modele->fetch_assoc()) {
	    array_push($modeles,ucfirst(mb_strtolower($row['modele'])));
	}
	$modeles = array_unique($modeles);
}
else{
	echo "0 resultat modele; ";
}

$condition = "";
if($marque_select!="") {
	$condition = "WHERE modele = '$modele_select'";
}
$sql_reparation = "SELECT reparation FROM tarifs $condition";
$result_reparation = mysqli_query($con,$sql_reparation);
$reparations = array();
if ($result_reparation) {
	while($row = $result_reparation->fetch_assoc()) {
	    array_push($reparations,ucfirst(mb_strtolower($row['reparation'])));
	}
	$reparations = array_unique($reparations);
}
else{
	echo "0 resultat reparation; ";
}
?>

<form action="BtoB.php" method="post" id="form"> 
			<div><p>Type d'appareil</p>
			<select name="type" id="type" onchange="document.getElementById('form').submit()">
				<option> --selectionnez le type ici--</option>
				<?php foreach ($types as $type){
					$result = "<option value='$type' ";
					if($type_select==$type){ $result.="selected";};
					$result.="> $type </option>";
					echo $result;
				}
				?>
			</select></div>
			
			<div><p>Marque </p>
			<select name="marque" id="marque" onchange="document.getElementById('form').submit()">
				<option> --selectionnez la marque ici--</option>
				<?php foreach ($marques as $marque){
					$result = "<option value='$marque' ";
					if($marque_select==$marque){ $result.="selected";};
					$result.="> $marque </option>";
					echo $result;
				}
				?>
			</select></div>
			
			<div><p>Modèle </p>
			<select name="modele" id="modele" onchange="document.getElementById('form').submit()">
				<option> --selectionnez le modele ici--</option>
				<?php foreach ($modeles as $modele){
					$result = "<option value='$modele' ";
					if($modele_select==$modele){ $result.="selected";};
					$result.="> $modele </option>";
					echo $result;
				}
				?>
			</select></div>
			
			<div><p>Réparation</p><select name="reparation" id="reparation" onchange="document.getElementById('form').submit()">
				<option> --selectionnez la reparation ici--</option>
				<?php foreach ($reparations as $reparation){
					$result = "<option value='$reparation' ";
					if($reparation_select==$reparation){ $result.="selected";};
					$result.="> $reparation </option>";
					echo $result;
				}
				?>
			</select></div>
			
            
         </form>

<div class='text' name='entern1me'>		 
<p><?php	
$sql_prix = "SELECT prix FROM tarifs WHERE modele = '$modele_select' AND reparation = '$reparation_select' AND type='$type_select' AND marque='$marque_select' ";
$result_prix = mysqli_query($con,$sql_prix);
$row = $result_prix->fetch_assoc();
$prix = $row['prix'];

if($prix) echo "la réparation vous coutera ".$prix." € HT (hors transport)" ; ?></p>
</div>		

</body>
</html>