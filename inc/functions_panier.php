<?php

require 'config.php';
//changerQuantite
function changerQuantite($idp,$quantite, $db)
{
   $sql = "UPDATE panier SET quantite = :quantite  WHERE idPlate = :idp";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':quantite', $quantite);
   $stmt->bindValue(':idp', $idp);

   if($stmt->execute())
      return true;
}
//Ajouter plate dans Panier
function ajouterPlate($idp, $quantity, $db)
{
   if(plateExiste($idp, $db)) {
      $quantite = quantitePlate($idp, $db);
      if(changerQuantite($idp, $quantite+$quantity, $db))
         return true;
   }
   else {
      $data = [
			'idPlate' => $idp,
			'quantite' =>$quantity,
		];
		$sql = "INSERT INTO panier (idPlate, quantite) VALUES (:idPlate,:quantite)";
		$stat= $db->prepare($sql);
		if($stat->execute($data)) {
         return true;
      }
   }
}
// plate Existe dans panier 
function plateExiste($idp, $db)
{
   $sql = "SELECT COUNT(id) AS num FROM panier WHERE idPlate = :idp";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':idp', $idp);
   $stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
   if($row['num'] > 0)
      return true;
   else
      return false;
}


function quantitePlate($idp, $db)
{
   $sql = "SELECT quantite FROM panier WHERE idPlate = :idp";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':idp', $idp);
   $stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
   return $row['quantite'];
}

function supprimerPlate($idp, $db)
{
   $sql = "DELETE FROM panier WHERE idPlate = :idp ";
   $stat= $db->prepare($sql);
   $stat->bindValue(':idp', $idp);
   if($stat->execute()) {
      return true;
   }
}
// Nombre plate dans Panier
function nombrePlate($db)
{
   $sql = "SELECT COUNT(id) AS num FROM panier";
   $stmt = $db->prepare($sql);
   $stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
   return $row['num'];
}
//
function totalPrixPanier($db)
{
   $total = 0;
    $plate=PlateExistent($db);
   foreach ($plate as $pl) {
      $plate2 = infosPlate($pl['idPlate'], $db);
      $total += ($plate2['prix'] * $pl['quantite']);
   }
   return $total;
}

function PlateExistent($db)
{
   $sql = "SELECT * FROM panier";
   $stmt = $db->prepare($sql);
   $stmt->execute();
   $plate = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $plate;
}

function infosPlate($idp, $db)
{
   $sql = "SELECT * FROM plate WHERE id = :idp";
   $stmt = $db->prepare($sql);    
   $stmt->bindValue(':idp', $idp);
   $stmt->execute();
   $plate = $stmt->fetch(PDO::FETCH_ASSOC);
   return $plate;
}

function supprimerPanier($db)
{
   $sql = "DELETE FROM panier";
   $stat= $db->prepare($sql);
   if($stat->execute())
      return true;
}
?>