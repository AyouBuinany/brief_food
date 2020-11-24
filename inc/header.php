
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar  ftco-navbar-light" id="ftco-navbar">
	<div class="container ">
		<a class="navbar-brand" href="accueil.php">FOOD</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fas fa-bars">
			</span> Menu
		</button>
		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active"><a href="accueil.php" class="nav-link">Accueil</a></li>
				<li class="nav-item cta cta-colored"><a href="panier.php" class="nav-link"><span class="fa fa-shopping-cart margin"></span>[<?php if(nombrePlate($db)>0) echo nombrePlate($db); else echo "0"; ?>]</a></li>
			</ul>
		</div>
	</div>
</nav>
