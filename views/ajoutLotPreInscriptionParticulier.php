<!DOCTYPE html>
	<?php
	
	session_start();
	include_once('../model/vendeur.php');
	include_once('../model/lot.php');
	include_once('../model/article.php');
	include_once('../model/modele.php');
	include_once('../model/marque.php');
	  //echo("Numero lot: " . $_POST['numeroLot'] . "<br />\n"); //TRACE
		//$id = $_POST['numeroLot'];
	//  $connect = ConnexionDB(); // Je me connecte à la base de donnée
	//  $updateLot = "SELECT * FROM Lot WHERE numeroLot = '$id'" or die("Erreur lors de la consultation de données (updateLot)" . mysqli_error($connect));
	//  $req = $connect->query($updateLot);
		$lot= unserialize(urldecode(($_SESSION['lot'])));
		$vendeur = $lot->getVendeur();
		$articles = unserialize(urldecode($_SESSION['articles']));
		// echo sizeof($articles);
		//echo $articles[0]->getMarque()->getLibelle();
		//echo $articles[0]->getTypeArticle();
	?>

	<html>
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>Ajout Lot preInscriptionParticulier un lot</title>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.6 -->
	  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
	  <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	  <script src="../https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="../https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->
	</head>

	<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

	  <!-- Main Header -->
	  <header class="main-header">

	    <!-- Logo -->
	    <a href="../index.html" class="logo">
	      <!-- mini logo for sidebar mini 50x50 pixels -->
	      <span class="logo-mini"><b>ST</b>H</span>
	      <!-- logo for regular state and mobile devices -->
	      <span class="logo-lg"><b>St</b>Hilaire</span>
	    </a>

	    <!-- Header Navbar -->
	    <nav class="navbar navbar-static-top" role="navigation">
	      <!-- Sidebar toggle button-->
	      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	        <span class="sr-only">Toggle navigation</span>
	      </a>
	    </nav>
	  </header>
	  <!-- Left side column. contains the logo and sidebar -->
	  <aside class="main-sidebar">

	    <!-- sidebar: style can be found in sidebar.less -->
	    <section class="sidebar">

	      <!-- Sidebar user panel (optional) -->
	      <div class="user-panel">
	        <div class="pull-left image">
	          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
	        </div>
	        <div class="pull-left info">
	          <p>Vendeur dashboard</p>
	          <!-- Status -->
	          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	        </div>
	      </div>

	      <!-- search form (Optional) -->
	      <form action="#" method="get" class="sidebar-form">
	        <div class="input-group">
	          <input type="text" name="q" class="form-control" placeholder="Search...">
	              <span class="input-group-btn">
	                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
	                </button>
	              </span>
	        </div>
	      </form>
	      <!-- /.search form -->

	      <!-- Sidebar Menu -->
	      <ul class="sidebar-menu">
	        <li class="header">HEADER</li>
	        <!-- Optionally, you can add icons to the links -->
	        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
	        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
	        <li class="treeview">
	          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	            <li><a href="#">Link in level 2</a></li>
	            <li><a href="#">Link in level 2</a></li>
	          </ul>
	        </li>
	      </ul>
	      <!-- /.sidebar-menu -->
	    </section>
	    <!-- /.sidebar -->
	  </aside>

	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Ajout Lot PreInscription Particulier
		</h1>
	      <ol class="breadcrumb">
	        <li><a href="index.html"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li class="active">Nouveau lot</li>
	      </ol>
	    </section>

	    <!-- Main content -->
	    <section class="content">

	    <!-- Your Page Content Here -->
	      <div class="row">
	        <!-- right column -->
	        <div class="col-md-12">
	          <!-- Horizontal Form -->
	          <div class="box box-info">
	            <div class="box-header with-border">
	              <h3 class="box-title">Modifier un lot à la main</h3>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
	            <form id="articleForm" method="POST" action="../controller/controllerAjoutLotPreInscriptionParticulier.php" class="form-horizontal">
	              <div class="box-body">

	                <div class="form-group">
	                  <label for="inputNom" class="col-sm-2 control-label">Nom</label>

	                  <div class="col-sm-10">
	                    <input type="text" class="form-control" value="<?php echo($lot->getVendeur()->getNom()) ?>" id="inputNom" name="inputNom" placeholder=<?php echo($lot->getVendeur()->getNom()) ?> \>
	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="inputPrenom" class="col-sm-2 control-label">Prénom</label>

	                  <div class="col-sm-10">
	                    <input type="text" class="form-control" value="<?php echo($lot->getVendeur()->getPrenom()) ?>" id="inputPrenom" name="inputPrenom" placeholder=<?php echo($lot->getVendeur()->getPrenom()) ?> \>
	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="inputTelephone" class="col-sm-2 control-label">Téléphone</label>

	                  <div class="col-sm-10">
	                    <input type="text" class="form-control" value="<?php echo($lot->getVendeur()->getTel()) ?>" id="inputTelephone" name="inputTelephone" placeholder=<?php echo($lot->getVendeur()->getTel()) ?> \>
	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>

	                  <div class="col-sm-10">
	                    <input type="email" class="form-control" value="<?php echo($lot->getVendeur()->getEMail()) ?>" id="inputEmail" name="inputEmail" placeholder=<?php echo($lot->getVendeur()->getEMail()) ?> \>
	                  </div>
	                </div>

					<div class="form-group">
	                  <div class="col-sm-10">
	                    <input type="hidden" class="form-control" value="<?php echo $lot->getId(); ?>" id="inputLot" name="inputLot" >
	                  </div>
	                </div>


									<input type="hidden" class="form-control" id="index" name="index" value="<?php echo sizeof($articles) - 1 ; ?>" />

									<!-- The template for adding new field -->
									<?php for ($i=0; $i<sizeof($articles); $i++) { ?>

									<div class="col-sm-12 form-group">
	                    <label>Type d'article</label>
	                    <select class="col-sm-5 form-control" id="article[<?php echo $i; ?>].inputtypedematos" name="article[<?php echo $i; ?>][typedematos]" data-index='0' onchange="handleTypeChange(this)">

												<?php if($articles[$i]->getTypeArticle() == 0) { ?>

														<option value="0" selected="selected">Voile</option>
														<option value="1">Selette</option>
														<option value="2">Parachute de secours</option>
														<option value="3">Accessoire</option>
													</select>
									</div>



											<div class="form-group" name="article[<?php echo $i; ?>].marque">
												<label for="inputmarque" class="col-sm-2 control-label">Marque</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputmarque" value="<?php echo($articles[$i]->getMarque()->getLibelle()) ?>" name="article[<?php echo $i; ?>][inputmarque]" placeholder="Marque" />
												</div>
											</div>


											<div class="form-group" name="article[<?php echo $i; ?>].modele">
												<label for="inputmodele" class="col-sm-2 control-label">Modele</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputmodele" value="<?php echo($articles[$i]->getModele()->getLibelle()) ?>" name="article[<?php echo $i; ?>][inputmodele]"  placeholder="Modele" />
												</div>
											</div>

											<div class="form-group" id="article[<?php echo $i; ?>].ptvmaxgroup" name="article[<?php echo $i; ?>].ptvmax">
												<label for="inputptvmax" class="col-sm-2 control-label">PTV Max</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputptvmax" value="<?php echo($articles[$i]->getPtvMax()) ?>" name="article[<?php echo $i; ?>][inputptvmax]"  placeholder="PTV Maximum" />
												</div>
											</div>

											<div class="form-group" id="article[<?php echo $i; ?>].ptvmingroup" name="article[<?php echo $i; ?>].ptvmin">
												<label for="inputptvmin" class="col-sm-2 control-label">PTV Min</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputptvmin"  value="<?php echo($articles[$i]->getPtvMin()) ?>" name="article[<?php echo $i; ?>][inputptvmin]"  placeholder="PTV Minimum" />
												</div>
											</div>

											<div class="form-group" id="article[<?php echo $i; ?>].taillegroup" name="article[<?php echo $i; ?>].taille">
												<label for="inputtaille" class="col-sm-2 control-label">Taille</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputtaille" value="<?php echo($articles[$i]->getTaille()) ?>" name="article[<?php echo $i; ?>][inputtaille]"  placeholder="Taille" />
												</div>
											</div>

											<div class="form-group" id="article[<?php echo $i; ?>].surfacegroup" name="article[<?php echo $i; ?>].surface">
												<label for="inputsurface" class="col-sm-2 control-label">Surface</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputsurface" name="article[<?php echo $i; ?>][inputsurface]"  placeholder="Surface" value="<?php echo($articles[$i]->getSurfaceVoile()) ?>"/>
												</div>
											</div>

											<div class="form-group" id="article[<?php echo $i; ?>].couleurgroup" name="article[<?php echo $i; ?>].couleur">
												<label for="inputcouleur" class="col-sm-2 control-label">Couleur</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputcouleur" name="article[<?php echo $i; ?>][inputcouleur]"  placeholder="Couleur" value="<?php echo($articles[$i]->getCouleurVoile()) ?>"/>
												</div>
											</div>

											<div class="form-group" id="article[<?php echo $i; ?>].heuregroup" name="article[<?php echo $i; ?>].heure">
												<label for="inputheuresdevol" class="col-sm-2 control-label">Heures de vol</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputheuresdevol"  name="article[<?php echo $i; ?>][inputheuresdevol]"  placeholder="Heures de vol" value="<?php echo($articles[$i]->getHeureVoile()) ?>"/>
												</div>
											</div>

											<div style="display: none;" class="form-group" id="article[<?php echo $i; ?>].typeaccessoiregroup" style="display:none" name="article[<?php echo $i; ?>].typeaccessoire">
												<label for="inputtypeaccessoire" class="col-sm-2 control-label">Type d'accessoire</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputtypeaccessoire"  name="article[<?php echo $i; ?>][inputtypeaccessoire]"  placeholder="Type d'accessoire" />
												</div>
											</div>

											<div class="checkbox" name="article[<?php echo $i; ?>].certificat" id="article[<?php echo $i; ?>].certificatgroup">
												<label>
													<input type="checkbox" id="article[<?php echo $i; ?>].inputcertificat"  name="article[<?php echo $i; ?>][inputcertificat]" value="<?php echo($articles[$i]->getCertificat()) ?>" <?php if ($articles[$i]->getCertificat() == '0') echo "checked='checked'"; ?>
> Certificat de révision <output></output>
												</label>
											</div>

											<div class="checkbox" name="article[<?php echo $i; ?>].suppression" id="article[<?php echo $i; ?>].suppressiongroup">
												<label>
													<input type="checkbox" id="article[<?php echo $i; ?>].inputsuppression"  name="article[<?php echo $i; ?>][inputsuppression]" value="YES"> Supprimer article ? <output></output>
												</label>
											</div>
												<?php }
												else if($articles[$i]->getTypeArticle() == 1) { ?>
														<option value="0">Voile</option>
														<option value="1" selected="selected">Selette</option>
														<option value="2">Parachute de secours</option>
														<option value="3">Accessoire</option>
													</select>
											</div>



											<div class="form-group" name="article[<?php echo $i; ?>].marque">
												<label for="inputmarque" class="col-sm-2 control-label">Marque</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputmarque" value="<?php echo($articles[$i]->getMarque()->getLibelle()) ?>" name="article[<?php echo $i; ?>][inputmarque]" placeholder="Marque" />
												</div>
											</div>


											<div class="form-group" name="article[<?php echo $i; ?>].modele">
												<label for="inputmodele" class="col-sm-2 control-label">Modele</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputmodele" value="<?php echo($articles[$i]->getModele()->getLibelle()) ?>" name="article[<?php echo $i; ?>][inputmodele]"  placeholder="Modele" />
												</div>
											</div>

											<div class="form-group" id="article[<?php echo $i; ?>].taillegroup" name="article[<?php echo $i; ?>].taille">
												<label for="inputtaille" class="col-sm-2 control-label">Taille</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputtaille" value="<?php echo($articles[$i]->getTaille()) ?>" name="article[<?php echo $i; ?>][inputtaille]"  placeholder="Taille" />
												</div>
											</div>

											<div class="checkbox" name="article[<?php echo $i; ?>].suppression" id="article[<?php echo $i; ?>].suppressiongroup">
												<label>
													<input type="checkbox" id="article[<?php echo $i; ?>].inputsuppression"  name="article[<?php echo $i; ?>][inputsuppression]" value="YES"> Supprimer article ? <output></output>
												</label>
											</div>


												<?php }
													else if($articles[$i]->getTypeArticle() == 2) { ?>
														<option value="0">Voile</option>
														<option value="1">Selette</option>
														<option value="2" selected="selected">Parachute de secours</option>
														<option value="3">Accessoire</option>
													</select>
											</div>



											<div class="form-group" name="article[<?php echo $i; ?>].marque">
												<label for="inputmarque" class="col-sm-2 control-label">Marque</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputmarque" value="<?php echo($articles[$i]->getMarque()->getLibelle()) ?>" name="article[<?php echo $i; ?>][inputmarque]" placeholder="Marque" />
												</div>
											</div>


											<div class="form-group" name="article[<?php echo $i; ?>].modele">
												<label for="inputmodele" class="col-sm-2 control-label">Modele</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputmodele" value="<?php echo($articles[$i]->getModele()->getLibelle()) ?>" name="article[<?php echo $i; ?>][inputmodele]"  placeholder="Modele" />
												</div>
											</div>

											<div class="form-group" id="article[<?php echo $i; ?>].ptvmaxgroup" name="article[<?php echo $i; ?>].ptvmax">
												<label for="inputptvmax" class="col-sm-2 control-label">PTV Max</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputptvmax" value="<?php echo($articles[$i]->getPtvMax()) ?>" name="article[<?php echo $i; ?>][inputptvmax]"  placeholder="PTV Maximum" />
												</div>
											</div>

											<div class="form-group" id="article[<?php echo $i; ?>].ptvmingroup" name="article[<?php echo $i; ?>].ptvmin">
												<label for="inputptvmin" class="col-sm-2 control-label">PTV Min</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputptvmin" value="<?php echo($articles[$i]->getPtvMin()) ?>" name="article[<?php echo $i; ?>][inputptvmin]"  placeholder="PTV Minimum" />
												</div>
											</div>

											<div class="checkbox" name="article[<?php echo $i; ?>].suppression" id="article[<?php echo $i; ?>].suppressiongroup">
												<label>
													<input type="checkbox" id="article[<?php echo $i; ?>].inputsuppression"  name="article[<?php echo $i; ?>][inputsuppression]" value="YES"> Supprimer article ? <output></output>
												</label>
											</div>
												<?php }
												else if($articles[$i]->getTypeArticle() == 3) { ?>
														<option value="0">Voile</option>
														<option value="1">Selette</option>
														<option value="2">Parachute de secours</option>
														<option value="3" selected="selected">Accessoire</option>
													</select>
											</div>



											<div class="form-group" name="article[<?php echo $i; ?>].marque">
												<label for="inputmarque" class="col-sm-2 control-label">Marque</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputmarque" value="<?php echo($articles[$i]->getMarque()->getLibelle()) ?>" name="article[<?php echo $i; ?>][inputmarque]" placeholder="Marque" />
												</div>
											</div>


											<div class="form-group" name="article[<?php echo $i; ?>].modele">
												<label for="inputmodele" class="col-sm-2 control-label">Modele</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputmodele" value="<?php echo($articles[$i]->getModele()->getLibelle()) ?>" name="article[<?php echo $i; ?>][inputmodele]"  placeholder="Modele" />
												</div>
											</div>

											<div class="form-group" id="article[<?php echo $i; ?>].typeaccessoiregroup" name="article[<?php echo $i; ?>].typeaccessoire">
												<label for="inputtypeaccessoire" class="col-sm-2 control-label">Type d'accessoire</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="article[<?php echo $i; ?>].inputtypeaccessoire" value="<?php echo($articles[$i]->getTypeAccessoire()) ?>" name="article[<?php echo $i; ?>][inputtypeaccessoire]"  placeholder="Type d'accessoire" />
												</div>
											</div>

											<div class="checkbox" name="article[<?php echo $i; ?>].suppression" id="article[<?php echo $i; ?>].suppressiongroup">
												<label>
													<input type="checkbox" id="article[<?php echo $i; ?>].inputsuppression"  name="article[<?php echo $i; ?>][inputsuppression]" value="YES"> Supprimer article ? <output></output>
												</label>
											</div>
												<?php }	?>


									<?php } ?>
	                <div class="col-xs-1">
	                  <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
	                </div>
	              </div>
	              <!-- /.box-body -->
	              <div class="box-footer">
	                <!-- <button type="submit" class="btn btn-default">Annuler</button> -->
	                <button type="submit" value="Submit" class="btn btn-info pull-right">Valider</button>
	              </div>
	              <!-- /.box-footer -->
	            </form>
	          </div>
	          <!-- /.box -->
	        </div>
	        <!--/.col (right) -->
	      </div>

	    </section>
	    <!-- /.content -->

	                <div class="col-sm-12 form-group hide" id="articleTemplate">

	                  <div class="col-sm-12 form-group">
	                      <label>Type d'article</label>
	                      <select class="col-sm-5 form-control" id="inputtypedematos" name="typedematos" data-index='0' onchange="handleTypeChange(this)">
	                        <option value="0">Voile</option>
	                        <option value="1">Selette</option>
	                        <option value="2">Parachute de secours</option>
	                        <option value="3">Accessoire</option>
	                      </select>
	                  </div>

	                  <div class="form-group" name="marque">
	                    <label for="inputmarque" class="col-sm-2 control-label">Marque</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="inputmarque" name="inputmarque" value="" placeholder="Marque" />
	                    </div>
	                  </div>

	                  <div class="form-group" name="modele">
	                    <label for="inputmodele" class="col-sm-2 control-label">Modele</label>
	                    <div class="col-sm-10">++++
	                      <input type="text" class="form-control" id="inputmodele" name="inputmodele" value="" placeholder="Modele" />
	                    </div>
	                  </div>

	                  <div class="form-group" name="ptvmax" id="ptvmaxgroup">
	                    <label for="inputptvmax" class="col-sm-2 control-label">PTV Max</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="inputptvmax" name="inputptvmax" value="" placeholder="PTV Maximum" />
	                    </div>
	                  </div>

	                  <div class="form-group" name="ptvmin" id="ptvmingroup">
	                    <label for="inputptvmin" class="col-sm-2 control-label">PTV Min</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="inputptvmin" name="inputptvmin" value="" placeholder="PTV Minimum" />
	                    </div>
	                  </div>

	                  <div class="form-group" name="taille" id="taillegroup">
	                    <label for="inputtaille" class="col-sm-2 control-label">Taille</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="inputtaille" name="inputtaille" value="" placeholder="Taille" />
	                    </div>
	                  </div>

	                  <div class="form-group" name="surface" id="surfacegroup">
	                    <label for="inputsurface" class="col-sm-2 control-label">Surface</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="inputsurface" name="inputsurface" value="" placeholder="Surface" />
	                    </div>
	                  </div>

	                  <div class="form-group" name="couleur" id="couleurgroup">
	                    <label for="inputcouleur" class="col-sm-2 control-label">Couleur</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="inputcouleur" name="inputcouleur" value="" placeholder="Couleur" />
	                    </div>
	                  </div>

	                  <div class="form-group" name="heure" id="heuregroup">
	                    <label for="inputheuresdevol" class="col-sm-2 control-label">Heures de vol</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="inputheuresdevol" name="inputheuresdevol" value="" placeholder="Heures de vol" />
	                    </div>
	                  </div>

	                  <div class="form-group" name="typeaccessoire" id="typeaccessoiregroup" style="display:none">
	                    <label for="inputtypeaccessoire" class="col-sm-2 control-label">Type d'accessoire</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="inputtypeaccessoire" name="inputtypeaccessoire" value="" placeholder="Type d'accessoire" />
	                    </div>
	                  </div>

	                  <div class="checkbox" name="certificat" id="certificatgroup">
	                    <label>
	                      <input type="checkbox" id="inputcertificat" name="inputcertificat" value="" > Certificat de révision <output></output>
	                    </label>
	                  </div>

	                  <div class="checkbox" name="suppression" id="suppressiongroup">
	                    <label>
	                      <input type="checkbox" id="inputsuppression"  name="inputsuppression" value=""> Supprimer article ? <output></output>
	                    </label>
	                  </div>

	                  <div class="col-xs-1">
	                    <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
	                  </div>
	                </div>



	  </div>
	  <!-- /.content-wrapper -->

	  <!-- Main Footer -->
	  <footer class="main-footer">
	    <!-- To the right -->
	    <div class="pull-right hidden-xs">
	      Anything you want
	    </div>
	    <!-- Default to the left -->
	    <strong>Copyright &copy; 2016 <a href="https://clubsthilair.wordpress.com/">Club Hilaire</a>.</strong> All rights reserved.
	  </footer>

	  <!-- Control Sidebar -->
	  <aside class="control-sidebar control-sidebar-dark">
	    <!-- Create the tabs -->
	    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
	      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
	      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
	    </ul>
	    <!-- Tab panes -->
	    <div class="tab-content">
	      <!-- Home tab content -->
	      <div class="tab-pane active" id="control-sidebar-home-tab">
	        <h3 class="control-sidebar-heading">Recent Activity</h3>
	        <ul class="control-sidebar-menu">
	          <li>
	            <a href="javascript::;">
	              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

	              <div class="menu-info">
	                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

	                <p>Will be 23 on April 24th</p>
	              </div>
	            </a>
	          </li>
	        </ul>
	        <!-- /.control-sidebar-menu -->

	        <h3 class="control-sidebar-heading">Tasks Progress</h3>
	        <ul class="control-sidebar-menu">
	          <li>
	            <a href="javascript::;">
	              <h4 class="control-sidebar-subheading">
	                Custom Template Design
	                <span class="pull-right-container">
	                  <span class="label label-danger pull-right">70%</span>
	                </span>
	              </h4>

	              <div class="progress progress-xxs">
	                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
	              </div>
	            </a>
	          </li>
	        </ul>
	        <!-- /.control-sidebar-menu -->

	      </div>
	      <!-- /.tab-pane -->
	      <!-- Stats tab content -->
	      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
	      <!-- /.tab-pane -->
	      <!-- Settings tab content -->
	      <div class="tab-pane" id="control-sidebar-settings-tab">
	        <form method="post">
	          <h3 class="control-sidebar-heading">General Settings</h3>

	          <div class="form-group">
	            <label class="control-sidebar-subheading">
	              Report panel usage
	              <input type="checkbox" class="pull-right" checked>
	            </label>

	            <p>
	              Some information about this general settings option
	            </p>
	          </div>
	          <!-- /.form-group -->
	        </form>
	      </div>
	      <!-- /.tab-pane -->
	    </div>
	  </aside>
	  <!-- /.control-sidebar -->
	  <!-- Add the sidebar's background. This div must be placed
	       immediately after the control sidebar -->
	  <div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED JS SCRIPTS -->

	<!-- jQuery 2.2.3 -->
	<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../dist/js/app.min.js"></script>


	<script>
	var value = document.getElementById("index").value;
	var articleIndex = value;
	var handleTypeChange = function(e) {
	  //console.log(e.value);
	  //console.log(e.dataset);
	  var articleIndex = (parseInt(e.dataset.index)).toString();
	  if ( e.value == '0') // Voile
	  {
	    console.log('TRACE voile');
	    var ptvmaxgroup = document.getElementById("article[" + articleIndex + "].ptvmaxgroup");
	    ptvmaxgroup.style.display = "block"
	    var ptvmingroup = document.getElementById("article[" + articleIndex + "].ptvmingroup");
	    ptvmingroup.style.display = "block"
	    var taillegroup = document.getElementById("article[" + articleIndex + "].taillegroup");
	    taillegroup.style.display = "block"
	    var surfacegroup = document.getElementById("article[" + articleIndex + "].surfacegroup");
	    surfacegroup.style.display = "block"
	    var couleurgroup = document.getElementById("article[" + articleIndex + "].couleurgroup");
	    couleurgroup.style.display = "block"
	    var heuregroup = document.getElementById("article[" + articleIndex + "].heuregroup");
	    heuregroup.style.display = "block"
	    var certificatgroup = document.getElementById("article[" + articleIndex + "].certificatgroup");
	    certificatgroup.style.display = "blocks"
	    var suppressiongroup = document.getElementById("article[" + articleIndex + "].suppressiongroup");
	    suppressiongroup.style.display = "blocks"
	    var typeaccessoiregroup = document.getElementById("article[" + articleIndex + "].typeaccessoiregroup");
	    typeaccessoiregroup.style.display = "none";
	  }
	  else if ( e.value == '1') // Selette
	  {
	    console.log('TRACE selette');
	    var ptvmaxgroup = document.getElementById("article[" + articleIndex + "].ptvmaxgroup");
	    ptvmaxgroup.style.display = "none";
	    var ptvmingroup = document.getElementById("article[" + articleIndex + "].ptvmingroup");
	    ptvmingroup.style.display = "none";
	    var taillegroup = document.getElementById("article[" + articleIndex + "].taillegroup");
	    taillegroup.style.display = "block";
	    var surfacegroup = document.getElementById("article[" + articleIndex + "].surfacegroup");
	    surfacegroup.style.display = "none";
	    var couleurgroup = document.getElementById("article[" + articleIndex + "].couleurgroup");
	    couleurgroup.style.display = "none";
	    var heuregroup = document.getElementById("article[" + articleIndex + "].heuregroup");
	    heuregroup.style.display = "none";
	    var certificatgroup = document.getElementById("article[" + articleIndex + "].certificatgroup");
	    certificatgroup.style.display = "none";
	    var suppressiongroup = document.getElementById("article[" + articleIndex + "].suppressiongroup");
	    suppressiongroup.style.display = "blocks"
	    var typeaccessoiregroup = document.getElementById("article[" + articleIndex + "].typeaccessoiregroup");
	    typeaccessoiregroup.style.display = "none";
	  }
	  else if ( e.value == '2') // Parachute de secours
	  {
	    console.log('TRACE para');
	    var ptvmaxgroup = document.getElementById("article[" + articleIndex + "].ptvmaxgroup");
	    ptvmaxgroup.style.display = "block";
	    var ptvmingroup = document.getElementById("article[" + articleIndex + "].ptvmingroup");
	    ptvmingroup.style.display = "block";
	    var taillegroup = document.getElementById("article[" + articleIndex + "].taillegroup");
	    taillegroup.style.display = "none";
	    var surfacegroup = document.getElementById("article[" + articleIndex + "].surfacegroup");
	    surfacegroup.style.display = "none";
	    var couleurgroup = document.getElementById("article[" + articleIndex + "].couleurgroup");
	    couleurgroup.style.display = "none";
	    var heuregroup = document.getElementById("article[" + articleIndex + "].heuregroup");
	    heuregroup.style.display = "none";
	    var certificatgroup = document.getElementById("article[" + articleIndex + "].certificatgroup");
	    certificatgroup.style.display = "none";
	    var suppressiongroup = document.getElementById("article[" + articleIndex + "].suppressiongroup");
	    suppressiongroup.style.display = "blocks"
	    var typeaccessoiregroup = document.getElementById("article[" + articleIndex + "].typeaccessoiregroup");
	    typeaccessoiregroup.style.display = "none";
	  }
	  else if ( e.value == '3') // Accessoire
	  {
	    console.log('TRACE accessoire');
	    var ptvmaxgroup = document.getElementById("article[" + articleIndex + "].ptvmaxgroup");
	    ptvmaxgroup.style.display = "none";
	    var ptvmingroup = document.getElementById("article[" + articleIndex + "].ptvmingroup");
	    ptvmingroup.style.display = "none";
	    var taillegroup = document.getElementById("article[" + articleIndex + "].taillegroup");
	    taillegroup.style.display = "none";
	    var surfacegroup = document.getElementById("article[" + articleIndex + "].surfacegroup");
	    surfacegroup.style.display = "none";
	    var couleurgroup = document.getElementById("article[" + articleIndex + "].couleurgroup");
	    couleurgroup.style.display = "none";
	    var heuregroup = document.getElementById("article[" + articleIndex + "].heuregroup");
	    heuregroup.style.display = "none";
	    var certificatgroup = document.getElementById("article[" + articleIndex + "].certificatgroup");
	    certificatgroup.style.display = "none";
	    var suppressiongroup = document.getElementById("article[" + articleIndex + "].suppressiongroup");
	    suppressiongroup.style.display = "blocks"
	    var typeaccessoiregroup = document.getElementById("article[" + articleIndex + "].typeaccessoiregroup");
	    typeaccessoiregroup.style.display = "block";
	  }
	}
	$(document).ready(function() {
	    var marqueValidators = {
	            row: '.col-xs-4',   // The title is placed inside a <div class="col-xs-4"> element
	            validators: {
	                notEmpty: {
	                    message: 'La marque est requise'
	                }
	            }
	        },
	        modeleValidators = {
	            row: '.col-xs-4',
	            validators: {
	                notEmpty: {
	                    message: 'Le modele est requis'
	                }
	            }
	        }
	    $('#articleForm')
	        // .formValidation({
	        //     framework: 'bootstrap',
	        //     icon: {
	        //         valid: 'glyphicon glyphicon-ok',
	        //         invalid: 'glyphicon glyphicon-remove',
	        //         validating: 'glyphicon glyphicon-refresh'
	        //     },
	        //     fields: {
	        //         'article[0].marque': marqueValidators,
	        //         'article[0].modele': modeleValidators
	        //         'article[0].ptvmax': ptvmaxValidators
	        //         'article[0].ptvmin': ptvminValidators
	        //         'article[0].taille': tailleValidators
	        //         'article[0].surface': surfaceValidators
	        //         'article[0].couleur': couleurValidators
	        //         'article[0].heure': heureValidators
	        //         'article[0].typeaccessoire': typeaccessoireValidators
	        //         'article[0].certificat': certificatValidators
	        //     }
	        // })
	        // Add button click handler
	        .on('click', '.addButton', function() {
	            console.log('TRACE');
	            articleIndex++;
	            console.log(articleIndex);
	            document.getElementById("index").value = articleIndex;
	            console.log(document.getElementById("index").value);
	            var $form = $('#articleForm .box-body');
	            var $template = $('#articleTemplate'),
	                $clone    = $template
	                                .clone()
	                                .removeClass('hide')
	                                .removeAttr('id')
	                                .attr('data-article-index', articleIndex);
	            $form.append($clone);
	            // Update the name attributes
	            $clone
	                .find('[name="typedematos"]').attr('name', 'article[' + articleIndex + '][typedematos]').end()
	                .find('[name="marque"]').attr('name', 'article[' + articleIndex + '].marque').end()
	                .find('[name="modele"]').attr('name', 'article[' + articleIndex + '].modele').end()
	                .find('[name="ptvmax"]').attr('name', 'article[' + articleIndex + '].ptvmax').end()
	                .find('[name="ptvmin"]').attr('name', 'article[' + articleIndex + '].ptvmin').end()
	                .find('[name="taille"]').attr('name', 'article[' + articleIndex + '].taille').end()
	                .find('[name="surface"]').attr('name', 'article[' + articleIndex + '].surface').end()
	                .find('[name="couleur"]').attr('name', 'article[' + articleIndex + '].couleur').end()
	                .find('[name="heure"]').attr('name', 'article[' + articleIndex + '].heure').end()
	                .find('[name="typeaccessoire"]').attr('name', 'article[' + articleIndex + '].typeaccessoire').end()
	                .find('[name="certificat"]').attr('name', 'article[' + articleIndex + '].certificat').end()
	                .find('[name="suppression"]').attr('name', 'article[' + articleIndex + '].suppression').end()
	                // Ici on clone les identifiants
	                .find('[id="inputtypedematos"]').attr('data-index', '' + articleIndex).end()
	                .find('[id="inputtypedematos"]').attr('id', 'article[' + articleIndex + '].inputtypedematos').end()
	                .find('[id="marquegroup"]').attr('id', 'article[' + articleIndex + '].marquegroup').end()
	                .find('[id="modelegroup"]').attr('id', 'article[' + articleIndex + '].modelegroup').end()
	                .find('[id="ptvmaxgroup"]').attr('id', 'article[' + articleIndex + '].ptvmaxgroup').end()
	                .find('[id="ptvmingroup"]').attr('id', 'article[' + articleIndex + '].ptvmingroup').end()
	                .find('[id="taillegroup"]').attr('id', 'article[' + articleIndex + '].taillegroup').end()
	                .find('[id="surfacegroup"]').attr('id', 'article[' + articleIndex + '].surfacegroup').end()
	                .find('[id="couleurgroup"]').attr('id', 'article[' + articleIndex + '].couleurgroup').end()
	                .find('[id="heuregroup"]').attr('id', 'article[' + articleIndex + '].heuregroup').end()
	                .find('[id="typeaccessoiregroup"]').attr('id', 'article[' + articleIndex + '].typeaccessoiregroup').end()
	                .find('[id="certificatgroup"]').attr('id', 'article[' + articleIndex + '].certificatgroup').end()
	                .find('[id="suppressiongroup"]').attr('id', 'article[' + articleIndex + '].suppressiongroup').end()
	                .find('[name="inputmarque"]').attr('name', 'article[' + articleIndex + '][inputmarque]').end()
	                .find('[name="inputmodele"]').attr('name', 'article[' + articleIndex + '][inputmodele]').end()
	                .find('[name="inputptvmax"]').attr('name', 'article[' + articleIndex + '][inputptvmax]').end()
	                .find('[name="inputptvmin"]').attr('name', 'article[' + articleIndex + '][inputptvmin]').end()
	                .find('[name="inputtaille"]').attr('name', 'article[' + articleIndex + '][inputtaille]').end()
	                .find('[name="inputsurface"]').attr('name', 'article[' + articleIndex + '][inputsurface]').end()
	                .find('[name="inputcouleur"]').attr('name', 'article[' + articleIndex + '][inputcouleur]').end()
	                .find('[name="inputheuresdevol"]').attr('name', 'article[' + articleIndex + '][inputheuresdevol]').end()
	                .find('[name="inputtypeaccessoire"]').attr('name', 'article[' + articleIndex + '][inputtypeaccessoire]').end()
	                .find('[name="inputcertificat"]').attr('name', 'article[' + articleIndex + '][inputcertificat]').end()
	                .find('[name="inputsuppression"]').attr('name', 'article[' + articleIndex + '][inputsuppression]').end()
	                .find('[id="inputtypedematos"]').attr('id', 'article[' + articleIndex + '][inputtypedematos]').end()
	                .find('[id="inputmarque"]').attr('id', 'article[' + articleIndex + '][inputmarque]').end()
	                .find('[id="inputmodele"]').attr('id', 'article[' + articleIndex + '][inputmodele]').end()
	                .find('[id="inputptvmax"]').attr('id', 'article[' + articleIndex + '][inputptvmax]').end()
	                .find('[id="inputptvmin"]').attr('id', 'article[' + articleIndex + '][inputptvmin]').end()
	                .find('[id="inputtaille"]').attr('id', 'article[' + articleIndex + '][inputtaille]').end()
	                .find('[id="inputsurface"]').attr('id', 'article[' + articleIndex + '][inputsurface]').end()
	                .find('[id="inputcouleur"]').attr('id', 'article[' + articleIndex + '][inputcouleur]').end()
	                .find('[id="inputheuresdevol"]').attr('id', 'article[' + articleIndex + '][inputheuresdevol]').end()
	                .find('[id="inputtypeaccessoire"]').attr('id', 'article[' + articleIndex + '][inputtypeaccessoire]').end()
	                .find('[id="inputcertificat"]').attr('id', 'article[' + articleIndex + '][inputcertificat]').end()
	                .find('[id="inputsuppression"]').attr('id', 'article[' + articleIndex + '][inputsuppression]').end();
	            // Add new fields
	            // Note that we also pass the validator rules for new field as the third parameter
	            // $('#articleForm')
	            //     .formValidation('addField', 'article[' + articleIndex + '].typedematos', typeValidators)
	            //     .formValidation('addField', 'article[' + articleIndex + '].marque', marqueValidators)
	            //     .formValidation('addField', 'article[' + articleIndex + '].modele', modeleValidators)
	            //     .formValidation('addField', 'article[' + articleIndex + '].ptvmax', ptvmaxValidators)
	            //     .formValidation('addField', 'article[' + articleIndex + '].ptvmin', ptvminValidators)
	            //     .formValidation('addField', 'article[' + articleIndex + '].taille', tailleValidators)
	            //     .formValidation('addField', 'article[' + articleIndex + '].surface', surfaceValidators)
	            //     .formValidation('addField', 'article[' + articleIndex + '].couleur', couleurValidators)
	            //     .formValidation('addField', 'article[' + articleIndex + '].heure', heureValidators)
	            //     .formValidation('addField', 'article[' + articleIndex + '].typeaccessoire', typeaccessoireValidators)
	            //     .formValidation('addField', 'article[' + articleIndex + '].certificat', certificatValidators);
	        })
	        // Remove button click handler
	        .on('click', '.removeButton', function() {
						articleIndex--;
						document.getElementById("index").value = articleIndex - 1;
	            var $row  = $(this).parents('.form-group'),
	                index = $row.attr('data-article-index');
	            // Remove fields
	            // $('#articleForm')
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].typedematos"]'))
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].marque"]'))
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].modele"]'))
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].ptvmax"]'))
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].ptvmin"]'))
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].taille"]'))
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].surface"]'))
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].couleur"]'))
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].heure"]'))
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].typeaccessoire"]'))
	            //     .formValidation('removeField', $row.find('[name="article[' + index + '].certificat"]'));
	            // Remove element containing the fields
	            $row.remove();
	        });
	        // $(document).on('change', $('#article['+ articleIndex +'].inputtypedematos'), function() {
	        //     var e = document.getElementById("article["+ articleIndex +"].inputtypedematos");
	        //     console.log(articleIndex);
	        //
	        //   });
	});
	</script>
