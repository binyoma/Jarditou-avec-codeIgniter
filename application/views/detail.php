<!DOCTYPE html>
    <html lang="fr"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>"> 
        <title> page de détail</title>
       
</head>
<body> 
<div class="container">	
<div class="row">
   <div class="col-3">
        <img src="<?php echo base_url("assets//images//jarditou_logo.jpg"); ?>" class="img-fluid rounded float-left " alt="logo">
    </div>
    <div class="col-3">
    
    </div>
    <div class="col-6">
      <img src="<?php echo base_url("assets//images//promotion.jpg" ); ?>"class="img-fluid max-width: 100%  " alt="promotion">
    </div>

</div>
<div class="menu">
    <nav id="navbar" class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a  class="nav-link" href="<?php echo site_url("produits/liste"); ?>"> Accueil </a> 
                </li>
                <li class="nav-item">
                <a   class="nav-link" href="<?php echo site_url("produits/modifier/$produit->pro_id"); ?>">Modifier</a> 
                </li>
                <li class="nav-item">
                <a class="nav-link" href="Formulaire.html">Mon compte</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="Horaires.html">contact </a>
                </li>
            </ul>
      </div> 
  </nav>
</div>
<h1><center>Details du produit</center></h1>
<form>


<div class="form-group">
    <img src="<?php echo base_url("assets//images//$produit->pro_id.$produit->pro_photo"); ?>" alt="<?php echo $produit->pro_libelle; ?>" class="img-thumbnail img-fluid rounded mx-auto d-block" >
</div>
<div class="form-row">

    <div class="form-group col-md-4">
      <label for="pro_ref" class="text-info">Référence</label>
      <div class="form-control">
    <?php echo $produit->pro_ref;
    ?>
    </div>
    </div>
    <div class="form-group col-md-4">
      <label for="Categorie" class="text-info">Catégorie</label>
      <div class="form-control">
    <?php echo $produit->pro_cat_id;
    ?>
    </div>
    </div>
    <div class="form-group col-md-4">
      <label for="pro_libelle" class="text-info">Libellé</label>
      <div class="form-control">
    <?php echo $produit->pro_libelle;
    ?>
    </div>
    </div>
  </div>

<div class="form-group ">
    <label for="Description" class="text-info"> Description</label>
    <div class="form-control  form-control-height">
    <?php echo $produit->pro_description;
    ?>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
      <label for="pro_prix" class="text-info">Prix</label>
      <div class="form-control">
    <?php echo $produit->pro_prix;
    ?>
    </div>
    </div>
    <div class="form-group col-md-4">
      <label for="pro_stock" class="text-info">Stock</label>
      <div class="form-control">
    <?php echo $produit->pro_stock;
    ?>
    </div>
    </div>
    <div class="form-group col-md-4">
      <label for="pro_couleur" class="text-info">Couleur</label>
      <div class="form-control">
    <?php echo $produit->pro_couleur;
    ?>
    </div>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="pro_bloque" class="text-info">Produit bloqué</label>
      <div class="form-control">
    <?php
    if ($produit->pro_bloque){
        echo "oui";
    }else{
        echo "non"; 
    };
    ?>
    </div>
    </div>
    <div class="form-group col-md-4">
      <label for="pro_d_ajout" class="text-info">Date d'ajout</label>
      <div class="form-control">
    <?php echo date("d/m/Y",strtotime($produit->pro_d_ajout));
    ?>
    </div>
    </div>
    <div class="form-group col-md-4">
      <label for="pro_d_modif" class="text-info">Date de modification</label>
      <div class="form-control">
    <?php if ($produit->pro_d_modif){
        $date=$produit->pro_d_modif;
    
        $datetime=new DateTime($date);
        
        echo $datetime->format('d/m/Y H\hi');
    }else {
        echo "pas encore";
    };
    ?>
    </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>