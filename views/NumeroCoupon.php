<!DOCTYPE html>
<?php
  //echo("Numero lot: " . $_POST['numeroLot'] . "<br />\n"); //TRACE
//  $connect = ConnexionDB(); // Je me connecte à la base de donnée

//  $updateLot = "SELECT * FROM Lot WHERE numeroLot = '$id'" or die("Erreur lors de la consultation de données (updateLot)" . mysqli_error($connect));
//  $req = $connect->query($updateLot);
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Lot ajouté</title>
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
        Veuillez valider le lot rentré pour obtenir un numéro de coupon
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../nouveauLot.html"> Nouveau lot</a></li>
        <li class="active">Lot rentré</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- <div class="modal"> -->
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Votre lot a bien été entré</h4>
            </div>
            <div class="modal-body">
              <p style="font-size:30px">Veuillez valider le lot rentré pour obtenir un numéro de coupon. Pour valider utiliser l'adresse mail suivante: <?php echo $_GET['mail'] ?></p>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
              <a class = "btn btn-primary" href = "../index.html" role = "button">J'ai retenu</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      <!-- </div> -->
    </section>
    <!-- /.content -->


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
var paiementIndex = 0;
var handleTypeChange = function(e) {
  console.log(e.value);
  console.log(e.dataset);
  console.log(e.dataset.index);

  var paiementIndex = e.dataset.index;
  if ( e.value == '0') // Voile
  {
    console.log('TRACE CB');
  }
  else if ( e.value == '1') // Selette
  {
    console.log('TRACE cheque');
  }
  else if ( e.value == '2') // Parachute de secours
  {
    console.log('TRACE liquide');
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

    $('#paiementForm')
        // .formValidation({
        //     framework: 'bootstrap',
        //     icon: {
        //         valid: 'glyphicon glyphicon-ok',
        //         invalid: 'glyphicon glyphicon-remove',
        //         validating: 'glyphicon glyphicon-refresh'
        //     },
        //     fields: {
        //         'paiement[0].marque': marqueValidators,
        //         'paiement[0].modele': modeleValidators
        //         'paiement[0].ptvmax': ptvmaxValidators
        //         'paiement[0].ptvmin': ptvminValidators
        //         'paiement[0].taille': tailleValidators
        //         'paiement[0].surface': surfaceValidators
        //         'paiement[0].couleur': couleurValidators
        //         'paiement[0].heure': heureValidators
        //         'paiement[0].typeaccessoire': typeaccessoireValidators
        //         'paiement[0].certificat': certificatValidators
        //     }
        // })

        // Add button click handler
        .on('click', '.addButton', function() {
            console.log('TRACE');
            paiementIndex++;
            console.log(paiementIndex);
            document.getElementById("index").value = paiementIndex + 1;
            console.log(document.getElementById("index").value);
            var $form = $('#paiementForm .box-body');
            var $template = $('#paiementTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .attr('data-paiement-index', paiementIndex);
            $form.append($clone);

            // Update the name attributes
            $clone
                .find('[name="typedepaiement"]').attr('name', 'paiement[' + paiementIndex + '][typedepaiement]').end()
                .find('[name="nom"]').attr('name', 'paiement[' + paiementIndex + '].nom').end()
                .find('[name="prenom"]').attr('name', 'paiement[' + paiementIndex + '].prenom').end()
                .find('[name="telephone"]').attr('name', 'paiement[' + paiementIndex + '].telephone').end()
                .find('[name="numero"]').attr('name', 'paiement[' + paiementIndex + '].numero').end()
                .find('[name="commentaire"]').attr('name', 'paiement[' + paiementIndex + '].commentaire').end()
                .find('[name="montant"]').attr('name', 'paiement[' + paiementIndex + '].montant').end()
                // Ici on clone les identifiants
                .find('[id="inputtypedepaiement"]').attr('data-index', '' + paiementIndex).end()
                .find('[id="inputtypedepaiement"]').attr('id', 'paiement[' + paiementIndex + '].inputtypedepaiement').end()
                .find('[id="nomgroup"]').attr('id', 'paiement[' + paiementIndex + '].nomgroup').end()
                .find('[id="prenomgroup"]').attr('id', 'paiement[' + paiementIndex + '].prenomgroup').end()
                .find('[id="telephonegroup"]').attr('id', 'paiement[' + paiementIndex + '].telephonegroup').end()
                .find('[id="numerogroup"]').attr('id', 'paiement[' + paiementIndex + '].numerogroup').end()
                .find('[id="commentairegroup"]').attr('id', 'paiement[' + paiementIndex + '].commentairegroup').end()
                .find('[id="montantgroup"]').attr('id', 'paiement[' + paiementIndex + '].montantgroup').end()

                .find('[name="inputNom"]').attr('name', 'paiement[' + paiementIndex + '][inputNom]').end()
                .find('[name="inputPrenom"]').attr('name', 'paiement[' + paiementIndex + '][inputPrenom]').end()
                .find('[name="inputTelephone"]').attr('name', 'paiement[' + paiementIndex + '][inputTelephone]').end()
                .find('[name="inputNumero"]').attr('name', 'paiement[' + paiementIndex + '][inputNumero]').end()
                .find('[name="inputCommentaire"]').attr('name', 'paiement[' + paiementIndex + '][inputCommentaire]').end()
                .find('[name="inputMontant"]').attr('name', 'paiement[' + paiementIndex + '][inputMontant]').end()

                .find('[id="inputtypedepaiement"]').attr('id', 'paiement[' + paiementIndex + '][inputtypedepaiement]').end()
                .find('[id="inputNom"]').attr('id', 'paiement[' + paiementIndex + '][inputNom]').end()
                .find('[id="inputPrenom"]').attr('id', 'paiement[' + paiementIndex + '][inputPrenom]').end()
                .find('[id="inputTelephone"]').attr('id', 'paiement[' + paiementIndex + '][inputTelephone]').end()
                .find('[id="inputNumero"]').attr('id', 'paiement[' + paiementIndex + '][inputNumero]').end()
                .find('[id="inputCommentaire"]').attr('id', 'paiement[' + paiementIndex + '][inputCommentaire]').end()
                .find('[id="inputMontant"]').attr('id', 'paiement[' + paiementIndex + '][inputMontant]').end()

            // Add new fields
            // Note that we also pass the validator rules for new field as the third parameter
            // $('#paiementForm')
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].typedematos', typeValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].marque', marqueValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].modele', modeleValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].ptvmax', ptvmaxValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].ptvmin', ptvminValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].taille', tailleValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].surface', surfaceValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].couleur', couleurValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].heure', heureValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].typeaccessoire', typeaccessoireValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].certificat', certificatValidators);

        })
        // Remove button click handler
        .on('click', '.removeButton', function() {
          document.getElementById("index").value --;
            var $row  = $(this).parents('.form-group'),
                index = $row.attr('data-paiement-index');

            // Remove fields
            // $('#paiementForm')
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].typedematos"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].marque"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].modele"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].ptvmax"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].ptvmin"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].taille"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].surface"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].couleur"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].heure"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].typeaccessoire"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].certificat"]'));

            // Remove element containing the fields
            $row.remove();
        });

        // $(document).on('change', $('#paiement['+ paiementIndex +'].inputtypedematos'), function() {
        //     var e = document.getElementById("paiement["+ paiementIndex +"].inputtypedematos");
        //     console.log(paiementIndex);
        //
        //   });

});
</script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
