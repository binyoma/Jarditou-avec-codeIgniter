<!DOCTYPE html>
    <html lang="fr"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Atelier PHP N°4 - Ajout produit</title>
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
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a  class="nav-link" href="<?php echo site_url("produits/liste"); ?>"> Accueil </a> 
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
<?php echo form_open_multipart();
if (isset($errors)){
    var_dump($errors);
} ?>

<div class="form-group"> 
    <label for="pro_ref"> Référence</label>
    <input class="form-control" type="text"  name="pro_ref" value="<?php echo set_value('pro_ref'); ?>">
    <?php echo form_error('pro_ref'); ?>
</div>
<div class="form-group"> 
    <label for="photo"> Photo</label>
    <input class="form-control" type="file"  name="fichier" id="fichier" >
</div>
<div class="form-group">
    <label for="pro_cat_id"> Catégorie</label>
    <?php
    echo "	
    <select id=\"pro_cat_id\"  name=\"pro_cat_id\" class=\"custom-select\"  >";
    foreach($categories as $row)
    {
        
        echo" <option value=$row->cat_id >$row->cat_nom</option>";
        
    } 
    echo " </select>";
    echo form_error('pro_cat_id'); ?>
 </div> 
 <div class="form-group">
   <label for="pro_libelle">Libellé</label>
   <input type="text" name="pro_libelle" id="pro_libelle" class="form-control" value="<?php echo set_value('pro_libelle'); ?>">
   <?php echo form_error('pro_libelle'); ?>
</div>
<div class="form-group ">
    <label for="pro_description"> Description</label>
    <input class="form-control" type="text"  name="pro_description" value="<?php echo set_value('pro_description'); ?>">
    <?php echo form_error('pro_description'); ?>
</div>
<div class="form-group">
    <label for="pro_prix"> Prix</label>
    <input class="form-control" type="decimal"  name="pro_prix" value="<?php echo set_value('pro_prix'); ?>">
    <?php echo form_error('pro_prix'); ?>
</div>
<div class="form-group">
    <label for="pro_stock"> Stock</label>
    <input class="form-control" type="number"  name="pro_stock" value="<?php echo set_value('pro_stock'); ?>">
    <?php echo form_error('pro_stock'); ?>
</div>
<div class="form-group">
    <label for="pro_couleur"> Couleur</label>
    <input class="form-control" type="text"  name="pro_couleur" value="<?php echo set_value('pro_couleur'); ?>">
    <?php echo form_error('pro_couleur'); ?>
</div>

<div class="form-group">
    <label for="bloque"> Bloquer le produit  :</label>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="pro_bloque" id="oui" value="oui" >
        <label class="form-check-label" for="oui">Oui</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="pro_bloque" id="non" value="non" >
        <label class="form-check-label" for="non">Non</label>
    </div>
    <?php echo form_error('pro_bloque'); ?>
</div>

 <button type="submit" class="btn btn-dark">Ajouter</button>    
 </form>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>