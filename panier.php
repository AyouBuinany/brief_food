<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'inc/functions_panier.php';
require './vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


//J'ai ajouter ce variable pour empêcher l'execution de script si une valeur n'existe pas
$erreur = false;

//Recuperer le type d'action (Ajouter au panier - changer la quantité - supprimer depuis le panier)
$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{

	if(!in_array($action,array('ajouter', 'supprimer', 'refresh')))
	$erreur=true;

	//récuperation des variables en POST ou GET
	$quantite = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:1 )) ;
	$idPlate = (isset($_POST['idp'])? $_POST['idp']:  (isset($_GET['idp'])? $_GET['idp']:null )) ;
}

//Par rapport au type d'action voulu en fait l'appel à la fonction requise
if (!$erreur){
   	switch($action){
		Case "ajouter":
			if(ajouterPlate($idPlate,$quantite, $db)){
				header("Location:panier.php");
			}
			break;

		Case "supprimer":
			if(supprimerPlate($idPlate, $db)){
				header("Location:panier.php");
			}
			break;

		Case "refresh" :
			if(changerQuantite($idPlate, $quantite, $db)){
				header("Location:panier.php");
			}
			break;

		Default:
			break;
   	}
}

//Commander
if(isset($_POST['envoyer']) && !empty($_POST['envoyer']))
	{
		$prenom = htmlspecialchars($_POST['prenom']);
		$nom = htmlspecialchars($_POST['nom']);
		$telephone =htmlspecialchars($_POST['telephone']);
		$date = date("Y-m-d h:i:s");
		$prixTotal = $_POST['prixTotal'];
		$adresse =htmlspecialchars($_POST['adresse']);
		$adEmail =htmlspecialchars($_POST['email']);
		$data = [
			'prenom'=>$prenom,
			'nom'=>$nom,
			'date' => $date,
			'prixTotal' => $prixTotal,
			'telephone'=>$telephone,
			'adresse' => $adresse,
			'email'=>$adEmail
		];
		// 
		try {
			//Server settings
			$mail->SMTPDebug = 4;
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'ayoub.elbouinany99@gmail.com';                     // SMTP username
			$mail->Password   = '';                               // SMTP password
			$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
			//Recipients
			$mail->setFrom($adEmail,$nom);
			$mail->addAddress('ayoub.elbouinany99@gmail.com');
			$mail->addReplyTo('ayoub.elbouinany99@gmail.com');               // Name is optional
			// Attachments
		$body="<strong>Hello world </strong> Im $prenom $nom <br>telephone : $telephone <br> adresse: $adresse";
			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Here is the subject';
			$mail->Body    = $body;
			$mail->AltBody = strip_tags($body);
		
			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
		// 
		$sql = "INSERT INTO commandes (prenom,nom,numeo_telephone,prixTotal, adresse,email,date) VALUES ( :prenom,:nom,:telephone,:prixTotal,:adresse,:email,:date)";
		$stat= $db->prepare($sql);
		if($stat->execute($data))
		{
			$plates = PlateExistent($db);
			foreach ($plates as $pl) {
				//update quantite de plate
			$sql3= "UPDATE plate SET quantite=(quantite-".$pl['quantite'].") where id=".$pl['idPlate']."";
			$stat3=$db->prepare($sql3);
			$stat3->execute();
			}
		}
		if(supprimerPanier($db)){
				echo '<script> alert("commande confirmer");</script>';
				header("Location:accueil.php");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Panier | Food</title>
	<?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/header_img.jpg'); background-size:cover;">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-0 bread">MON PANIER</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section ftco-cart overflow-auto">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<table class="table">
							<thead class="thead-primary">
								<tr class="text-center">
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>Plate</th>
									<th>Prix</th>
									<th>Quantité</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							<?php
									if(nombrePlate($db) == 0){
										echo "<tr><td>Votre panier est vide! </ td></tr>";
									}else {
									$plates = PlateExistent($db);
									foreach ($plates as $pl) {
										$plate2= infosPlate($pl['idPlate'], $db);
							?>
								<tr class="text-center">
									<td class="product-remove">
										<a href="panier.php?action=supprimer&idp=<?php echo $pl['idPlate'] ?>" title="panier - supprimer plate"><span class="fas fa-times"></span></a>
									</td>
									<td class="image-prod">
										<div class="img" style="background-image:url(images/<?php echo $plate2['image'] ?>); width:100px;height:65px; background-size:cover;"></div>
									</td>
									<td class="product-name">
										<h3><?php echo $plate2['nom'] ?></h3>
									</td>
									<td class="price"><?php echo $plate2['prix'] ?></td>
									<td class="quantity">
										<div class="input-group mb-3">
										<?php
										 if($pl['quantite'] > $plate2['quantite'] ){
											echo "<script> alert('stock insuffisant .');</script>";
											$value=$plate2["quantite"];
										}else{
												$value=$pl["quantite"];
											}
											?>
											<input class="quantity form-control input-number" max="100" min="1" name="quantity" id="inputQ<?php echo $pl['idPlate'] ?>" onchange="changeFunction(<?php echo $pl['idPlate'] ?>);" type="number" value="<?php echo $value;?>">
										</div>
									</td>
									<td>

									<input type="text" name="prixTotal" value="<?php echo $plate2['prix'] * $pl['quantite'] ?> DH" disabled>
									</td>
								</tr>
								<?php } } ?>
							</tbody>
						</table>
						<h3 class="text-center">Totaux du panier</h3> <span><mark><?php echo totalPrixPanier($db); ?>.00 DHs</mark></span>
					</div>
				</div>
			</div>
		</div>
	</section>
<!--  -->
<div style="height:100px"></div>
	<section class="ftco-section mb-3 ">
				<div class="col-md-6 order-md-last d-flex m-auto border">
				<div class="form-group w-100">

					<form action="" method="POST" class="bg-white p-5 contact-form col-12">
                    <div class="form-group">
							<h3 class="text-center text-capitalize">bienvenue</h3>
						</div>
						<div class="form-group ">
							<input class="form-control" name="prenom" placeholder="Notre prenom" type="text" required>
						</div>
						<div class="form-group">
							<input class="form-control" name="nom" placeholder="Notre nom" type="text" required>
						</div>
						<div class="form-group">
							<input class="form-control" name="telephone" placeholder="Votre telephone" type="tel" required>
						</div>
						<div class="form-group">
						<input class="form-control" name="email" placeholder="Votre adresse email" type="email" required>
						</div>
						<div class="form-group">
							<textarea class="form-control" cols="30" id="" name="adresse" placeholder="adresse" rows="7" required></textarea>
							<input type="hidden" name="prixTotal" value="<?php echo $plate2['prix'] * $pl['quantite'] ?> DH" >
						</div>
						<div class="form-group text-center">
							<input class="btn btn-success py-3 px-5" name="envoyer" type="submit" value="Envoyer">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
<!--  -->
	<?php require 'inc/footer.php'; ?>
	<?php require 'inc/foot-tags.php'; ?>
	<script>
			var idp;
			var quantite;

			//la function sert à envoyer les arguments au PHP et changer la valeur de quanyité
			function changeFunction($id){
				idp = $id;
				quantite = document.getElementById("inputQ" + $id).value;
				var url = window.location.href;
				url += '?action=refresh&idp=' + idp + '&q=' + quantite;
				window.location.href = url;
			}
	</script>
</body>
</html>