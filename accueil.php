<?php
	require 'inc/functions_panier.php';

	$plates="";
	srand((int)date("ymd"));
	//requet pour afficher le plate 
	$sql="SELECT * FROM plate ORDER BY RAND(20201123)  LIMIT 19, 1";
	$query = $db->prepare($sql);
			$query->execute();
			$plates=$query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Menu | Food </title>
  <?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/header_img.jpg'); background-size:cover;">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-0 bread">Plate Food</h1>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<section class="bg-light">
		<div class="container">
			<div class="row">
			<div class="col-9 m-3">
			<h3>Plate </h3>
			</div>
</div>
</div>
			</section>
			<!--  -->
			<section>
		<div class="container">
			<div class="row">
				<div class=" col mt-2 bg-linear" >
					<div class="col-6"></div>
					<div  class="col d-md-flex overflow-hidden " id="listImg">
					<div class="col-md-3 col-sm-12 m-3"><a href="./images/plate8.jpg" title="plate 1" target="_blank"><img src="./images/plate8.jpg" class="w-100" style="height: 220px;"  alt="plate8" > </a></div>
					<div class="col-md-3 col-sm-12 m-3"><a href="./images/plate5.jpg" title="plate 2" target="_blank"><img src="./images/plate5.jpg" class="w-100" style="height: 220px;"  alt="plate5"></a></div>
					<div class="col-md-3 col-sm-12 m-3"> <a href="./images/plate6.jpg" title="plate 3" target="_blank"><img src="./images/plate6.jpg" class="w-100" style="height: 220px;"  alt="pate6"></a></div>
					<div class="col-md-2 col-sm-12 text-monospace text-center">
								<h2 class="mt-3 text-uppercase">Food Plate </h2>
								<p class="text-break">
								<mark>Commandez en <span class="text-success">ligne </span> ou par <span class="text-success"> téléphone </span> <i class="fas fa-smile"></i></mark> 
								</p>

					</div>
					</div>
				</div>
</div>
</div>
</section>
<!-- map -->
<section class="mt-md-5">
<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-9">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3226.89320652627!2d-9.23771837834747!3d32.293555880346936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdac211719897669%3A0x6f59fa5bb517f58a!2sYouCode%20Safi!5e0!3m2!1sfr!2sma!4v1605972461543!5m2!1sfr!2sma" width="600" height="450" class="d-none  d-md-block" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	</div>
	<div class="col-md-5 ml-md-7  col-sm-9">
				<h3 class="text-center mt-md-3">
					<b>
				CHEZ FOOD ON DEMAND !
				</b>
				</h3>
<div class="mt-md-3">

<p >Food On Demand est le premier restaurant à safi à se doter d'une solution mult-devices : application mobile, borne digitale et tablette pour offrir une expérience unique à nos clients.</p>
	<p class="mt-md-3">
	L’expérience digitale au sein du restaurant est renforcée par le menu numérique disponible sur des tablettes, que les clients peuvent aussi utiliser pour diffuser leurs chansons préférées.

	</p>
</div>

	</div>
</div>
</div>	
</section>
	<!--  -->
<div style="height:100px"></div>
	<section class="ftco-section mb-3 ">
				<div class="col-md-6 order-md-last d-flex m-auto ">
					<?php if($plates!=null){?>
				<div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <a href="./images/<?=$plates['image']?>" target="_blank"><img src="./images/<?=$plates['image']?>" class="card-img" alt="<?=$plates['image']?>"></a>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?=$plates['nom']?></h5>
        <p class="card-text"><?=$plates['description']?></p>
		<p class="card-text"><b class="text-muted"><?=$plates['prix']?>.00 DH</b></p>
		<a href="panier.php?action=ajouter&idp=<?php echo $plates['id'] ?>" type="button" class="btn btn-info float-right m-2"><i class="fas fa-plus"></i></a>
      </div>
    </div>
  </div>
</div>
<?php }else{ 
	echo "no plate ";}?>
		</div>
	</section>
  <?php require 'inc/footer.php'; ?>
  <?php require 'inc/foot-tags.php'; ?>
</body>
</html>
